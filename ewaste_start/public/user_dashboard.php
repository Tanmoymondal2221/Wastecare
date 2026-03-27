<?php
session_start();
if (!isset($_SESSION['user_type'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard | E-Waste Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #e8f5e9;
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            width: 240px;
            background-color: #2e7d32;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 40px;
        }

        .sidebar h3 {
            text-align: center;
            color: #a5d6a7;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #1b5e20;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .dashboard-card {
            background: #f1f8e9;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
        }

        .dashboard-card h4 {
            color: #2e7d32;
        }

        .btn-custom {
            background-color: #43a047;
            color: white;
            border-radius: 25px;
            padding: 8px 20px;
            transition: 0.3s;
            border: none;
        }

        .btn-custom:hover {
            background-color: #2e7d32;
        }

        .topbar {
            text-align: right;
            padding: 15px;
            background: #388e3c;
            color: white;
            font-size: 16px;
        }

        .topbar a {
            color: #ffcdd2;
            margin-left: 10px;
            text-decoration: none;
        }


        .download-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 5px;
        }

        .download-btn:hover {
           background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>👤 User Panel</h3>
        <a href="user_dashboard.php">🏠 Dashboard</a>
        
        
        <a href="my_products.php">📦 My Products</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="content">
        <div class="topbar">
            Welcome, 
            <!-- <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> -->
            <a href="logout.php">Logout</a>
        </div>

        <div class="dashboard-card">
            <h4>List Your Product Details</h4>
            <form action="list_product_action.php" method="POST">
                <div class="mb-3">
                    <label class="form-label" >Category</label>
                    <select id="category" class="form-select" name="category" onchange="showChecklist()" required>
                        <option value="">Choose Category</option>
                        <option value="Mobile">Mobile</option>
                        <option value="Laptop">Laptop</option>
                        <option value="TV">TV</option>
                        <option value="Battery">Battery</option>
                    </select>

                    <div id="security-alert" style="display:none; margin-top: 20px; padding: 15px; border: 2px solid #ffcc00; background-color: #fff9e6; border-radius: 8px;">
                        <h4 style="color: #856404;">⚠️ Security Action Required!</h4>
                        <p>For your privacy, please perform a <b>Factory Reset</b> before submitting.</p>

                        <a href="guides/Wastecare_Resetguide.pdf" download class="download-btn">
                        Download Reset Guide (PDF)
                        </a>

                        <p style="margin-top:10px;">
                        <input type="checkbox" id="confirm-reset" required> 
                        <label for="confirm-reset">I have wiped my personal data.</label>
                        </p>
                   </div>




                </div>
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pickup Address</label>
                    <textarea class="form-control" name="pickup_address" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-custom">🚚 Pickup</button>
            </form>
        </div>
    </div>
    <script>
        function showChecklist() {
            var category = document.getElementById("category").value;
            var alertBox = document.getElementById("security-alert");
            
            if (category==="Mobile" || category==="Laptop") {
                alertBox.style.display = 'block';
            } else {
                alertBox.style.display = 'none';
            }
        }
    </script>
</body>
</html>