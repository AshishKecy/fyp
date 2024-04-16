<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="mb-4">Product Dashboard</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="product_category" name="product_category" placeholder="Category" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Choose Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_description" class="form-label">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" placeholder="Product Description" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
