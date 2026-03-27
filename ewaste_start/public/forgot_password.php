<?php
include('../app/config.php');
session_start();

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Check if user exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        // Save reset token
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        if ($stmt->execute()) {
            // In a real setup, you'd email this link:
            $resetLink = "http://localhost/ewaste_start/public/reset_password.php?token=" . $token;
            $message = "✅ Password reset link generated!<br><a href='$resetLink'>Click here to reset password</a>";
        } else {
            $message = "❌ Something went wrong. Try again.";
        }
    } else {
        $message = "⚠️ No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | E-Waste Management</title>
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

  <!-- Forgot Password Card -->
  <div class="card p-0 mt-5">
    <div class="card-body text-center">
      <h2 class="brand-title mb-3">Forgot Password?</h2>
      <p class="text-muted mb-4">Enter your email to reset your password.</p>

      <?php if ($message): ?>
        <div class="alert alert-info py-2 text-start"><?php echo $message; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3 text-start">
          <label class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" required placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-success mt-3">Send Reset Link</button>
      </form>

      <div class="mt-3">
        <a href="login.php" class="text-success text-decoration-none">← Back to Login</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>