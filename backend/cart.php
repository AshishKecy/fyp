<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Establish database connection
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the action is to add a product to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Retrieve the product ID from the POST parameters
    $product_id = $_POST['product_id'];

    // Check if the product already exists in the cart for the logged-in customer
    $sql = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_SESSION['customer_id'], $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product already exists in the cart, so update the quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;

        // Prepare and execute the SQL query to update the quantity
        $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_quantity, $row['cart_id']);
        $stmt->execute();
    } else {
        // Prepare and execute the SQL query to retrieve the price of the product
        $sql = "SELECT Price FROM product1 WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the price from the result set
        $row = $result->fetch_assoc();
        $price = $row['Price'];

        // Close the statement
        $stmt->close();

        // Prepare and execute the SQL query to insert the product into the cart table
        $sql = "INSERT INTO cart (customer_id, product_id, price, quantity) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Set parameters and execute
        $customer_id = $_SESSION['customer_id']; // Retrieve customer ID from session
        $quantity = 1; // You can adjust the default quantity here
        $stmt->bind_param("iiid", $customer_id, $product_id, $price, $quantity);
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();

    // Optionally, you can redirect the user back to the shop page after adding the product to the cart
    header("Location: shop.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_cart_item'])) {
    // Check if the action is to delete an item from the cart
    $cart_item_id = $_POST['delete_cart_item'];

    // Prepare and execute the SQL query to delete the item from the cart
    $sql = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_item_id);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Redirect the user back to the cart page after deletion
    header("Location: carttable.php");
    exit();
} else {
    // Fetch cart items with product details using JOIN operation
    $sql = "SELECT cart.*, product1.Name AS product_name, product1.Photo AS product_photo FROM cart 
            INNER JOIN product1 ON cart.product_id = product1.ID 
            WHERE cart.customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['customer_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $cart_items = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Convert the binary photo data to base64 format
            $photo_base64 = base64_encode($row['product_photo']);
            // Create a data URI for the image
            $photo_data_uri = 'data:image/jpeg;base64,' . $photo_base64;
            // Add the data URI to the row
            $row['product_photo'] = $photo_data_uri;
            // Remove the 'photo' field from the row
            unset($row['photo']);
            $cart_items[] = $row;
        }
    }

    // Store cart items in session variables
    $_SESSION['cart_items'] = $cart_items;

    // Close the statement
    $stmt->close();
}

// Do not close the database connection here to allow other scripts to use the same connection
// The connection will be closed when the parent script (e.g., orders.php) finishes execution
?>