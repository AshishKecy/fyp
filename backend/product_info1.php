<?php
session_start();
include 'navbar_login.php';
// Include the database connection file
include 'database_connect.php';

// Check if product_id is provided in the URL
if (isset($_GET['product_id'])) {
    // Retrieve the product ID from the URL
    $product_id = $_GET['product_id'];

    // Prepare and execute the query to fetch product details based on the product ID
    $sql = "SELECT * FROM product1 WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        // Fetch product details
        $row = $result->fetch_assoc();
        $productName = $row['Name'];
        $category = $row['Category'];
        $price = $row['Price'];
        $quantity = $row['Quantity'];
        $description = $row['Description'];
        $photo = 'data:image/jpeg;base64,' . base64_encode($row['Photo']);
        // Note: You may need to handle the photo differently, such as displaying it as an image

        // Close the prepared statement and result set
        $stmt->close();
        $result->close();

        $sqlSimilarProducts = "SELECT ID, Name, Price, Photo FROM product1 WHERE Category = ? AND ID != ? LIMIT 4";
        $stmtSimilarProducts = $conn->prepare($sqlSimilarProducts);

        if (!$stmtSimilarProducts) {
            // Handle prepare error
            echo "Prepare error: " . $conn->error;
        } else {
            // Bind parameters and execute the statement
            $stmtSimilarProducts->bind_param("si", $category, $product_id);
            $stmtSimilarProducts->execute();
            $similarProductsResult = $stmtSimilarProducts->get_result();
        }

    } else {
        // Redirect to an error page if the product does not exist
        header("Location: error_page.php");
        exit();
    }
} else {
    // Redirect to an error page if product_id is not provided
    header("Location: error_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <!-- Bootstrap 3.3.7 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Additional Styles Go Here */
        .product-image-container {
            width: 300px;
            /* Set a fixed width */
            height: 300px;
            /* Set a fixed height */
            border: 2px solid #ddd;
            /* Add a border */
            border-radius: 10px;
            /* Add rounded corners */
            overflow: hidden;
            /* Hide any overflowing content */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
        }

        /* Custom styles for the product image */
        .product-image {
            width: 100%;
            /* Make the image fill the container */
            height: auto;
            /* Maintain aspect ratio */
            transition: transform 0.3s ease-in-out;
            /* Add a smooth transition effect */
        }



        /* Scale up the image on hover */
        .product-image:hover {
            transform: scale(1.05);
            /* Increase the size by 5% */
        }

        .product-details {

            padding: 15px;
            height: 300px;
            width: auto;
            /* Add some padding for spacing */
        }

        .quantity-container {
            display: flex;
            align-items: center;
        }

        .quantity-label {
            margin-right: 10px;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
        }

        .btn-quantity {
            font-size: 18px;
            padding: 5px 10px;
        }

        /* Ensure each row has up to 5 products */
        .similar-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* Distribute items evenly */
        }

        .similar-products .product-box {
            flex-basis: calc(20% - 30px);
            /* Adjust based on the number of products per row */
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s;
        }

        .similar-products .product-box:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .similar-products .product-box img {
            width: 100%;
            height: 200px;
            /* Adjust the height of the product image */
            object-fit: cover;
        }

        .similar-products .product-box .panel-body {
            padding: 20px;
        }

        .similar-products .product-box .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .similar-products .product-box .price {
            font-size: 16px;
            font-weight: bold;
            color: #ff5722;
            margin-bottom: 10px;
        }

        .similar-products .product-box .btn {
            width: 100%;
        }


        .number-input {
            display: flex;
            align-items: center;
        }

        .quantity::-webkit-inner-spin-button,
        .quantity::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity {
            width: 50px;
            text-align: center;
            border: 0.5px solid rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            padding: 5px;
        }

        .minus,
        .plus {
            background-color: #4158D0;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .minus:hover,
        .plus:hover {
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);

        }
    </style>
</head>

<body>
    <!-- Product Information Section -->
    <div class="container" style="height: 350px;">
        <!-- Main Product -->
        <div class="row">
            <div class="col-md-6">
                <div class="product-image-container">
                    <img src="<?php echo $photo; ?>" class="img-responsive product-image" alt="Product Image">
                </div>
            </div>
            <div class="col-md-6">
                <!-- Product Details Container -->
                <div class="product-details">
                    <h2 style="color: black; font-family: Roboto, sans-serif;">
                        <?php echo $productName; ?>
                    </h2>

                    <p class="price" style="color:red; font-size: 20px;">Rs
                        <?php echo $price; ?>
                    </p>
                    <hr style="border-top: 0.5px solid rgba(0, 0, 0, 0.1);">
                    <h4 style="color: black; font-family: Roboto, sans-serif;">Description</h4>
                    <p style="color: black; font-family: Roboto, sans-serif;">
                        <?php echo $description; ?>
                    </p>
                    <hr style="border-top: 0.5px solid rgba(0, 0, 0, 0.1);">
                    <!-- Quantity -->
                    <!-- Display the stock left -->
                    <div style="margin-bottom: 10px; font-size: 14px; opacity: 0.7;">
                        Stock Left: <?php echo $quantity; ?>
                    </div>
                    <div class="number-input">
                        <span style="margin-right: 10px; font-size: 14px; opacity: 0.7;">Quantity</span>
                        <button onclick="decrementQuantity()" class="minus">-</button>
                        <input class="quantity" id="quantity" min="1" name="quantity" value="1" type="number">
                        <button onclick="incrementQuantity()" class="plus">+</button>
                    </div>
                    <div style="margin-top: 10px;">
                        <a href="cart.php" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Add to cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Horizontal line for partition -->
    <hr style="height: 2px; border: none; background-color: #ddd; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.01);">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Similar Products</h2>
            </div>
            <div class="panel-body">
                <div class="row similar-products">
                    <?php
                    // Check if there are similar products
                    if ($similarProductsResult->num_rows > 0) {
                        // Calculate the number of products found
                        $num_products = $similarProductsResult->num_rows;

                        // Set the maximum number of columns per row
                        $max_columns = 4;

                        // Calculate the number of empty placeholder columns needed
                        $num_placeholders = $max_columns - $num_products;

                        // Loop through each product
                        $counter = 1;
                        while ($row = $similarProductsResult->fetch_assoc()) {
                            // Use the correct column names from your database table
                            $photo = 'data:image/jpeg;base64,' . base64_encode($row['Photo']);
                            $name = isset($row["Name"]) ? $row["Name"] : "";
                            $price = isset($row["Price"]) ? $row["Price"] : "";
                            $product_id = isset($row["ID"]) ? $row["ID"] : "";

                            // Output the product card
                            echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                            echo '<a href="product_info1.php?product_id=' . $product_id . '" class="product-link">';
                            echo '<div class="panel panel-default product-box">';
                            echo '<div class="panel-body">';
                            echo '<img src="' . $photo . '" class="img-responsive similar-product-image" alt="Product Image">';
                            echo '<h5 class="card-title">' . $name . '</h5>';
                            echo '<p class="price">$' . $price . '</p>';
                            echo '<a href="#" class="btn btn-primary">';
                            echo '<i class="fas fa-shopping-cart"></i> Add to cart';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';

                            // Increment the counter
                            $counter++;
                        }

                        // Output empty placeholder columns
                        for ($i = 0; $i < $num_placeholders; $i++) {
                            echo '<div class="col-lg-3 col-md-4 col-sm-6"></div>';
                        }
                    } else {
                        // No similar products found
                        echo '<div class="col-lg-12"><p>No similar products found.</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Bootstrap 3.3.7 JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery (Required for quantity input functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value, 10);
            if (isNaN(currentQuantity)) {
                currentQuantity = 0;
            }
            currentQuantity++;
            quantityInput.value = currentQuantity;
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value, 10);
            if (isNaN(currentQuantity)) {
                currentQuantity = 0;
            }
            if (currentQuantity > 1) {
                currentQuantity--;
            }
            quantityInput.value = currentQuantity;
        }

    </script>
</body>

</html>