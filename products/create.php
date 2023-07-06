<?php 
session_start();
include("../includes/config.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $qty = $_POST['qty'];
	$price = $_POST['price'];
    $id = $_SESSION['login_id'];
	
    if (empty($name) || empty($qty) || empty($price)) {
        $error = "All fields are required.";
    } else{
        $query = "INSERT INTO products(name, qty, price, user_id) VALUES (:name, :qty, :price, :id)";

        $stmt = $conn -> prepare($query);

        $stmt -> bindParam(':name', $name);
        $stmt -> bindParam(':qty', $qty);
        $stmt -> bindParam(':price', $price);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Products</title>
</head>

<body>
    
<a href="../users/dashboard.php">Home</a> | <a href="index.php">View Products</a> | <a href="../auth/logout.php">Logout</a>
    <br><br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <input type="text" name="name" id="name" placeholder="Name">
        </div>
        <div class="form-group">
            <input type="text" name="qty" id="qty" placeholder="Quantity">
        </div>
        <div class="form-group">
            <input type="text" name="price" id="price" placeholder="Price">
        </div>
        <div class="form-group">
            <input type="submit" value="Create" name="create" class="btn">
        </div>
    </form>
</body>

</html>