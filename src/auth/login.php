<?php
$error = '';

session_start();
if (isset($_POST['login'])) {
include("../includes/config.inc.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform data filters
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    }
    echo "<br/>";
	echo "<a href='../index.php'>Go back</a>";
    // Check if there are any errors
    if (!empty($error)) {
        $error = "<b>There were the following error(s) in your form:</b><br>" . $error;
    } else {
        if (authenticateUser($username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['auth'] = true;
            $_SESSION['type'] = getUserType($username);
            $_SESSION['login_id'] = getUserId($username); 
            header('Location: ../users/dashboard.php');
            exit();
        } else {
            $error = "Invalid username or password.";
            }
        }
    }
}

function authenticateUser($username, $password)
{
    global $conn;
    $query = "SELECT * FROM users WHERE username = :username OR email = :username";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return true;
    } else {
        return false;
    }
}

function getUserId($username)
{
    global $conn;
    $query = "SELECT id FROM users WHERE username = :username OR email = :username";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user['id'];
}

function getUserType($username){
    global $conn;
    $query = "SELECT type FROM users WHERE username = :username OR email = :username";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user['type'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <?php if ($error) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username or Email">
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="btn" name="login">
            </div>

            <p>Don't have an account? <a href="register.php">Sign Up</a></p>

        </form>
    </div>
</body>

</html>