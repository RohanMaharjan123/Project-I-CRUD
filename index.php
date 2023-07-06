<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="auth/login.php" method="post">
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

            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>

        </form>
    </div>
</body>

</html>