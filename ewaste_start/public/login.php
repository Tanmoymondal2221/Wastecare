<?php
//session_start();
include('../app/config.php');

if (isset($_SESSION['user_type']) && basename($_SERVER['PHP_SELF']) == 'login.php') {
    // Prevent login page redirect loop
    if ($_SESSION['user_type'] == 'admin') {
        header('Location: admin_dashboard.php');
        exit();
    } elseif ($_SESSION['user_type'] == 'user') {
        header('Location: user_dashboard.php');
        exit();
    }
}

// Login Logic
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['role'];
            header('Location: ' . ($user['role'] == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
            exit();
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "No user found with this email!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | E-Waste Management System</title>
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
       background-color: #d7dad7;
       padding: 17px 60px;
       display: flex;
       justify-content: space-between;
       align-items: center;
    }

   .logo img{
    width: 250px;
    height: 50px;
    object-fit: cover;
   }

   

    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
    }
    .nav-link {
       background: #4CAF50;
       color: white !important;
       padding: 0.5rem 1.2rem;
       border-radius: 5px;
    }
    .nav-link:hover {
      color: #0e1099 !important;
    }
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 400px;
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
      <nav>
       <div class="logo">
         <img src="image/wastecare.png" alt="">
         <!-- <h1 class="loo">WASTE<span>care</span></h1> -->
       </div>
     </nav>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="index.php/#about">About</a></li> -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="card p-0 mt-5">
    <div class="card-body text-center">
      <h2 class="brand-title mb-3">Login</h2>
      <p class="text-muted mb-4">Access your E-Waste account</p>

      <?php if ($message): ?>
        <div class="alert alert-danger py-2"><?php echo $message; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" required placeholder="Enter your email">
        </div>
        <div class="mb-3 text-start">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-success mt-3">Login</button>
      </form>

      <div class="footer-text">
        <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>