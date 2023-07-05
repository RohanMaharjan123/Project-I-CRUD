<?php
session_start();
if (isset($_COOKIE['id']) && isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id']; // Stay logged in for a long time
    echo "<h3>Welcome, " . $_SESSION['username'] . "</h3>";
}


if (isset($_COOKIE['id']) || isset($_SESSION['id'])) {
    echo "<h2>Registration Success. <a href='index.php?logout=1'>Logout</a></h2>";
} else {
    header("Location: register.php");
    exit; // Add an exit statement after redirecting to prevent further code execution
}

?>

<html>
    <h3><a href = "register.php">go Back</a></h3>
</html>