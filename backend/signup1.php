<?php
// Database connection
include 'database_connect.php';
include 'navbar_login.php';

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
    <style>
        /* Container styles */
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form styles */


        .signup-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }


        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }


        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #66afe9;
        }


        button[type="submit1"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }

        button[type="submit1"]:hover {
            background-color: #0056b3;
        }



        .login-link {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="signup-form" action="Signup.php" method="POST">
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
            <button type="submit1">Sign Up</button>
            <div class="login-link">
                <span>Already have an account? <a href="Signin.php">Log in</a></span>
            </div>
        </form>
    </div>
</body>

</html>