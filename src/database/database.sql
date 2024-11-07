DROP DATABASE IF EXISTS `rohancrud`;

CREATE DATABASE `rohancrud`;

USE `rohancrud`;

CREATE TABLE
    IF NOT EXISTS users(
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(254) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS products(
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(254) NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    );