<?php
// Database connection code
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching products: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <style>
        /* Add your CSS styles here */
        .product {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product-details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="product">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['photo']); ?>" alt="<?php echo $row['name']; ?>">
                    <div class="product-details">
                        <h3><?php echo $row['name']; ?></h3>
                        <?php
                        // Debug output for description
                        echo "<p>Description: " . $row['description'] . "</p>";
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No products found";
        }
        ?>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
