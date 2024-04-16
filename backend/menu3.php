<?php
include 'admin/admin_logout_nav.php';
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

// Handle product addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_name"])) {
    // Retrieve form data
    $product_name = $_POST["product_name"];
    $product_category = $_POST["product_category"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];

    // Insert data into database
    $insert_sql = "INSERT INTO product (Name, Category, Price, Quantity) VALUES ('$product_name', '$product_category', '$product_price', '$product_quantity')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Handle product deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_product"])) {
    $product_id = $_POST["delete_product"];
    $delete_sql = "DELETE FROM product WHERE ID = '$product_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Handle product editing and saving
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_product_id"])) {
    // Retrieve form data
    $product_id = $_POST["edit_product_id"];
    $product_name = $_POST["edit_product_name"];
    $product_category = $_POST["edit_product_category"];
    $product_price = $_POST["edit_product_price"];
    $product_quantity = $_POST["edit_product_quantity"];

    // Update data in database
    $update_sql = "UPDATE product SET Name = '$product_name', Category = '$product_category', Price = '$product_price', Quantity = '$product_quantity' WHERE ID = '$product_id'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Product details updated successfully";
    } else {
        echo "Error updating product details: " . $conn->error;
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">

<body>
    <div class="container" style="margin-top: 40px;">
        <!-- Content inside the container -->
        <h3>Product Dashboard</h3>
        <!-- Add Product Form -->
        <div class="card mb-4">

            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="product_name" placeholder="Product Name"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="product_category" placeholder="Category"
                                required>
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

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            // Output product information
                            echo "<td>" . (isset($product['Name']) ? $product['Name'] : "Product name not available") . "</td>";
                            echo "<td>" . (isset($product['Category']) ? $product['Category'] : "Product category not available") . "</td>";
                            echo "<td>" . (isset($product['Price']) ? $product['Price'] : "Product price not available") . "</td>";
                            echo "<td>" . (isset($product['Quantity']) ? $product['Quantity'] : "Product quantity not available") . "</td>";
                            // Edit button
                            echo "<td>
                            <a id=" . $product['ID'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a>
                            <button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#confirmDeleteModal' data-productid='" . $product['ID'] . "'><i class='fas fa-trash'></i> Delete</button>
                          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found</td></tr>";
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
        <!-- Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for editing product details -->
                        <form id="editProductForm">
                            <div class="form-group">
                                <label for="editProductName">Product Name</label>
                                <input type="text" class="form-control" id="editProductName" name="editProductName"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editProductCategory">Category</label>
                                <input type="text" class="form-control" id="editProductCategory"
                                    name="editProductCategory" required>
                            </div>
                            <div class="form-group">
                                <label for="editProductPrice">Price</label>
                                <input type="text" class="form-control" id="editProductPrice" name="editProductPrice"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editProductQuantity">Quantity</label>
                                <input type="number" class="form-control" id="editProductQuantity"
                                    name="editProductQuantity" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
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
            // JavaScript to trigger modal
            $(document).ready(function () {
                $('.edit-btn').click(function () {
                    // Get product details from the row
                    var productName = $(this).closest('tr').find('.product-name').text();
                    var productCategory = $(this).closest('tr').find('.product-category').text();
                    var productPrice = $(this).closest('tr').find('.product-price').text();
                    var productQuantity = $(this).closest('tr').find('.product-quantity').text();

                    // Populate modal input fields with product details
                    $('#editProductName').val(productName);
                    $('#editProductCategory').val(productCategory);
                    $('#editProductPrice').val(productPrice);
                    $('#editProductQuantity').val(productQuantity);

                    // Show the modal
                    $('#editProductModal').modal('show');
                });
            });
            // JavaScript to handle save changes button click
            $('#saveChangesBtn').click(function () {
                // Get updated product details from modal input fields
                var editedProductName = $('#editProductName').val();
                var editedProductCategory = $('#editProductCategory').val();
                var editedProductPrice = $('#editProductPrice').val();
                var editedProductQuantity = $('#editProductQuantity').val();

                // Send updated product details to the server via AJAX
                $.ajax({
                    url: 'update_product.php',
                    type: 'POST',
                    data: {
                        product_id: productId, // Assuming you have the product ID available
                        edited_product_name: editedProductName,
                        edited_product_category: editedProductCategory,
                        edited_product_price: editedProductPrice,
                        edited_product_quantity: editedProductQuantity
                    },
                    success: function (response) {
                        // Handle success response
                        console.log('Product details updated successfully');
                        // Optionally, update the UI to reflect the changes
                        // Close the modal
                        $('#editProductModal').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.error('Error updating product details:', error);
                    }
                });
            });


        </script>
</body>

</html>