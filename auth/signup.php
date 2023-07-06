<?php
include("../includes/config.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Password do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (saveUser($username, $email, $hashed_password)) {
            header('Location: index.php');
            exit();
        } else {
            $error = "Error occured while registering the user.";
        }
    }
}

function saveUser($username, $email, $hashed_password)
{
    global $conn;
    $query = "INSERT INTO users(username, email, password) VALUES (:username, :email, :password)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    return $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php if ($error) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <!-- <label for="Username/ Email">Username or Email</label> -->
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <!-- <label for="Password">Password</label> -->
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <!-- <label for="Password">Password</label> -->
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <input type="submit" value="Register" class="btn" name="register">
            </div>

        </form>
    </div>
</body>

</html>