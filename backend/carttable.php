<?php
session_start();
include 'navbar_login.php';
include 'cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .product-photo {
            max-width: 100px;
            height: auto;
        }

        .custom-number-input {
            display: flex;
            align-items: center;
        }

        .custom-number-input input[type="text"] {
            width: 30px;
            text-align: center;
            border: none;
        }

        .custom-number-input button {
            width: 30px;
            height: 30px;
            background-color: #ddd;
            border: none;
            cursor: pointer;
        }

        .custom-number-input button:hover {
            background-color: #ccc;
        }

        /* Style for the "+" and "-" buttons */
        .custom-number-input .btn-plus {
            border-left: none;
            border-radius: 0 4px 4px 0;
        }

        .custom-number-input .btn-minus {
            border-right: none;
            border-radius: 4px 0 0 4px;
        }


        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 8px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .continue-shopping-btn {
            flex: 1;
            margin-right: 5px;
            /* Adjust the margin as needed */
        }

        .checkout-btn {
            flex: 1;
            margin-left: 5px;
            /* Adjust the margin as needed */
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">Shopping Cart</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php if (!empty($cart_items)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Product Photo</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the $cart_items array and generate table rows
                            foreach ($cart_items as $index => $item) {
                                $subtotal = $item['quantity'] * $item['price'];
                                echo "<tr>
        <td>" . ($index + 1) . "</td>
        <td><img src='" . $item['product_photo'] . "' alt='Product Photo' class='product-photo'></td>
        <td>" . $item['product_name'] . "</td>
        <td>$" . $item['price'] . "</td>
        <td>
            <div class='custom-number-input'>
                <button class='btn-minus' onclick='decrementQuantity($index)'>-</button>
                <input type='text' id='quantity_$index' value='" . $item['quantity'] . "' class='quantity' readonly>
                <button class='btn-plus' onclick='incrementQuantity($index)'>+</button>
            </div>
        </td>
        <td>$" . $subtotal . "</td>
        <td>
            <!-- Form for deleting item from cart -->
            <form method='post' action='cart.php' onsubmit='return confirmDelete()'>
                <input type='hidden' name='delete_cart_item' value='" . $item['cart_id'] . "'> <!-- Hidden input field to send cart item ID -->
                <button type='submit' class='delete-btn'>Delete</button>
            </form>
        </td>
    </tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-cart text-center">
                        Your cart is empty.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="button-container">
            <button class="continue-shopping-btn btn btn-default">Continue Shopping</button>
            <a href="checkout.php" class="checkout-btn btn btn-primary">Proceed to Checkout</a>
        </div>


    </div>



    <script>
        function incrementQuantity(index) {
            var quantityInput = document.getElementById('quantity_' + index);
            var quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity)) {
                quantityInput.value = quantity + 1;
                updatePrices(); // Call the updatePrices function
            }
        }

        function decrementQuantity(index) {
            var quantityInput = document.getElementById('quantity_' + index);
            var quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity) && quantity > 1) {
                quantityInput.value = quantity - 1;
                updatePrices(); // Call the updatePrices function
            }
        }

        function updatePrices() {
            var cartItems = document.querySelectorAll("tbody tr");
            var totalPrice = 0;

            cartItems.forEach(function (item) {
                var quantity = parseInt(item.querySelector(".quantity").value); // Retrieve quantity from the input field with class 'quantity'
                var price = parseFloat(item.querySelector("td:nth-child(4)").innerText.replace("$", "")); // Retrieve price from the table cell

                var subtotal = quantity * price;
                item.querySelector("td:nth-child(6)").innerText = "$" + subtotal.toFixed(2);
                totalPrice += subtotal;
            });

            document.querySelector(".checkout-btn").innerText = "Proceed to Checkout - Total: $" + totalPrice.toFixed(2);
        }

        document.addEventListener("DOMContentLoaded", function () {
            // Add event listeners for quantity change
            var quantityInputs = document.querySelectorAll("tbody tr input");
            quantityInputs.forEach(function (input) {
                input.addEventListener("change", updatePrices);
            });

            // Add event listener for continue shopping button
            document.querySelector(".continue-shopping-btn").addEventListener("click", function () {
                // Redirect to the main shop page
                window.location.href = "shop.php";
            });

            // Initial price update
            updatePrices();
        });
        function confirmDelete() {
            return confirm("Are you sure you want to remove this item?");
        }

    </script>

</body>

</html>