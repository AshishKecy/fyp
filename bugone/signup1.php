<?php
session_start(); // Start the session

// Include the database connection file
include 'database_connect.php';

// Function to redirect to a specific page
function redirect($page)
{
    header("Location: $page");
    exit;
}

// Function to display an error message
function displayError($message)
{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $message . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the name, address, phone, email, and password from the POST request
    $name = $_POST["name"];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        displayError("Invalid email format.");
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Hashed Password: " . $hashedPassword;


    // Prepare and execute the SQL statement to insert data into the database
    $sql = "INSERT INTO customers (name, address, phone, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $address, $phone, $email, $hashedPassword); // Bind hashed password

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Insertion successful
        redirect("signin.php");
    } else {
        // Insertion failed
        displayError("Error occurred while signing up: " . $stmt->error);
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Navigation bar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }

        .navbar__logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar__link {
            text-decoration: none;
            color: #fff;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar__logo">Keratin Nepal</div>
        <a href="home.php" class="navbar__link">Home</a>
    </div>
    <?php
    if (isset($error)) {
        displayError($error);
    }
    ?>
    <div class="container">
        <form class="signup-form" action="signup.php" method="POST">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Sign Up</button>
            <div class="login-link">
                <span>Already have an account? <a href="signin.php">Log in</a></span>
            </div>
        </form>
    </div>
</body>

</html>