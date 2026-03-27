<?php

// E-Waste Management System - 



$servername = "localhost";   
$username   = "root";        
$password   = "";            
$dbname     = "ewaste_db";   


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}


date_default_timezone_set('Asia/Kolkata');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


define('BASE_URL', 'http://localhost/ewaste_start/public/');


?>