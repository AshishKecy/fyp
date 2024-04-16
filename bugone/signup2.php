<?php
// Database connection
include 'database_connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the customers table using prepared statement
    $stmt = $conn->prepare("INSERT INTO customers (name, address, phone, email, password) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $address, $phone_number, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        // Start the session
        session_start();
        // Store user information in session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        // You can store more user data in session if needed

        // Redirect the user to the home page or any other page
        header("Location: home_afterLogin.php");
        exit();
    } else {
        // Registration failed
        $error_message = "Registration failed. Please try again.";
    }
}

// Close database connection
mysqli_close($conn);
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

    <div class="container">
        <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" placeholder="Enter your number" required>
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