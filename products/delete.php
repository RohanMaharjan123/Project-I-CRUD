<?php

session_start();

include("../includes/config.inc.php");

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id= :id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
if($_SESSION['type'] == 'admin'){
    header("Location: Aindex.php");
}else if($_SESSION['type'] == 'user'){
    header("Location: index.php");
}

?>