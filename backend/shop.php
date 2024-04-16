<?php
// Include the database connection file
// Start the session
session_start();
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

// Query to fetch products from the database
$sql = "SELECT * FROM product1";
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
    <!-- Heading and Sort by Category dropdown -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3 id="categoryHeading">All Products</h3>
            </div>

            <div class="col-sm-6">
                <div class="dropdown pull-right">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="glyphicon glyphicon-sort"></span> Sort by Category
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php
                        // Query to fetch categories
                        $category_query = "SELECT * FROM categories";
                        $category_result = $conn->query($category_query);
                        // Check if categories are fetched successfully
                        if ($category_result && $category_result->num_rows > 0) {
                            // Display categories as dropdown items
                            while ($category_row = $category_result->fetch_assoc()) {
                                // Sanitize category name
                                $category_name = htmlspecialchars($category_row['category_name']);
                                echo '<li><a href="#" class="category-item" data-category="' . $category_name . '">' . $category_name . '</a></li>';
                            }
                        } else {
                            // Handle case when no categories are found or there's an error
                            echo '<div class="col-lg-12">';
                            echo '<div class="alert alert-info" role="alert">';
                            echo 'Sorry, no products found for this category.';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="noProductsMessage" class="col-lg-12 alert alert-info text-center"
        style="margin-top: 60px; margin-bottom: 50px; display: none;">
        Sorry, no products found for this category.
    </div>


    <div class="container">
        <div class="row" id="product-list">
            <?php
            // Initialize search query variable
            $search_query = "";

            // Check if the search query is passed from the navbar
            if (isset($_GET['search_query'])) {
                // Retrieve and sanitize search query
                $search_query = $conn->real_escape_string($_GET['search_query']);

            }

            // Perform search query if search query is not empty
            if (!empty($search_query)) {
                // Construct SQL query for search
                $sql = "SELECT * FROM product1 WHERE Name LIKE '%$search_query%' OR Description LIKE '%$search_query%'";
            } else {
                // If no search query, fetch all products
                $sql = "SELECT * FROM product1";
            }

            // Execute query
            $result = $conn->query($sql);
            // Check if there are no results
            if ($result->num_rows === 0) {
                echo '<div class="col-lg-12" style="margin-top: 60px; margin-bottom: 50px;">';
                echo '<div class="alert alert-info" role="alert">';
                echo 'No products found matching your search criteria. Please try a different search term.';
                echo '</div>';
                echo '</div>';

            } else {
                // Loop through each row of the result set
                while ($row = $result->fetch_assoc()) {
                    // Output HTML for each product
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 product-item" data-category="' . $row['Category'] . '">';
                    echo '<a href="product_info1.php?product_id=' . $row['ID'] . '" style="text-decoration: none; color: inherit;">';
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

        function filterProducts(category) {
            // Hide the "no products found" message initially
            document.getElementById('noProductsMessage').style.display = 'none';

            // Hide all products
            document.querySelectorAll('.product-item').forEach(function (product) {
                product.style.display = 'none';
            });

            // Show products with the selected category
            var productsWithCategory = document.querySelectorAll('.product-item[data-category="' + category + '"]');
            if (productsWithCategory.length > 0) {
                productsWithCategory.forEach(function (product) {
                    product.style.display = 'block';
                });
            } else {
                // If no products found, display the "no products found" message
                document.getElementById('noProductsMessage').style.display = 'block';
            }

            // Toggle dropdown menu visibility
            var dropdownMenu = document.querySelector('.dropdown-menu');
            var isOpen = dropdownMenu.classList.contains('show');
            if (!isOpen) {
                var dropdownToggle = document.querySelector('.dropdown-toggle');
                dropdownToggle.click(); // Manually toggle the dropdown
            }
        }

        // Add event listener to category dropdown items
        document.querySelectorAll('.category-item').forEach(function (item) {
            item.addEventListener('click', function (event) {
                // Prevent default link behavior
                event.preventDefault();
                // Get selected category
                var category = this.dataset.category;
                // Filter products by category
                filterProducts(category);
                // Inside the event listener for category dropdown items
                updateHeading(category);

            });
        });
        // Get the heading element by its ID
        var categoryHeading = document.getElementById("categoryHeading");

        // Function to update the heading based on the selected category
        function updateHeading(category) {
            // Capitalize the first letter of the category name
            var categoryName = category.charAt(0).toUpperCase() + category.slice(1);
            // Update the heading text
            categoryHeading.innerText = categoryName;
        }
        // Define the updateHeading function
        function updateHeading(category) {
            var categoryHeading = document.getElementById("categoryHeading");
            if (categoryHeading) {
                categoryHeading.innerText = "Products related to " + category;
            }
        }

        // Check if a search query is present in the URL
        var urlParams = new URLSearchParams(window.location.search);
        var searchQuery = urlParams.get('search_query');

        // Update the heading if a search query is present
        if (searchQuery) {
            updateHeading(searchQuery);
        }


        function addToCart(productId) {
            <?php if (isset($_SESSION['customer_id'])) { ?>
                // Get the user ID from the session
                var userId = <?php echo $_SESSION['customer_id']; ?>;

                // Construct the data to be sent in the AJAX request
                var data = {
                    customer_id: userId,
                    product_id: productId
                };

                // Send an AJAX request to cart.php
                $.ajax({
                    url: 'cart.php',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        // Optionally, you can handle the response here (e.g., display a success message)
                        alert("Product added to cart!");
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.error(xhr.responseText);
                    }
                });
            <?php } else { ?>
                // User is not signed in, display a message prompting them to sign in
                alert("Please sign in to add products to your cart.");
                // Optionally, you can redirect the user to the login page
                // window.location.href = "login.php";
            <?php } ?>
        }


    </script>

</body>


</html>