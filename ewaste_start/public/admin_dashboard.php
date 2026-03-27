<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Get first name from email


$email = $_SESSION['email'] ?? "";
$name = explode('@', $email)[0] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

<header class="navbar">
    <div class="logo">
        <img src="image/wastecare.png" alt="WasteCare">
    </div>
</header>

<!-- <div class="header">
    <div>Admin Panel</div>
    <div class="welcome">Welcome, <?php echo ucfirst($name); ?> 👋,ADMIN</div>
</div> -->

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
        <a href="manage_products.php"><i class="fas fa-box"></i> Manage Products</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main">

        <h2>Dashboard Overview</h2>

        <div class="cards">

            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Users</h3>
                <p>Manage all registered users</p>
                <a href="manage_users.php">Open</a>
            </div>

            <div class="card">
                <i class="fas fa-box"></i>
                <h3>Products</h3>
                <p>Manage pickup requests</p>
                <a href="manage_products.php">Open</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>