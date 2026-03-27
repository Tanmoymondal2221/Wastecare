<?php

include('../app/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ewaste Manage</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header class="navbar">
  <nav>
    <div class="logo">
      <img src="image/wastecare.png" alt="WasteCare">
      <!-- <h1 class="loo">WASTE<span>care</span></h1> -->
    </div>
  </nav>
  <!-- <h1 class="logo">WASTE<span>care</span></h1> -->
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="E-center.php">E-center</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="login.php"  class="btn-login">Login</a></li>
  </ul>
</header>
<section class="hero">
  
    <h1>Smart Solutions for a <span>Greener</span> Planet</h1>
    <p>Join our initiative to recycle, reuse, and reduce electronic waste for a cleaner and greener planet..</p>
    
    <a href="register.php" class="btn">Get Started</a>
  
</section>


<section class="features">
  <h2>E-Waste Categories</h2>
  <div class="feature-grid">
  <div class="card">
   <div class="icon1"><img src="image/household.png" alt="household"></div>
    <h3>Household Equipment</h3>
    <br>
    <p>These constitute the largest volume of e-waste,including Refrigerators, Washing Machines.</p>
  </div>
  <div class="card">
       <div class="icon1"><img src="image/itwaste.png" alt="IT Equipment"></div>
        <h3>IT Equipment</h3>
        <br>
        <p>This category is rapidly growing with the increasing use of computers, smartphones, and other electronic devices.</p>
  </div>
  <div class="card">
       <div class="icon1"><img src="image/consumer.png" alt="Consumer Electronics"></div>
          <h3>Consumer Electronics</h3>
          <br>
              <p> Include Devices like televisions,tablets, and other consumer electronics that require proper disposal.</p>
        </div>
  </div>
</section>

<footer>
  <p>&copy; 2026| Wastecare Management Team. All rights reserved.</p>
</footer>
  
</body>
</html>