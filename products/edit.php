<?php
session_save_path("c:/xampp/tmp");

session_start();
include("../includes/config.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ... (your existing code for updating the product)
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
        #fm {
            width: 300px;
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 10px;
        }
        .in {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align:center;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error {
            color: #ff0000;
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
            <a href="index.php">View Products</a>
            <a href="../auth/logout.php">Logout</a>
        </div>

        <div id="fm">
            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php else : ?>
                <h2>Edit Product</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="form-group">
                        <input class="in" type="text" name="name" id="name" placeholder="Name" value="<?php echo $product['name']; ?>">
                    </div>
                    <div class="form-group">
                        <input class="in" type="text" name="quantity" id="quantity" placeholder="Quantity" value="<?php echo $product['quantity']; ?>">
                    </div>
                    <div class="form-group">
                        <input class="in" type="text" name="price" id="price" placeholder="Price" value="<?php echo $product['price']; ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn" type="submit" value="Update" name="create">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
