<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form class="signin-form" onsubmit="return validateForm()">
            <h2>Sign In</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Enter your password" required>
            </div>
            <div class="error-message" id="errorMessage"></div>
            <button type="submit">Sign In</button>
            <div class="forgot-password">
                <a href="/forgot-password">Forgot Password?</a>
            </div>
            <div class="signup-link">
                <span>Don't have an account? <a href="signup.html">Sign up</a></span>
            </div>
        </form>
    </div>

    <script src="../javascript/signup.js"></script>
</body>
</html>
