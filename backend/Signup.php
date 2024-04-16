<?php
session_start(); // Start the session at the beginning
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/phpmailer/src/Exception.php';
require '../mail/phpmailer/src/PHPMailer.php';
require '../mail/phpmailer/src/SMTP.php';

include 'database_connect.php'; // Include database connection

$error_message = ''; // Initialize error message
$stmt = null; // Initialize $stmt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email is already in use
    $check_stmt = $conn->prepare("SELECT * FROM grahak WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Email is already in use, display an alert message
        $error_message = "Email is already in use. Please use a different email address.";
    } else {
        // Email is not in use, proceed with registration

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate OTP code - Example: Random 6-digit code
        $otp_code = sprintf('%06d', mt_rand(0, 999999));

        // Insert data into the grahak table using prepared statement
        $stmt = $conn->prepare("INSERT INTO grahak (name, email, password_hash, otp_code, verified) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            // Initialize verified column to 0 (not verified)
            $verified = 0;
            $stmt->bind_param("ssssi", $username, $email, $hashed_password, $otp_code, $verified);
            if ($stmt->execute()) {
                // Registration successful

                // Send verification email
                $mail = new PHPMailer(true);

                // Server settings
                $mail->isSMTP();                              // Send using SMTP
                $mail->Host = 'smtp.gmail.com';               // Set the SMTP server to send through
                $mail->SMTPAuth = true;                       // Enable SMTP authentication
                $mail->Username = 'bkr5668@gmail.com';        // SMTP email address
                $mail->Password = 'idqpdakgqrytywdh';         // SMTP password
                $mail->SMTPSecure = 'ssl';                    // Enable implicit SSL encryption
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('bkr5668@gmail.com', 'Your Website'); // Sender Email and name
                $mail->addAddress($email);                            // Add recipient's email dynamically
                $mail->addReplyTo('bkr5668@gmail.com', 'Your Website'); // Reply to sender email

                // Content
                $mail->isHTML(true);                          // Set email format to HTML
                $mail->Subject = 'Email Verification';        // Email subject headings
                $mail->Body = 'Your verification code is: ' . $otp_code; // Email message

                // Send the email
                $mail->send();

                // Redirect the user to the OTP verification page
                header("Location: otp_verify.php?email=" . urlencode($email));
                exit();
            } else {
                // Registration failed
                $error_message = "Registration failed. Please try again.";
            }
        } else {
            // Error preparing the statement
            $error_message = "An error occurred. Please try again later.";
        }
    }
}

// Close prepared statement if it's not null
if ($stmt !== null) {
    $stmt->close();
}

// Close database connection
$conn->close();

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
        <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Use htmlspecialchars to prevent XSS -->
            <h2>Sign Up</h2>
            <?php if (!empty($error_message)): ?>
                <div class="error"><?php echo $error_message; ?></div> <!-- Display error message -->
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your name" autocomplete="username"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="email"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password"
                    autocomplete="new-password" required>
            </div>
            <button type="submit1">Sign Up</button> <!-- Corrected button type -->
            <div class="login-link">
                <span>Already have an account? <a href="Signin.php">Log in</a></span>
            </div>
        </form>
    </div>
</body>

</html>