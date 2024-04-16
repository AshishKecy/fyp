<?php
// Include the database connection file
include 'nav_for_admin.php';
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
            margin-top: 50px;
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

        .container {
            margin-top: 100px;
            /* Adjust margin to accommodate the fixed navigation bar */
        }
    </style>
</head>

<body>
    <!-- Main content -->
    <div class="container">
        <div class="row">
            <!-- Products box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-box"></i></div>
                    <div class="box-title">Products</div>
                    <a href="menu.php" class="box-link">View Products</a>
                </div>
            </div>
            <!-- Customers box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-users"></i></div>
                    <div class="box-title">Customers</div>
                    <a href="#" class="box-link">View Customers</a>
                </div>
            </div>
            <!-- Orders box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-shopping-cart"></i></div>
                    <div class="box-title">Orders</div>
                    <a href="#" class="box-link">View Orders</a>
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