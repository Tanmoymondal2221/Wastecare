<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>E-Center | WasteCare</title>
<link rel="stylesheet" href="css/E-center.css">



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
    <li><a href="index.php">Home</a></li>

    <li><a href="login.php"  class="btn-login">Login</a></li>
  </ul>
</header>

<div class="container">

    <h2 class="tittle">Find E-Waste Centers</h2>
    <p>Search your city to find nearby e-waste recycling centers</p>

    <!-- Search Form -->
    <form method="GET" class="search-box">
        <input type="text" name="city" class="form-control" placeholder="Enter city (e.g. Kolkata)" required>
        <button type="submit" class="btn btn-success mt-3">Search</button>
    </form>

    <!-- Show Result -->
    <?php if(isset($_GET['city'])): 
        $city = htmlspecialchars($_GET['city']);
    ?>

    <div class="map-container">
        <h4>Showing results for: <?= $city ?></h4>

        <!-- Google Map Embed -->
        <iframe 
            width="100%" 
            height="400" 
            style="border:0" 
            loading="lazy" 
            allowfullscreen
            src="https://www.google.com/maps?q=e-waste+recycling+in+<?= $city ?>&output=embed">
        </iframe>
    </div>

    <a href="https://www.google.com/search?q=e-waste+recycling+in+<?= $city ?>" target="_blank" class="btn btn-primary mt-3">
            View Full Results
   </a>

    <?php endif; ?>

</div>

</body>
</html>