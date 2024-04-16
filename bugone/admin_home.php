<?php
// Include the database connection file
include 'navbar_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 24px;
        }

        .nav-link {
            color: #fff;
        }

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

        /* Updated CSS for sticky navigation bar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .container {
            margin-top: 100px;
            /* Adjust margin to accommodate the fixed navigation bar */
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">logout</a>
                </li>
            </ul>
        </div>
    </nav>

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
            <!-- Categories box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-tags"></i></div>
                    <div class="box-title">Categories</div>
                    <a href="#" class="box-link">View Categories</a>
                </div>
            </div>
            <!-- Brands box -->
            <div class="col-md-4">
                <div class="box text-center mb-4">
                    <div class="box-icon"><i class="fas fa-building"></i></div>
                    <div class="box-title">Brands</div>
                    <a href="#" class="box-link">View Brands</a>
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