<?php
// Include the database connection file
session_start();
include 'navbar_login.php';

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
        .similar-products .product-card {
            margin-bottom: 20px;
            height: 300px;
            /* Adjust the height of the product card */
        }

        .similar-products .product-card img {
            max-height: 200px;
            /* Adjust the height of the product image */
            object-fit: cover;
            /* Ensure the image covers the designated area */
        }

        /* Remove padding from columns in the "Similar Products" section */
        .similar-products .product-card [class*="col-"] {
            padding-left: 5px;
            padding-right: 15px;
        }

        /* Add margin between product cards */
        .similar-products .product-card {
            margin-bottom: 20px;
        }

        /* Style for the horizontal line */
        hr {
            border: none;
            border-top: 2px solid black;
            /* Change the color of the line here */
            margin: 20px 0;
            /* Adjust the margin as needed */
            height: 2px;
            /* Adjust the thickness of the line */
        }
    </style>
</head>

<body>
    <!-- Product Information Section -->
    <div class="container">
        <!-- Main Product -->
        <div class="row">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/400" class="img-responsive" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2>Product Name</h2>
                <p class="price">$19.99</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan urna vel ligula lacinia, eget
                    aliquet ligula bibendum. Aenean varius, neque id vestibulum gravida, odio elit efficitur urna, ac
                    dapibus elit risus eget magna.</p>
                <div class="quantity-container">
                    <span class="quantity-label">Quantity:</span>
                    <button type="button" class="btn btn-default btn-quantity" data-type="minus" data-field="quantity">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number quantity-input"
                        value="1" min="1" max="10">
                    <button type="button" class="btn btn-default btn-quantity" data-type="plus" data-field="quantity">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </a>
            </div>
        </div>
        <!-- Horizontal line for partition -->
        <hr>
        <!-- Similar Products Section -->
        <h2>Similar Products</h2>
        <div class="row similar-products">
            <!-- Product Card 1 -->
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="product-card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="price">$19.99</p>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Add to cart
                        </a>
                    </div>
                </div>
            </div>
            <!-- Add more similar products here -->
            <!-- Product Card 2 -->
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="product-card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="price">$19.99</p>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Add to cart
                        </a>
                    </div>
                </div>
            </div>
            <!-- Repeat similar products until you have up to 5 per row -->
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
        $(document).ready(function () {
            $('.btn-quantity').click(function (e) {
                e.preventDefault();

                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function () {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function () {
                var minValue = parseInt($(this).attr('min'));
                var maxValue = parseInt($(this).attr('max'));
                var valueCurrent = parseInt($(this).val());

                if (valueCurrent >= minValue) {
                    $(".btn-quantity[data-type='minus']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-quantity[data-type='plus']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
            });
        });
    </script>

</body>

</html>