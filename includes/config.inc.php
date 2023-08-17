<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "RohanCRUD";

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS $database";

    $conn->exec($sql);

    $conn->exec("USE $database");

    $users_sql = "
        CREATE TABLE IF NOT EXISTS users(
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(254) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        type ENUM('admin', 'user') NOT NULL DEFAULT 'user'
        )
        ";
    $conn->exec($users_sql);

    $check_query = "SELECT COUNT(*) FROM users WHERE username = 'admin'";
    $admin_exists = $conn->query($check_query)->fetchColumn();
    
    if (!$admin_exists) {
        $create_admin_query = "
            INSERT INTO users (username, email, password, type)
            VALUES ('admin', 'admin@gmail.com', '$2y$10$lgRvXfetDS6j1gncngkafOJYhfDT2HXkNZ9gW4JhS5L5w1vWvQM8e', 'admin')
        ";
        $conn->exec($create_admin_query);
    }
    $products_sql = "
        CREATE TABLE IF NOT EXISTS products(
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(254) NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
        ";

    $conn->exec($products_sql);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
