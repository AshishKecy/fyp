<?php
// Database connection parameters
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
?>