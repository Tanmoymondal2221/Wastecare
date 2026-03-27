<?php
session_start();
include('../app/config.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$assign_date = $_POST['assign_date'];

$query = "UPDATE products SET assign_date='$assign_date' WHERE id=$id";

mysqli_query($conn, $query);

header("Location: manage_products.php");
exit();