<?php
include 'nav_for_admin.php';
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
        // Start the session
        session_start();
        // Store admin email in session variable
        $_SESSION['admin_email'] = $email;
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

        .admin-portal-spacing {
            margin-top: 16px;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .admin-portal {
            display: inline-block;
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
            <button type="submit1">Sign In</button>
            <div class="form-group text-center" style="margin-top: 20px;"> <!-- Add margin-top style to move it down -->
                <a href="../Signin.php" class="btn btn-link">Back</a> <!-- Use Bootstrap button styles -->
            </div>
        </form>
    </div>
</body>

</html>