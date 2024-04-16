<?php
// Start the session
session_start();

// Include necessary files
include 'database_connect.php';

// Initialize showAlert to false
$showAlert = false;

// Define $stmt variable
$stmt = null;

// Initialize $incorrectPassword flag
$incorrectPassword = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]); // Trim whitespace from email
    $password = $_POST['password'];

    // Prepare a statement to retrieve the hashed password and customer_id from the database
    $stmt = $conn->prepare("SELECT customer_id, name, email, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $customer_id = $row['customer_id']; // Retrieve the customer_id

        if (password_verify($password, $hashed_password)) {
            // Store user email and customer_id in session variables
            $_SESSION['user_email'] = $email;
            $_SESSION['customer_id'] = $customer_id; // Store the customer_id in the session

            // Return success response
            echo json_encode(array("success" => true));
            exit(); // Ensure that subsequent code is not executed after returning JSON response
        } else {
            // Return error response
            echo json_encode(array("success" => false, "message" => "Incorrect password"));
            exit(); // Ensure that subsequent code is not executed after returning JSON response
        }
    } else {
        // Return error response
        echo json_encode(array("success" => false, "message" => "User not found"));
        exit(); // Ensure that subsequent code is not executed after returning JSON response
    }
}

// Close statement if it's a valid object
if ($stmt instanceof mysqli_stmt) {
    $stmt->close();
}

// Close connection
$conn->close();

// Pass the $incorrectPassword flag to JavaScript
echo "<script>var incorrectPassword = " . ($incorrectPassword ? "true" : "false") . ";</script>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Login</title>
    <style>
        body {
            background-image: url('../img/background.jpg');
            /* Specify the path to your background image */
            background-size: cover;
            /* Cover the entire viewport */
            background-position: center;
            /* Center the background image */
            font-family: Arial, sans-serif;
            /* Specify a fallback font family */
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
            height: 100vh;
            /* Set the height of the body to fill the viewport */
            display: flex;
            /* Use flexbox for centering content vertically */
            align-items: center;
            /* Center content vertically */
            justify-content: center;
            /* Center content horizontally */
        }

        .container {
            width: 100%;
            max-width: 320px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
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
        <form id="signin-form" class="signin-form" action="Signin.php" method="POST" onsubmit="return validateForm()">

            <h2>Log In</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required
                    autocomplete="email">
                <span id="emailAlert" style="color: red;"></span> <!-- Alert message placeholder -->
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        autocomplete="current-password">
                    <i class="far fa-eye password-toggle" id="eyeIcon" style="display: none;"></i>
                </div>
                <span id="passwordAlert" style="color: red;"></span> <!-- Password alert message placeholder -->
            </div>
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
            <!-- Add the back icon here -->
            <div class="back-link">
                <a href="home.php"><i class="fas fa-arrow-left"></i></a>
            </div>

        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            const emailField = document.getElementById("email");
            const passwordAlert = document.getElementById("passwordAlert");

            // Check if password field has initial content on page load
            if (passwordField.value.length > 0) {
                eyeIcon.style.display = "block";
            }

            // Toggle eye icon visibility on input event
            passwordField.addEventListener("input", function () {
                if (passwordField.value.length > 0) {
                    eyeIcon.style.display = "block";
                } else {
                    eyeIcon.style.display = "none";
                }
            });

            // Toggle password visibility on eye icon click
            eyeIcon.addEventListener("click", function () {
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                eyeIcon.classList.toggle("fa-eye-slash");
            });

            emailField.addEventListener("input", function () {
                const email = emailField.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === "") {
                    emailField.style.borderColor = ""; // Reset border color
                    document.getElementById("emailAlert").innerText = ""; // Clear error message
                } else if (!emailRegex.test(email)) {
                    emailField.style.borderColor = "red";
                    document.getElementById("emailAlert").innerText = "Invalid email address";
                } else {
                    emailField.style.borderColor = "green";
                    document.getElementById("emailAlert").innerText = "";
                }
            });

            function validateForm() {
                const email = emailField.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === "") {
                    emailField.style.borderColor = "red";
                    document.getElementById("emailAlert").innerText = "Email is required";
                    return false;
                } else if (!emailRegex.test(email)) {
                    emailField.style.borderColor = "red";
                    document.getElementById("emailAlert").innerText = "Invalid email address";
                    return false;
                }

                return true;
            }

            // Event listener for form submission
            document.getElementById("signin-form").addEventListener("submit", function (event) {
                // Prevent default form submission
                event.preventDefault();

                // Call function to handle form submission asynchronously
                submitForm();
            });

            // Function to handle form submission
            function submitForm() {
                const formData = new FormData(document.getElementById("signin-form"));
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "Signin.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            window.location.href = "home.php"; // Redirect if login successful
                        } else {
                            // Handle error message display
                            passwordAlert.innerText = response.message;
                        }
                    }
                };
                xhr.send(formData);
            }

            // Check if incorrect password flag is set
            if (incorrectPassword) {
                passwordField.style.borderColor = "red"; // Set border color to red
                passwordAlert.innerText = "Incorrect password"; // Display error message
            }

            // Event listener for the password field
            passwordField.addEventListener("input", function () {
                const password = passwordField.value;

                if (password.length > 0) { // Check if there's input in the password field
                    // Reset the border color and any existing error message
                    passwordField.style.borderColor = "";
                    passwordAlert.innerText = "";
                }
            });

            function validatePassword() {
                const password = passwordField.value;
                if (password === "") {
                    passwordField.style.borderColor = "red";
                    passwordAlert.innerText = "Password is required";
                    return false;
                }

                return true;
            }

            // Form submission event listener
            document.getElementById("signin-form").addEventListener("submit", function (event) {
                if (!validatePassword()) {
                    event.preventDefault();
                }
            });

            // Clear the incorrect password alert after a short delay
            setTimeout(function () {
                passwordAlert.innerText = "";
            }, 3000); // Adjust the delay time as needed
        });


    </script>


</body>

</html>