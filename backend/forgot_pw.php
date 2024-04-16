<?php
include 'navbar_login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connect.php';
    $email = $_POST["email"];
    $phone = $_POST["phone_number"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM customers WHERE email = ? AND phone = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $email, $phone);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result of the prepared statement
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            // Redirect to reset_password.php
            header("Location: reset_pw2.php?email=$email");
            exit;
        } else {
            // Display an alert box
            echo '<script>alert("Email address and password combination not matched!");</script>';
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
    <link rel="stylesheet" href="../css/forgot_pw.css">
</head>

<body>
    <div class="container">
        <form class="forgotpwform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h2>Forgot Password</h2>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" placeholder="Enter your number" required>
            </div>

            <div class="form-group">
                <button type="submit1">Reset Password</button>
            </div>
            <div class="form-group text-center" style="margin-top: 20px;"> <!-- Add margin-top style to move it down -->
                <a href="Signin.php" class="btn btn-link">Back</a> <!-- Use Bootstrap button styles -->
            </div>
        </form>
    </div>
</body>

</html>