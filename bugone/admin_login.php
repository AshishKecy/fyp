<?php
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'admin_database.php';
    $email = $_POST["email"];
    $password = $_POST['password'];

    // Prepare and execute a parameterized query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM new WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Redirect to home.php
        header("Location: admin_home.php");
        exit; // Ensure that subsequent code is not executed after redirection
    } else {
        $showAlert = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-portal-spacing {
            margin-top: 16px;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .admin-portal {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="signin-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Admin Portal</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Admin Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Admin Password" required>
            </div>
            <div class="error-message" id="errorMessage">
                <?php
                if ($showAlert) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Incorrect email or password!';
                    echo '</div>';
                }
                ?>
            </div>
            <button type="submit">Sign In</button>
            <div class="signup-link">
                <a href="signin.php">Back</a>
            </div>
        </form>
    </div>
</body>

</html>