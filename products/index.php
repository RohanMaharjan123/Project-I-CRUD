<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../includes/config.inc.php");

$id = $_SESSION['login_id'];

$query = "SELECT * FROM products WHERE user_id= :id ORDER BY id DESC";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
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
            background-color: #f5f5f5;
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
        #tbl th, #tbl td {
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
            <a href="create.php">Create Products</a>
            <a href="../auth/logout.php">Logout</a>
        </div>

        <table id="tbl">
            <tr>
                <th>S. No.</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php foreach ($products as $product) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $product['name'] ?></td>
                <td><?php echo $product['qty'] ?></td>
                <td>Rs. <?php echo $product['price'] ?></td>
                <td class="action-links">
                    <a href="edit.php?id=<?php echo $product['id']?>">Edit</a>
                    <a href="delete.php?id=<?php echo $product['id']?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>
