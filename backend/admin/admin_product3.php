<?php
session_start(); // Start the session

// Check if the admin_email session variable is set
if (!isset($_SESSION['admin_email'])) {
    // If not set, redirect to the login page
    header("Location: admin_login.php");
    exit; // Stop further execution
}

// Display success message if present
include 'admin_logout_nav.php';

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

// Handle product deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_product"])) {
    $product_id = $_POST["delete_product"];
    $delete_sql = "DELETE FROM product1 WHERE ID = '$product_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Retrieve all products
$sql = "SELECT * FROM product1";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    // Output data of each row
    $serial = 1; // Initialize serial number
    while ($row = $result->fetch_assoc()) {
        $row['serial'] = $serial++; // Add serial number to row
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 2px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 40px;">
        <!-- Content inside the container -->
        <h3>Product Dashboard</h3>
        <!-- Add Product Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="add_product1.php" enctype="multipart/form-data">
                    <!-- Changed action to add.php -->
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th> <!-- New column for Description -->
                        <th>Image</th> <!-- New column for Image -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td>" . $product['serial'] . "</td>"; // Display serial number
                            // Output product information
                            echo "<td>" . (isset($product['Name']) ? $product['Name'] : "Product name not available") . "</td>";
                            echo "<td>" . (isset($product['Category']) ? $product['Category'] : "Product category not available") . "</td>";
                            echo "<td>" . (isset($product['Price']) ? $product['Price'] : "Product price not available") . "</td>";
                            echo "<td>" . (isset($product['Quantity']) ? $product['Quantity'] : "Product quantity not available") . "</td>";
                            // Display Description
                            echo "<td>" . (isset($product['Description']) ? $product['Description'] : "Product description not available") . "</td>";
                            // Display Image
                            echo "<td>";
                            if (isset($product['Photo'])) {
                                echo "<img src='data:image/jpeg;base64," . base64_encode($product['Photo']) . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'>";
                            } else {
                                echo "No image available";
                            }
                            echo "</td>";

                            // Edit and Delete buttons
                            echo "<td>
                          <a href='update_product.php?id=" . $product['ID'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a>
                          <button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#confirmDeleteModal' data-productid='" . $product['ID'] . "'><i class='fas fa-trash'></i> Delete</button>
                          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Dialog Box for Delete Confirmation -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" id="deleteProductId" name="delete_product">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Font Awesome CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- JavaScript to handle delete button click and set product ID for deletion -->
        <script>
            $(document).ready(function () {
                $('#confirmDeleteModal').on('show.bs.modal', function (e) {
                    var productId = $(e.relatedTarget).data('productid');
                    $('#deleteProductId').val(productId);
                });
            });
        </script>
    </div>
</body>

</html>