<?php 

class database
{
    /**
     * Create a new PDO database connection with the specified parameters.
     *
     * @return PDO|null Returns a new PDO object representing the database connection, or null if the connection attempt fails.
     *
     * @throws PDOException If the connection attempt fails and an error is thrown by PDO.
     */
    private function createConnection(): ?PDO {
        $jsonString = file_get_contents('../secure/settings.json');
        $data = json_decode($jsonString);

        $host = $data->host;
        $username = $data->username;
        $password = $data->password;
        $database = $data->database;
        $charset = 'utf8mb4';
        $connection = 'mysql:host=' . $host . '; dbname=' . $database . '; charset=' . $charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            return new PDO($connection, $username, $password, $options);
        } catch(PDOException $exception) {
            echo 'Connection failed: ' . $exception->getMessage();
            return null;
        }
    }

    /**
     * Executes a prepared query statement with the specified data on the database.
     *
     * @param string $query The prepared SQL query statement to execute.
     * @param array|string $data The data to be used for prepared statement parameter bindings. Defaults to an empty string if not provided.
     * @return array|null Returns an array containing all of the result set rows of the executed query statement, or null if the execution fails.
     * 
     * @throws PDOException If the prepared statement fails to execute and an error is thrown by PDO.
     */
    public function executeQuery(string $query, array|string $data = ''): ?array {
        $pdo = $this->createConnection();
        $stmt = $pdo->prepare($query);

        try {
            if (is_array($data)) {
                $stmt->execute($data);
            } else {
                $stmt->execute();
            }
        }
        catch(PDOException $exception) {
            echo 'Error: ' . $exception->getMessage();
            $pdo = null;
            return null;
        }

        $result = $stmt->fetchAll();
        $pdo = null;
        return $result;
    }
}