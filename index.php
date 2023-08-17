<?php 
session_save_path("c:/xampp/tmp");

session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/indexStyle.css">
</head>

<body>
    <div id="container">
        <div id="header">
            Welcome to my project!
        </div>
        <?php
        if (isset($_SESSION['valid'])) {
            include("connection.php");
            $result = mysqli_query($mysqli, "SELECT * FROM login");
            ?>
            <div class="welcome-text">
                Welcome <?php echo $_SESSION['name'] ?>!
            </div>
            <div class="login-links">
                <a href='logout.php' class="login-button">Logout</a>
                <a href='view.php' class="login-button">View and Add Products</a>
            </div>
            <?php
        } else {
            ?>
            <div class="welcome-text">
                You must be logged in to view this page.
            </div>
            <div class="login-links">
                <a href='auth/login.php' class="login-button">Login</a>
                <a href='auth/register.php' class="signup-button">Register</a>
            </div>
            <?php
        }
        ?>
        <div id="footer">
            Created by Rohan Maharjan
        </div>
    </div>
</body>
</html>
