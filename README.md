# Fronsky PHP Framework

This repository contains the source code and assets for the Fronsky PHP Framework. It is built using [PHP](https://www.php.net/manual/en/getting-started.php).

## Installation

1. Clone this repository: `git clone https://github.com/fronskyofficial/php-framework.git`
2. Inside the `secure` folder, create a file named `settings.json`
3. Add the following code to the `settings.json` file:

```json
{
    "host": "localhost",
    "username": "root",
    "password": "root",
    "database": "db_name"
}
```

4. Change the `username`, `password`, and the `database` to the actual data used for the database.
5. In the [index.php](public/index.php) file, replace the `PUBLIC_PATH` variable with the URL of your website's public directory. This is where your website's content is located.
6. Make sure to have [PHP 8.2.0](https://www.php.net/releases/8.2/en.php) or higher installed.

## Usage

Once your local appache server is running, you can access the Fronsky PHP Framework website by visiting [localhost](http://localhost) in your web browser.

# Publishing

1. Open the [public](public) directory and select all the files.
2. Paste the files into the main folder of your website.
3. Locate the [secure](secure) folder and copy it to the same location as the website's main folder.
4. Configure the production database to match the localhost database.
5. Congratulations! Your website is now securely published and ready to use.

## Contributing

If you would like to contribute to this project, please follow these steps:

1. Fork this repository.
2. Create a new branch for your feature or bug fix: `git checkout -b feature-name`
3. Make your changes and commit them: `git commit -am 'Add new feature'`
4. Push your changes to your forked repository: `git push origin feature-name`
5. Submit a pull request to the development repository.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
