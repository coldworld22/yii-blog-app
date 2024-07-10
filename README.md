# Yii Blog Application

This is a simple CRUD blog application built using Yii 1.1. It includes user authentication, email verification, and CRUD operations for blog posts.

## Requirements

- PHP 5.6 or higher
- MySQL 5.6 or higher
- Composer (optional, for dependency management)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
2- Install dependencies

If you are using Composer, install the required dependencies:
composer install
3- Set up the database
Create a MySQL database and import the provided SQL file:
CREATE DATABASE yii_blog_db;
USE yii_blog_db;
SOURCE path/to/your/sql/file.sql;
4- Configure the application
in protected/config/main.php put  database configuration:
'db' => array(
    'connectionString' => 'mysql:host=localhost;dbname=yii_blog_db',
    'emulatePrepare' => true,
    'username' => 'your_db_username',
    'password' => 'your_db_password',
    'charset' => 'utf8',
),

5- Run the application

Start your web server and navigate to the application URL, typically for me  is http://localhost:8080/yii-blog/myblog/index.php

6- Usage

    Register a new user

    Visit the registration page and create a new account. An email will be sent to verify your email address.

    Verify your email

    Check your email for a verification link. Click the link to verify your email address.

    Log in

    After verifying your email, log in to the application.

    Create, Read, Update, Delete (CRUD) Blog Posts

    Once logged in, you can create, view, update, and delete your own blog posts.

Troubleshooting
Email Configuration

    Ensure your email server settings are correct in php.ini if using a local server.
    For PHPMailer, ensure the correct SMTP server settings are provided in the Yii configuration.

Common Errors

    Error 500: mail(): Failed to connect to mailserver at "localhost" port 25
        Ensure your local mail server is running and correctly configured, or use a third-party SMTP service like Gmail.
    Error 403: You are not authorized to perform this action
        Ensure the email_verified and author_id checks are correctly implemented in the controller actions.

License

This project is licensed under the MIT License. See the LICENSE file for details.
