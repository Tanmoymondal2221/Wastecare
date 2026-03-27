<?php
session_start();
include('../app/config.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

$query = "SELECT id, name, email, role FROM users ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/manage_users.css">
    
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">
        <img src="image/wastecare.png" alt="WasteCare">
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="container">

    <div class="header-box">
        <h2>All registered Users</h2>
        <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>
    </div>

    <div class="card">

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['role']; ?></td>
                </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>