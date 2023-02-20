<?php

// Define constants
define('PUBLIC_PATH', 'http://localhost/public/');
define('BASE_PATH', '../secure/');
define('VIEW_PATH', BASE_PATH . 'views/');
define('INCLUDE_PATH', BASE_PATH . 'includes/');
define('DEFAULT_VIEW', VIEW_PATH . 'home.php');

// Load error definitions
require BASE_PATH . 'app/enums/ErrorDefinitions.php';

/**
 * This function is responsible for loading a specified file and outputting default styling.
 *
 * @param string $path The path to the file to be loaded.
 * @return void
 */
function loadFile($path) {
    // Output the default styling for all views
    echo '<link rel="shortcut icon" href="'.PUBLIC_PATH.'favicon.ico" type="image/x-icon">';
    echo '<link rel="icon" href="'.PUBLIC_PATH.'images/icon.png">';
    echo '<link rel="apple-touch-icon" href="'.PUBLIC_PATH.'images/icon.png">';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap">';
    echo '<link rel="stylesheet" type="text/css" href="'.PUBLIC_PATH.'css/core/bootstrap.min.css">';
    echo '<script defer src="'.PUBLIC_PATH.'js/core/jquery.min.js"></script>';
    echo '<script defer src="'.PUBLIC_PATH.'js/core/bootstrap.min.js"></script>';
    echo '<link rel="stylesheet" type="text/css" href="'.PUBLIC_PATH.'css/site.css">';
    echo '<script defer src="'.PUBLIC_PATH.'js/site.js"></script>';

    // Load the specified file
    if (file_exists($path)) {
        require $path;
    } else {
        // Handle file not found error
        http_response_code(404);
        $errorFile = ErrorDefinitions::err404->value;
        if (!file_exists($errorFile)) {
            http_response_code(500);
            $errorFile = ErrorDefinitions::err500->value;
            if (!file_exists($errorFile)) {
                $errorFile = null;
            }
        }
        // Load the error file
        if ($errorFile !== null) {
            require $errorFile;
        } else {
            echo '<p class="text-center">HTTP-ERROR 500</p>';
        }
    }
}

// Route based on the URL
$url = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$viewFile = DEFAULT_VIEW;
if (!empty($url[0])) {
    $fileName = pathinfo($url[0], PATHINFO_FILENAME);
    $fileExtension = pathinfo($url[0], PATHINFO_EXTENSION);
    // Determine the file path based on the file extension
    if (in_array($fileExtension, ['inc', 'include', 'includes'])) {
        $viewFile = INCLUDE_PATH . $fileName . '.inc.php';
    } else {
        $viewFile = VIEW_PATH . $fileName . '.php';
    }
}
// Load the file
loadFile($viewFile);
