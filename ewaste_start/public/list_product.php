<?php
session_start();
include("../app/config.php");

// Ensure only logged-in users
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$msg = "";
if (isset($_POST['submit'])) {
    $name  = $_POST['product_name'];
    $desc  = $_POST['description'];
    $uid   = $_SESSION['user_id'];

    $sql = "INSERT INTO products (user_id, product_name, description) 
            VALUES ('$uid', '$name', '$desc')";

    if ($conn->query($sql) === TRUE) {
        $msg = "✅ Product listed successfully!";
    } else {
        $msg = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Product</title>
</head>
<body>
    <h2>List Your E-Waste Product</h2>
    <form method="post">
        <input type="text" name="product_name" placeholder="Product Name" required><br><br>
        <textarea name="description" placeholder="Product Description" required></textarea><br><br>
        <button type="submit" name="submit">Add Product</button>
    </form>

    <p style="color:green;"><?php echo $msg; ?></p>

    <a href="user_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
