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
    
    // Perform data validation
    if (empty($username)) {
        $error .= "Username is required<br>";
    }
    if (empty($email)) {
        $error .= "Email field is empty<br>";
    }
    if (empty($password)) {
        $error .= "Password field is empty<br>";
    }
    if ($password !== $confirm_password) {
        $error .= "Passwords do not match!<br>";
    }
    echo "<br/>";
	echo "<a href='../index.php'>Go back</a>";
    if (!empty($error)) {
        $error = "<b>There were the following error(s) in your form:</b><br>" . $error;
    } else {
        // Check if the email already exists in the database
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $error = "Email already exists<br>";
        } else{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        if (saveUser($username, $email, $hashed_password)) {
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Error occured while registering the user.";
        }
    }
}
}

function saveUser($username, $email, $hashed_password)
{
    global $conn;
    $query = "INSERT INTO users(username, email, password,type) VALUES (:username, :email, :password,'user')";

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
                <label for="Username/ Email">Username: </label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="form-group">
            <label for="Username/ Email"> Email: </label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="Password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="Password">Confirm Password: </label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <input type="submit" value="Register" class="btn" name="register">
            </div>
            <p>Have an account already?<a href="login.php">Log in</a></p>

            
        </form>
    </div>
</body>

</html>