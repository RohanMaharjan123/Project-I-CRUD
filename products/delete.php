<?php
session_save_path("c:/xampp/tmp");

session_start();

include("../includes/config.inc.php");

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id= :id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: index.php");

?>