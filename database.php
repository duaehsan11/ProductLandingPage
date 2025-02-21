<?php
$host = "localhost";    // Database host (Keep "localhost" for local servers)
$user = "root";         // Default MySQL username for XAMPP/WAMP
$password = "";         // Default is empty for local development
$dbname = "Product_db"; // Name of your database

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

?>
