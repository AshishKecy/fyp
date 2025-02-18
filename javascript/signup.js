function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("errorMessage");

    // Basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorMessage.innerHTML = "Please enter a valid email address.";
        return false;
    }

    // Password length validation
    if (password.length < 6) {
        errorMessage.innerHTML = "Password must be at least 6 characters long.";
        return false;
    }

    // Clear error message if no validation errors
    errorMessage.innerHTML = "";
    return true;
}
