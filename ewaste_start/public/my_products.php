<?php
session_start();
include('../app/config.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM products WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>📦 My Product Pickup Requests</h2>
<hr>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">Product listed successfully!</div>
<?php endif; ?>

<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Pickup Address</th>
            <th>Status</th>
            <th>Created</th>
            <th>Pickup date</th>
            

        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['pickup_address'] ?></td>

            <td>
                <?php if ($row['status'] == 'pending'): ?>
                    <span class="badge bg-warning">Pending</span>
                <?php elseif ($row['status'] == 'collected'): ?>
                    <span class="badge bg-primary">Collected</span>
                <?php elseif ($row['status'] == 'recycled'): ?>
                    <span class="badge bg-success">Recycled</span>
                <?php else: ?>
                    <span class="badge bg-danger">Rejected</span>
                <?php endif; ?>
            </td>

            
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['assign_date'] ? $row['assign_date'] : 'Waiting'; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>