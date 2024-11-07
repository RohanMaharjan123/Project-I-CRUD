<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../includes/config.inc.php");

$query = "SELECT * FROM products ORDER BY id DESC";

$stmt = $conn->prepare($query);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: antiquewhite;
        }

        #bd {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        #tbl {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #tbl th,
        #tbl td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        #tbl th {
            background-color: #f2f2f2;
        }

        #tbl tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #tbl tr:hover {
            background-color: #e0e0e0;
        }

        .action-links a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        .nav-buttons {
            margin-top: 10px;
        }

        .nav-buttons a {
            display: inline-block;
            margin: 0 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-buttons a:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <div id="bd">
        <div class="nav-buttons">
            <a href="../users/dashboard.php">Home</a>
            <a href="../auth/logout.php">Logout</a>
        </div>

        <table id="tbl">
            <tr>
                <th>S. No.</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($products as $product) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $product['user_id'] ?></td>
                    <td><?php echo $_SESSION['username'] ?></td>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['quantity'] ?></td>
                    <td>Rs. <?php echo $product['price'] ?></td>
                    <td>Rs. <?php echo $product['quantity'] * $product['price'] ?></td>
                    <td class="action-links">
                        <?php
                        if ($_SESSION['type'] == 'admin') {
                            echo "<a href='delete.php?id={$product['id']}' onclick=\"return confirm('Are you sure you want to delete?')\">Delete</a>";
                        } else {
                            echo "No action available";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>