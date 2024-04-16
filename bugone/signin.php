<?php
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_connect.php';
    $email = $_POST["email"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Redirect to home.php
        header("Location: home_afterLogin.php");
        exit; // Ensure that subsequent code is not executed after redirection
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Incorrect email or password!
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form class="signin-form" action="signin.php" method="POST">
            <h2>Sign In</h2>
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
            <button type="submit">Sign In</button>
            <div class="forgot-password">
                <a href="forgot_pw.php">Forgot Password?</a>
            </div>
            <div class="admin_portal">
                <a href="admin_login.php">admin</a>
            </div>
            <div class="signup-link">
                <span>Don't have an account? <a href="signup.php">Sign up</a></span>
            </div>
        </form>
    </div>
</body>
</html>
