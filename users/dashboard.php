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
            margin: auto;
            /* background-color: #d34970; */
        }

        #container {
            height: 657px;
            justify-content: center;
            text-align: center;
            background-color: antiquewhite;
        }

        #header {
            width: auto;
            color: maroon;
            font-size: 32px;
            padding: 10px 10px 10px 0px;
            margin-bottom: 25px;
            /* border-bottom: 1px solid green; */
        }

        #footer {
            /* border-top: 1px solid green; */
            margin-top: 20px;
            color: #336699;
            padding: 10px;

        }
    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php echo "Welcome " . $_SESSION['username']; ?>
        </div>
        <a href='../auth/logout.php'>Logout</a><br />
        <br />
        <a href='view.php'>View and Add Products</a>
        <br /><br />
        <div id="footer">
            Created by Rohan Maharjan
        </div>
    </div>

</body>

</html>