<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-section {
            text-align: center;
        }

        .profile-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 4px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
            color: #fff;
        }

        .username {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .change-password {
            text-align: center;
            margin-bottom: 20px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #d44427;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-section">
            <div class="profile-circle" id="profileCanvas">
                <?php
                // Function to generate initials from username
                function generateInitials($username) {
                    $names = explode(" ", $username);
                    $initials = "";
                    foreach ($names as $name) {
                        $initials .= strtoupper($name[0]);
                    }
                    return $initials;
                }

                // Example usage: Generate profile image for user "Max Jos"
                $username = "Max Jos";
                $initials = generateInitials($username);
                ?>
                <canvas width="150" height="150"></canvas>
                <script>
                    // Function to generate a profile image based on user initials
                    function generateProfileImage(initials) {
                        var canvas = document.querySelector("#profileCanvas canvas");
                        var ctx = canvas.getContext("2d");

                        // Set background color
                        ctx.fillStyle = "#007bff"; // You can customize the background color
                        ctx.fillRect(0, 0, canvas.width, canvas.height);

                        // Set text properties
                        ctx.font = "bold 48px Arial";
                        ctx.fillStyle = "#fff"; // You can customize the text color
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";

                        // Draw initials
                        ctx.fillText(initials, canvas.width / 2, canvas.height / 2);
                    }

                    // Generate profile image
                    generateProfileImage("<?php echo $initials; ?>");
                </script>
            </div>
            <div class="username"><?php echo $username; ?></div>
        </div>
        <div class="change-password">
            <a href="change_password.php" style="color: #007bff; text-decoration: none;">Change Password</a>
        </div>
        <form method="post" action="logout.php">
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
