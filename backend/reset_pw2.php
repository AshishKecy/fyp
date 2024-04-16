<?php
// Include the database connection file
include 'navbar_login.php';
include 'database_connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email and new password from the form
    $email = $_POST["email"];
    $new_password = $_POST["password"];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the hashed password in the database
    $sql = "UPDATE customers SET password = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Your password has been reset successfully. Please login."); window.location.href = "signin.php";</script>';
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Error resetting password. Please try again later.
                  </div>';
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/forgot_pw.css">
    <style>
        
        /* Popup styling */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_pw2.php" method="post">
            <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your new password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password"
                    placeholder="Confirm your new password" required>
            </div>
            <div class="form-group">
                <button type="submit1">Reset Password</button>
            </div>
        </form>
    </div>

    <!-- Popup message -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <p>Your password has been reset successfully. Please <a href="signin.php">login</a>.</p>
        </div>
    </div>

    <script>
        // JavaScript function to display the popup message
        function displayPopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "block";
        }

        // JavaScript function to close the popup message
        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }

        // Simulate password reset and display popup message
        function simulateReset() {
            // Simulate successful password reset
            // Here you can add any validation logic if needed
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            if (password === confirm_password) {
                // Passwords match, so simulate a successful reset
                displayPopup();
            } else {
                // Passwords don't match, you can display an error message if needed
                alert("Passwords don't match!");
            }
        }
    </script>
</body>

</html>