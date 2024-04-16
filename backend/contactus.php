<?php
include'navbar_login.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        // Handle empty fields
        echo "Please fill out all fields.";
        exit;
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email
        echo "Invalid email address.";
        exit;
    }

    // Set the recipient email address
    $to = "bkr5668@gmail.com"; // Replace with your email address

    // Set the email subject
    $subject = "New Message from Keratin Nepal Contact Form";

    // Compose the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n\n";
    $email_message .= "Message:\n$message";

    // Send email
    if (mail($to, $subject, $email_message)) {
        // Email sent successfully
        echo "Your message has been sent.";
    } else {
        // Handle email sending failure
        echo "Failed to send email. Please try again later.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Keratin Nepal</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }





        h1,
        h2 {
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }



        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f64c72;
        }

        .form-group textarea {
            resize: vertical;
        }

        .btn {
            display: inline-block;
            background-color: #f64c72;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ff3366;
        }

        /* Media Queries */
        @media screen and (max-width: 768px) {
            header {
                padding: 30px 0;
            }

            h1 {
                font-size: 24px;
            }

            section {
                padding: 30px;
                border-radius: 0;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1 style="font-size: 30px;">Contact Us</h1>
    </header>
    <div class="container">
        <section>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" autocomplete="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>

    </div>
    </section>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>