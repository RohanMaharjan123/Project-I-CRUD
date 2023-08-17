<?php
session_save_path("c:/xampp/tmp");

session_start();

include("../includes/config.inc.php");

if ($_SESSION['type'] !== 'admin') {
    header("Location: ../users/dashboard.php");
    exit();
}

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = :id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: index.php");
exit();
?>
