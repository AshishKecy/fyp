<?php
// Start or resume the session
session_start();
include 'navbar_login.php';

$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connect.php';
    $email = trim($_POST["email"]); // Trim whitespace from email
    $password = $_POST['password'];

    // Prepare a statement to retrieve the hashed password from the database
    $stmt = $conn->prepare("SELECT customer_id, name, email, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user information in session variables
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            // Redirect to home.php
            header("Location: home_afterLogin.php");
            exit; // Ensure that subsequent code is not executed after redirection
        } else {
            $showAlert = true;
        }
    } else {
        $showAlert = true;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// If login fails, show alert
if ($showAlert) {
    echo '<div class="alert alert-danger" role="alert">
            Incorrect email or password!
          </div>';
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .signin-form h2 {
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
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit1"]:hover {
            background-color: #0056b3;
        }

        .forgot-password,
        .admin_portal,
        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a,
        .admin_portal a,
        .signup-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password a:hover,
        .admin_portal a:hover,
        .signup-link a:hover {
            color: #0056b3;
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
        <form class="signin-form" action="Signin.php" method="POST">
            <h2>Log In</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <?php
            if ($showAlert) {
                echo '<div class="alert alert-success" role="alert">
                        Login successful!
                      </div>';
            }
            ?>
            <button type="submit1">Sign In</button>
            <div class="forgot-password">
                <a href="forgot_pw.php">Forgot Password?</a>
            </div>
            <div class="admin_portal">
                <a href="admin/admin_login.php">admin</a>
            </div>
            <div class="signup-link">
                <span>Don't have an account? <a href="Signup.php">Sign up</a></span>
            </div>
        </form>
    </div>
</body>

</html>