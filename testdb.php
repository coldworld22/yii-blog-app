<?php
$dsn = 'mysql:host=localhost;dbname=yii_blog_db';
$username = 'root';
$password = ''; // Use your actual password here if you have set one

try {
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
