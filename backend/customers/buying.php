<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Place Order</h1>
        <form method="post" action="process_order.php">
            <div class="mb-3">
                <label for="productSelect" class="form-label">Select Product:</label>
                <select class="form-select" id="productSelect" name="product_id[]" multiple>
                    <?php
                    // Fetch products from database
                    // Replace this with your actual database query
                    $products = [
                        ['id' => 1, 'name' => 'Product 1'],
                        ['id' => 2, 'name' => 'Product 2'],
                        ['id' => 3, 'name' => 'Product 3']
                    ];

                    foreach ($products as $product) {
                        echo "<option value='" . $product['id'] . "'>" . $product['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantityInput" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantityInput" name="quantity[]" required>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</body>
</html>
