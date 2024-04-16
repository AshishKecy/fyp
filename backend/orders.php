<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connect to the database (Replace with your database credentials)
include 'database_connect.php';

// Check if customer ID exists in session
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
} else {
    // Handle case where customer ID is not available in session
    // Redirect or display an error message
    exit("Customer ID not found in session.");
}

// Retrieve form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';

// Prepare and execute the SQL query to insert the order into the orders table
$sql = "INSERT INTO orders (customer_id, customer_name, email, phone_number, address, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Set parameters and execute
$customer_id = $_SESSION['customer_id']; // Retrieve customer ID from session
$status = 'Pending'; // Set initial status
$stmt->bind_param("isssss", $customer_id, $name, $email, $phone, $address, $status);
$stmt->execute();

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close database connection
$conn->close();
?>