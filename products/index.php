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
</head>

<body>
<a href="../users/dashboard.php">Home</a> | <a href="create.php">Create Products</a> | <a href="../auth/logout.php">Logout</a>
	<br/><br/>    

    <table>
        <tr bgcolor='#CCC'>
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
                <td>
                    <a href="edit.php?id=<?php echo $product['id']?>">Edit</a>
                    <a href="delete.php?id=<?php echo $product['id']?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>