<?php
session_save_path("c:/xampp/tmp");

session_start();

session_destroy();

header("Location:../index.php");
?>
