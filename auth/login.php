<?php
session_start();
include("../includes/config.inc.php");

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        if (authenticateUser($username, $password)) {
            $_SESSION['username'] = $username;
            header('Location: ../users/dashboard.php');
            exit();
        } else {
            $error = "Invalid username or password.";
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

?>