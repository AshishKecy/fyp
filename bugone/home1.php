<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar {
            background-color: #343a40;
            /* Darker background color */
            color: #fff;
            /* Light text color */
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
        }

        .navbar__logo {
            font-size: 24px;
            font-weight: bold;
            margin-right: 20px;
            /* Add margin for spacing */
        }

        .navbar__link {
            text-decoration: none;
            color: #fff;
            margin-right: 20px;
            font-weight: bold;
        }

        .navbar__avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
            /* Add margin for spacing */
        }

        .navbar__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .search-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .search-container input[type=text] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .search-container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand navbar__logo" href="#">Keratin Nepal</a>
            <div>
                <a href="#" class="navbar__link"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="navbar__link"><i class="fas fa-list"></i> Products</a>
            </div>
            <div class="navbar__avatar">
                <img src="https://via.placeholder.com/40" alt="User Avatar">
            </div>
        </div>
    </nav>

    <div class="search-container">
        <form>
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- Your custom JavaScript -->
    <script>
        // Add any custom JavaScript code here, if needed
    </script>

</body>

</html>
