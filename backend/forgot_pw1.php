<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connect.php';
    $email = $_POST["email"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result of the prepared statement
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            // Redirect to reset_password.php
            header("Location: reset_pw1.php?email=$email");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Email address not found!
                  </div>';
        }
    } else {
        // Handle the case where the prepared statement execution fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../img/login_signup.jpeg');
            background-size: cover;
            /* Ensure the background image covers the entire body */
            background-position: center;
            /* Center the background image */
            background-repeat: no-repeat;
            /* Do not repeat the background image */
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        .container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="email"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form id="forgotPasswordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
            
        </form>
    </div>
</body>

</html>