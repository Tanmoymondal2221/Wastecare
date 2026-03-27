<?php
session_start();
include('../app/config.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE products SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: manage_products.php?updated=1");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>