<?php
// Include the database connection file
include 'navbar_login.php';

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

// Initialize search query variable
$search_query = "";

// Check if the search query is passed from the navbar
if (isset($_GET['search_query'])) {
    // Retrieve and sanitize search query
    $search_query = $conn->real_escape_string($_GET['search_query']);
}

// Perform search query if search query is not empty
if (!empty($search_query)) {
    // Perform search query
    $sql = "SELECT * FROM product1 WHERE Name LIKE '%$search_query%' OR Description LIKE '%$search_query%'";
} else {
    // If no search query, fetch all products
    $sql = "SELECT * FROM product1";
}

// Execute query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Cards like Daraz</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s;
        }

        .product-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: contain;
        }

        .product-card .card-body {
            padding: 20px;
        }

        .product-card .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #ff5722;
            margin-bottom: 10px;
        }

        .product-card .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Display products -->
    <div class="container">
        <div class="row">
            <?php
            // Loop through each row of the result set
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Output HTML for each product
                    echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                    echo '<div class="product-card">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" class="card-img-top" alt="Product Image">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['Name'] . '</h5>';
                    echo '<p class="price">Rs' . $row['Price'] . '</p>';
                    echo '<a href="#" class="btn btn-primary" onclick="addToCart(' . $row['ID'] . ')">';
                    echo '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No products found</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Bootstrap JS (Optional) -->
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to add product to cart
        function addToCart(productId) {
            // Send an AJAX request to cart.php with the product ID
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "cart.php?action=add&product_id=" + productId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Optionally, you can handle the response here (e.g., display a success message)
                    alert("Product added to cart!");
                }
            };
            xhr.send();
        }
    </script>

</body>

</html>

<?php
// Close connection
$conn->close();
?>