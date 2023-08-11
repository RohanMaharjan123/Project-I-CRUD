<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        #header {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .welcome-text {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }
		.login-button, .signup-button {
            margin-top: 10px;
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

		.login-button {
            background-color: #007bff;
            color: #fff;
        }
        .signup-button {
            background-color: #28a745;
            color: #fff;
        }
        .login-button:hover, .signup-button:hover {
            background-color: #0056b3;
        }
		#footer{
			margin:20px;
		}
    </style>
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
