<?php
// Database connection
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "admin"; // Your database name

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productIds = $_POST['product_id'];
    $quantities = $_POST['quantity'];

    // Insert order into orders table
    $insertOrderSql = "INSERT INTO orders (customer_id, order_date) VALUES (1, NOW())"; // Assuming customer ID 1 for demonstration
    if ($conn->query($insertOrderSql) === TRUE) {
        $orderId = $conn->insert_id; // Get the ID of the newly inserted order

        // Insert order details into order_details table
        for ($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $quantity = $quantities[$i];

            // Fetch product price from products table (replace 'products' with your actual table name)
            $fetchProductPriceSql = "SELECT price FROM products WHERE product_id = $productId";
            $result = $conn->query($fetchProductPriceSql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $price = $row['price'];

                // Insert order details
                $insertOrderDetailSql = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                                         VALUES ($orderId, $productId, $quantity, $price)";
                if (!$conn->query($insertOrderDetailSql)) {
                    echo "Error inserting order detail: " . $conn->error;
                }
            } else {
                echo "Error fetching product price";
            }
        }
        echo "Order placed successfully!";
    } else {
        echo "Error inserting order: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>