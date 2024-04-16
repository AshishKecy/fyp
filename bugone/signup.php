<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connect.php'; // Include the database connection file

    // Get the email and password from the POST request
    $email = $_POST["email"];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) { // If user exists
        // Retrieve user data
        $row = $result->fetch_assoc();

        // Store user data in session variables for later use
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect to home page after successful login
        header("Location: home_afterLogin.php");
        exit; // Stop further execution
    } else {
        $error = "Incorrect email or password!";
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
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account has been successfully created
    </div>';
        echo '<script>setTimeout(function(){ window.location.href = "signin.php"; }, 2000);</script>';
    }
    ?>
    <div class="container">
        <form class="signup-form" action="signup.php" method="POST">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your name" required>
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