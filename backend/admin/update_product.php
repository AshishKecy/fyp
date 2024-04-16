<?php
session_start(); // Start the session

// Check if the admin_email session variable is set
if (!isset($_SESSION['admin_email'])) {
    // If not set, redirect to the login page
    header("Location: admin_login.php");
    exit; // Stop further execution
}
include 'admin_logout_nav.php';

// Database connection code
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

// Establish the database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the notification message variable
$notification_message = "";

// Handle product addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Retrieve form data
    $product_name = $_POST["name"];
    $product_category = $_POST["category"];
    $product_price = trim(str_replace('Rs', '', $_POST["price"]));
    // Convert the price value to a decimal
    $product_price_numeric = floatval($product_price);
    $product_quantity = $_POST["quantity"];
    $product_description = $_POST["description"];
    // Handle file upload
    $photo_data = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    // Insert data into database
    $insert_sql = "INSERT INTO product1 (Name, Category, Price, Quantity, Description, Photo) 
           VALUES ('$product_name', '$product_category', '$product_price', '$product_quantity', '$product_description', '$photo_data')";
    // Execute the SQL query
// Execute the SQL query
    if ($conn->query($insert_sql) === TRUE) {
        // Set success notification message
        $notification_message = "New product added successfully";

        // Set a flag to indicate successful addition
        $is_success = true;
    } else {
        // Set error notification message
        $notification_message = "Error adding product: " . $conn->error;
        // Print the error message for debugging
        echo $notification_message;
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
    <style>
        /* Container styles */
        .container {
            margin-top: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form styles */
        .add-product-form {
            background-color: rgba(255, 255, 255, 0.5);
            /* More transparent white background */
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            outline: 0;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-add-product {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: #007bff;
            color: #fff;
        }

        .btn-add-product:hover {
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
        <form class="add-product-form" action="#" method="POST" enctype="multipart/form-data">
            <h2 class="mb-4">Update Product</h2>
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" placeholder="Enter category" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" placeholder="Enter price" required>

            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required min="1">

            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" placeholder="Enter description" rows="3"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Choose Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <!-- Corrected: Added name attribute to the button -->
            <button type="submit" name="add_product" class="btn btn-primary btn-add-product">Add Product</button>
        </form>
    </div>

    <!-- Display alert using JavaScript after the page has loaded -->
    <?php if (!empty($notification_message)): ?>
        <script>         window.onload = function () { var notificationMessage = "<?php echo $notification_message; ?>"; alert(notificationMessage); };
        </script>
    <?php endif; ?>
    <script>
        document.getElementById("price").addEventListener("input", function (event) {
            // Get the input value
            let priceValue = event.target.value.trim();

            // Check if the value is numeric
            if (!isNaN(parseFloat(priceValue)) && isFinite(priceValue)) {
                // If numeric, prepend "Rs" to the value
                event.target.value = 'Rs ' + priceValue;
            }
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>