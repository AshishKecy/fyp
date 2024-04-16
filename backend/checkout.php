<?php
session_start();
include 'navbar_login.php';
include 'cart.php'; // Include cart.php to fetch cart data

// Function to calculate total price of items in the cart
function calculateTotalPrice($cart_items)
{
    $totalPrice = 0;
    foreach ($cart_items as $item) {
        $subtotal = $item['quantity'] * $item['price'];
        $totalPrice += $subtotal;
    }
    return $totalPrice;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: #66afe9;
            outline: 0;
            box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
        }

        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #ff0000;
            font-size: 12px;
        }

        /* Styles for the invoice */
        .invoice {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice th,
        .invoice td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }

        .product-photo {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Checkout</h2>
        <!-- Product summary -->
        <div class="invoice">
            <h3>Order Summary</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $index => $item): ?>
                        <tr>
                            <td><?php echo ($index + 1); ?></td> <!-- Use $index + 1 for S.N -->
                            <td><?php echo $item['product_name']; ?></td>
                            <td>$<?php echo $item['price']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo $item['quantity'] * $item['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" class="total">Total Price</td>
                        <td>$<?php echo calculateTotalPrice($cart_items); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <form action="orders.php" method="post" id="checkout-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <span class="error-message" id="name-error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
                <span class="error-message" id="phone-error"></span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" class="form-control" rows="4" required></textarea>
                <span class="error-message" id="address-error"></span>
            </div>
            <div class="form-group">
                <label>Payment Method: Khalti</label>
                <input type="hidden" name="payment_method" value="khalti">
            </div>
            <?php foreach ($cart_items as $item): ?>
                <input type="hidden" name="product_name[]" value="<?php echo $item['product_name']; ?>">
                <input type="hidden" name="quantity[]" value="<?php echo $item['quantity']; ?>">
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary btn-lg btn-block" id="place-order-btn">Place Order</button>


        </form>


    </div>

    <script>
        // Handle form submission
        document.getElementById('checkout-form').addEventListener('submit', function (event) {
            var isValid = true;

            // Clear previous error messages
            var errorMessages = document.getElementsByClassName('error-message');
            for (var i = 0; i < errorMessages.length; i++) {
                errorMessages[i].innerText = '';
            }

            // Validate name
            var nameInput = document.getElementById('name');
            if (nameInput.value.trim() === '') {
                document.getElementById('name-error').innerText = 'Please enter your full name.';
                isValid = false;
            }

            // Validate email
            var emailInput = document.getElementById('email');
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value.trim())) {
                document.getElementById('email-error').innerText = 'Please enter a valid email address.';
                isValid = false;
            }

            // Validate address
            var addressInput = document.getElementById('address');
            if (addressInput.value.trim() === '') {
                document.getElementById('address-error').innerText = 'Please enter your address.';
                isValid = false;
            }

            if (!isValid) {
                // Prevent form submission if validation fails
                event.preventDefault();
            } else {
                // Redirect to orders.php after form submission
                window.location.href = 'orders.php';
            }
        });


    </script>
</body>

</html>