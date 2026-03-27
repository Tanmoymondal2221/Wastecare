<?php
include('../app/config.php');
//session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user"; // default user role

    // Check if email exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "⚠️ Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);
        if ($stmt->execute()) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $message = "❌ Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | E-Waste Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #a8e063, #56ab2f);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #2d572c;
    }
    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
    }
    .nav-link {
      color: #fff !important;
    }
    .nav-link:hover {
      color: #a8e063 !important;
    }
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 430px;
      background-color: #fff;
    }
    .card-body {
      padding: 2.5rem;
    }
    .form-control {
      border-radius: 10px;
      padding: 10px;
    }
    .btn-success {
      background-color: #56ab2f;
      border: none;
      border-radius: 10px;
      padding: 10px;
      width: 100%;
      font-weight: 500;
    }
    .btn-success:hover {
      background-color: #3d7e21;
    }
    .brand-title {
      font-weight: 700;
      font-size: 1.8rem;
      color: #2d572c;
    }
    .footer-text {
      color: #2d572c;
      margin-top: 10px;
    }
    .footer-text a {
      color: #2d572c;
      text-decoration: none;
      font-weight: 500;
    }
    .footer-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">♻️ E-Waste Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Register Form -->
  <div class="card p-0 mt-5">
    <div class="card-body text-center">
      <h2 class="brand-title mb-3">Create Account</h2>
      <p class="text-muted mb-4">Join our E-Waste Management platform</p>

      <?php if ($message): ?>
        <div class="alert alert-warning py-2"><?php echo $message; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3 text-start">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" required placeholder="Enter your email">
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Create a password">
        </div>
        <button type="submit" class="btn btn-success mt-3">Register</button>
      </form>

      <div class="footer-text">
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>