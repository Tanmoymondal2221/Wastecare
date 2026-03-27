<?php
session_start();
include('../app/config.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}


$search = $_GET['search'] ?? "";
$status = $_GET['status'] ?? "";

// Base query
$query = "SELECT p.*, u.name AS user_name, u.email 
          FROM products p 
          JOIN users u ON p.user_id = u.id
          WHERE 1";

// Search filter
if (!empty($search)) {
    $query .= " AND (u.name LIKE '%$search%' 
                OR u.email LIKE '%$search%' 
                OR p.product_name LIKE '%$search%')";
}

// Status filter
if (!empty($status)) {
    $query .= " AND p.status = '$status'";
}

$query .= " ORDER BY p.created_at ASC";

$result = $conn->query($query);


$query = "SELECT p.*, u.name AS user_name, u.email 
          FROM products p 
          JOIN users u ON p.user_id = u.id
          ORDER BY p.created_at ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Pickup Requests</title>
    <link rel="stylesheet" href="css/manage_products.css">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">
        <img src="image/wastecare.png" alt="WasteCare">
    </div>
</header>

<div class="container">

    <!-- HEADER -->
    <div class="header-box">
        <h2>All Pickup Requests</h2>
        <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>
    </div>

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Assign Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['user_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['pickup_address'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['assign_date'] ? $row['assign_date'] : 'Not Assigned'; ?></td>

                    <td>

                        <!-- STATUS -->
                        <form action="admin_update_status.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <select name="status" required>
                                <option value="">Status</option>
                                <option value="pending">Pending</option>
                                <option value="collected">Collected</option>
                                <option value="recycled">Recycled</option>
                                <option value="rejected">Rejected</option>
                            </select>

                            <button type="submit" class="btn green">Update</button>
                        </form>

                        <!-- ASSIGN DATE -->
                        <form action="admin_assign_date.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <input type="date" name="assign_date" value="<?= $row['assign_date']; ?>">

                            <button type="submit" class="btn blue">Assign</button>
                        </form>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

    </div>

</div>

</body>
</html>