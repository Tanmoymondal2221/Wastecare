<?php
session_start();
include('../app/config.php');

// Check user login
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Check form values
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $category = $_POST['category'];
    $product_name = $_POST['product_name'];
    $pickup_address = $_POST['pickup_address'];

    // Insert into database
    $sql = "INSERT INTO products (user_id, category, product_name, pickup_address, status, created_at) 
            VALUES (?, ?, ?, ?, 'pending', NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $category, $product_name, $pickup_address);

    if ($stmt->execute()) {
        // Redirect to user product list
        header("Location: my_products.php?success=1");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>