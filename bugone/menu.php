<?php
// Database connection code
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables to store form input
$product_name = $product_category = $product_price = $product_quantity = "";
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST["product_name"];
    $product_category = $_POST["product_category"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];

    // Check if a product with the same name already exists
    $check_sql = "SELECT * FROM product WHERE Name = '$product_name'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        $error_message = "Error: Product with the same name already exists";
    } else {
        // Insert data into database if no duplicate entry found
        $insert_sql = "INSERT INTO product (Name, Category, Price, Quantity) VALUES ('$product_name', '$product_category', '$product_price', '$product_quantity')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "New product added successfully";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve all products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Product Dashboard</h1>
        <!-- Add Product Form -->
        <div class="card mb-4">
            <div class="card-header">
                Add Product
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="product_name" placeholder="Product Name"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <!-- Add ID attribute to the Category input field -->
                            <input type="text" class="form-control" id="product_category" name="product_category"
                                placeholder="Category" required>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" class="form-control" name="product_price" placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="number" class="form-control" name="product_quantity" placeholder="Quantity"
                                required>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Display Product Table -->
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            if (isset($product['Name'])) {
                                echo "<td>" . $product['Name'] . "</td>";
                            } else {
                                echo "<td>Product name not available</td>";
                            }
                            if (isset($product['Category'])) {
                                echo "<td>" . $product['Category'] . "</td>";
                            } else {
                                echo "<td>Product category not available</td>";
                            }
                            if (isset($product['Price'])) {
                                echo "<td>" . $product['Price'] . "</td>";
                            } else {
                                echo "<td>Product price not available</td>";
                            }
                            if (isset($product['Quantity'])) {
                                echo "<td>" . $product['Quantity'] . "</td>";
                            } else {
                                echo "<td>Product quantity not available</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- JavaScript code for autocomplete -->
    <script>
        $(document).ready(function () {
            // Define available categories (replace with your actual categories)
            var availableCategories = [
                "Facewash",
                "Face Cream",
                "Moisturizer",
                "Sunscreen"
                "Hair Treatment"
                "Perfume"
                "Body_Lotion"
                "Shampoo",
                "Conditioner",
                // Add more categories as needed
            ];

            // Enable autocomplete for the product category input field
            $("#product_category").autocomplete({
                source: availableCategories // Provide the array of category options as the data source
            });
        });
    </script>
</body>

</html>