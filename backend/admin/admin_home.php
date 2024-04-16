<?php
session_start(); // Start the session

// Check if the admin_email session variable is set
if (!isset($_SESSION['admin_email'])) {
    // If not set, redirect to the login page
    header("Location: admin_login.php");
    exit; // Stop further execution
}

// Include the database connection file
include 'admin_logout_nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Custom CSS -->
    <style>
        .container {
            margin-top: 100px;
            /* Adjust margin to accommodate the fixed navigation bar */
        }

        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .box:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .box-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .box-icon {
            font-size: 48px;
            color: #007bff;
        }

        .box-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .box-link:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <!-- Main content -->
    <div class="container">
        <div class="row mb-4">
            <!-- Products box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-box"></i></div>
                    <div class="box-title">Products</div>
                    <a href="admin_product3.php" class="box-link">View Products</a>
                </div>
            </div>
            <!-- Categories box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-tags"></i></div>
                    <div class="box-title">Categories</div>
                    <a href="category.php" class="box-link">View Categories</a>
                </div>
            </div>
            <!-- Brands box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-building"></i></div>
                    <div class="box-title">Brands</div>
                    <a href="view_brand.php" class="box-link">View Brands</a>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 20px;"></div>

        <div class="row mb-4">
            <!-- Customers box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-users"></i></div>
                    <div class="box-title">Customers</div>
                    <a href="customers.php" class="box-link">View Customers</a>
                </div>
            </div>
            <!-- Orders box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-shopping-cart"></i></div>
                    <div class="box-title">Orders</div>
                    <a href="../view_orders.php" class="box-link">View Orders</a>
                </div>
            </div>
            <!-- Payment box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-money-check-alt"></i></div>
                    <div class="box-title">Payments</div>
                    <a href="#" class="box-link">View Payments</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>