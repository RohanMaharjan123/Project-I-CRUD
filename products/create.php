<?php 
session_save_path("c:/xampp/tmp");
session_start();
include("../includes/config.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
	$price = $_POST['price'];
    $id = $_SESSION['login_id'];
	
    if (empty($name) || empty($quantity) || empty($price)) {
        $error = "All fields are required.";
    } else{
        $query = "INSERT INTO products(name, quantity, price, user_id) VALUES (:name, :quantity, :price, :id)";

        $stmt = $conn -> prepare($query);

        $stmt -> bindParam(':name', $name);
        $stmt -> bindParam(':quantity', $quantity);
        $stmt -> bindParam(':price', $price);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Products</title>
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
        #btn-group {
            margin-bottom: 20px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        #fm {
            width: 300px;
            margin-top: 10px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 10px;
        }
        .in {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align:center;
        }
        .error {
            color: #ff0000;
        }
        .btn-submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="bd">
        <div id="btn-group">
            <a href="../users/dashboard.php" class="btn">Home</a>
            <a href="index.php" class="btn">View Products</a>
            <a href="../auth/logout.php" class="btn">Logout</a>
        </div>
        <form id="fm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="form-group">
                <input class="in" type="text" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <input class="in" type="text" name="quantity" id="quantity" placeholder="Quantity">
            </div>
            <div class="form-group">
                <input class="in" type="text" name="price" id="price" placeholder="Price">
            </div>
            <div class="form-group">
                <input class="btn-submit" type="submit" value="Create" name="create">
            </div>
        </form>
    </div>
</body>

</html>
