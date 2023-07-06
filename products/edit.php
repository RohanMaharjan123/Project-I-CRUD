<?php
session_start();
include("../includes/config.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    if (empty($name) || empty($qty) || empty($price)) {
        $error = "All fields are required.";
    } else {
        $query = "UPDATE products SET name = :name, qty = :qty, price = :price WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: index.php");
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product || $stmt->rowCount() === 0) {
        $error = "Product not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
</head>

<body>
<a href="../users/dashboard.php">Home</a> | <a href="index.php">View Products</a> | <a href="../auth/logout.php">Logout</a>
    <br><br>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php else : ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $product['name']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="qty" id="qty" placeholder="Quantity" value="<?php echo $product['qty']; ?>">
            </div>
            <div class="form-group">
                <input type="text" name="price" id="price" placeholder="Price" value="<?php echo $product['price']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Update" name="create" class="btn">
            </div>
        </form>
    <?php endif; ?>
</body>

</html>
