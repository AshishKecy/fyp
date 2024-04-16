<?php
session_start();

// Check if the email is set in the URL parameters
if (!isset($_GET['email'])) {
    // Redirect to the signup page if email is not set
    header("Location: signup.php");
    exit();
}

$email = $_GET['email'];

// Handle form submission for OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the OTP code entered by the user
    $entered_otp = "";
    if (isset($_POST["otp"])) {
        $entered_otp = implode("", $_POST["otp"]);
    }

    // Retrieve the stored OTP code from the database
    include 'database_connect.php';
    $stmt = $conn->prepare("SELECT otp_code FROM grahak WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($stored_otp);
    $stmt->fetch();
    $stmt->close();

    // Verify the entered OTP code
    if (trim($entered_otp) === trim($stored_otp)) {
        // OTP code is correct
        // Delete the OTP code from the database
        $delete_stmt = $conn->prepare("UPDATE grahak SET otp_code = NULL, verified = 1 WHERE email = ?");
        $delete_stmt->bind_param("s", $email);
        $delete_stmt->execute();
        $delete_stmt->close();

        // Redirect the user to a success page
        header("Location: verification_success.php");
        exit();
    } else {
        // OTP code is incorrect
        $error_message = "Invalid OTP code. Please try again.";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        .otp-input-container {
            display: flex;
            justify-content: space-between;
        }

        .otp-input {
            width: calc(100% / 6);
            padding: 15px;
            border: 2px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        /* Ensure inputs are displayed in one line */
        input[type="text"].otp-input {
            display: inline-block;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        #resendOTP {
            margin-top: 20px;
        }

        #resendOTP p {
            text-align: center;
            font-size: 14px;
        }

        #countdown {
            font-weight: bold;
        }

        #resendLink {
            color: blue;
            cursor: pointer;
            text-decoration: underline;
        }

        #resendLink:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <p>We have sent you an email to verify your email address. Please enter the OTP code below:</p>

        <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>

        <form id="otpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?email=$email"; ?>"
            method="post">
            <label for="otp1">Enter OTP code:</label>
            <div class="otp-input-container">
                <input type="text" class="otp-input" id="otp1" name="otp[]" maxlength="1" pattern="[0-9]" required
                    autofocus>
                <input type="text" class="otp-input" id="otp2" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" class="otp-input" id="otp3" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" class="otp-input" id="otp4" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" class="otp-input" id="otp5" name="otp[]" maxlength="1" pattern="[0-9]" required>
                <input type="text" class="otp-input" id="otp6" name="otp[]" maxlength="1" pattern="[0-9]" required>
            </div>
            <button type="submit" id="verifyButton" style="margin-top: 10px;">Verify OTP</button>
        </form>
        <!-- Resend OTP link container -->

        <div style="margin-top: 20px; text-align: center;"> <!-- Adjust margin-top and other styles as needed -->
            <!-- Resend OTP section -->
            <div id="resendContainer" style="display: none;">
                <span style="font-size: 12px;">Resend OTP in</span>
                <span id="countdown" style="font-size: 12px;">1:59</span>
                <!-- Apply inline CSS to remove underline -->
                <a id="resendLink" href="javascript:void(0)" onclick="resendOTP()"
                    style="font-size: 12px; text-decoration: none;">Resend OTP</a>
            </div>
        </div>



    </div>

    <script>
        // Function to allow only numeric input for OTP fields
        document.addEventListener('DOMContentLoaded', function () {
            var inputs = document.querySelectorAll('.otp-input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keypress', function (event) {
                    // Get the key code of the pressed key
                    var keyCode = event.keyCode || event.which;

                    // Allow only numeric characters (0-9)
                    if (keyCode < 48 || keyCode > 57) {
                        event.preventDefault();
                    }
                });
                inputs[i].addEventListener('input', function () {
                    if (this.value.length === this.maxLength) {
                        var index = Array.prototype.indexOf.call(inputs, this);
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });
            }
        });

        // Resend OTP functionality
        let resendTimer = null;
        let timeRemaining = 119; // Initial time in seconds (1 minute and 59 seconds)

        // Function to update the countdown timer
        function updateCountdown() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            document.getElementById('countdown').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (timeRemaining <= 0) {
                clearInterval(resendTimer);
                document.getElementById('resendContainer').style.display = 'block'; // Show the resend container
            }
        }

        // Function to start the countdown timer
        function startCountdown() {
            resendTimer = setInterval(function () {
                timeRemaining--;
                updateCountdown();
            }, 1000);
        }

        // Function to resend OTP
        function resendOTP() {
            clearInterval(resendTimer); // Stop the countdown timer
            // Implement logic to resend OTP (e.g., make an AJAX request to your server to send the OTP again)
            // Display a message to the user indicating that OTP has been resent
            document.getElementById('resendContainer').style.display = 'none'; // Hide the resend container
            document.getElementById('countdown').textContent = '1:59'; // Reset the countdown
            // Simulating OTP resend
            setTimeout(function () {
                // Simulated OTP resend successful
                startCountdown(); // Restart the countdown timer
            }, 2000); // Simulated delay for demonstration purposes (2 seconds)
        }

        // Start the countdown timer when the page loads
        document.addEventListener('DOMContentLoaded', startCountdown);

    </script>

</body>

</html>