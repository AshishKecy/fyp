<?php
session_start(); // Start the session

// Check if the admin_email session variable is set
if (!isset($_SESSION['admin_email'])) {
    // If not set, redirect to the login page
    header("Location: admin_login.php");
    exit; // Stop further execution
}
include 'admin_logout_nav.php';

// Database connection code
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
    // Escape user inputs for security
    $category_name = $conn->real_escape_string($_POST['name']);

    // Check if the category already exists
    $check_query = "SELECT * FROM categories WHERE category_name = '$category_name'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Category already exists
        echo "<script>alert('Category already exists');</script>";
    } else {
        // Insert category into database
        $insert_query = "INSERT INTO categories (category_name) VALUES ('$category_name')";

        if ($conn->query($insert_query) === TRUE) {
            echo "<script>alert('Category added successfully');</script>";
        } else {
            echo "<script>alert('Error adding category: " . $conn->error . "');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
    <style>
        /* Container styles */
        .container {
            margin-top: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }

        /* Form styles */
        .add-product-form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            outline: 0;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-add-product {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: #007bff;
            color: #fff;
        }

        .btn-add-product:hover {
            background-color: #0056b3;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>

</head>

<>
    <div class="container">
        <form class="add-product-form" action="#" method="POST" enctype="multipart/form-data">
            <h2 class="mb-4">Add Category</h2>
            <div class="form-group">
                <label for="name">Category:</label>
                <input type="text" id="name" name="name" placeholder="Enter category name" required>
            </div>
            <button type="submit" name="add_category" class="btn btn-primary btn-add-product">Add Category</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

</html>