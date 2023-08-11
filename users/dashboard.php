<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            height: 100vh;
            text-align: center;
        }

        #header {
            font-size: 28px;
            color: maroon;
            margin-bottom: 25px;
        }

        .dashboard-links a {
            display: block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .dashboard-links a:hover {
            background-color: #0056b3;
        }

        #footer {
            margin-top: 20px;
            color: #336699;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php echo "Welcome " . $_SESSION['username']; ?>
        </div>
        <div class="dashboard-links">
            <a href='../auth/logout.php'>Logout</a>
            <a href='../products/index.php'>View and Add Products</a>
        </div>
        <div id="footer">
            Created by Rohan Maharjan
        </div>
    </div>
</body>

</html>
