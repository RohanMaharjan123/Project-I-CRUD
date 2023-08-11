<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "RohanCRUD";

try{
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    // set the PDO error mode to exception.
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    // use exec() because no results are returned.
    $conn -> exec($sql);

    // Select the database
    $conn -> exec("USE $database");

    $users_sql = "CREATE TABLE IF NOT EXISTS users(
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(254) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL)";
    $conn -> exec($users_sql);

    $products_sql = "CREATE TABLE IF NOT EXISTS products(
        id INT PRIMARY KEY AUTO_INCREMENT,
        name
        
        VARCHAR(254) NOT NULL,
        qty INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
        )";

    $conn -> exec($products_sql);
    // echo "Test";

}catch(PDOException $e){
    echo "Connection failed: " . $e -> getMessage();
}

?>