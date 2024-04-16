<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keratin Nepal - Beauty Products</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        /* Custom styling for sticky navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;

            /* Dark border at the bottom */
            border-radius: 0;
            /* Remove border-radius */
            z-index: 1000;
            /* Ensure it's above other content */
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        }

        .nav-link {
            color: white;
            transition: color 0.3s;
        }

        .nav-link:hover {
            text-shadow: 0 0 5px rgb(13, 204, 218);
            /* Adjust the blur radius and color to your preference */
        }

        .profile-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            margin-top: 5px;
            /* Added margin-top */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            /* Add cursor pointer */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="padding: 15px; font-weight: bold; color: white;">Keratin Nepal</a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="bold"><a href="home.php" style="color: white;" class="nav-link">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="bold"><a href="shop.php" style="color: white;" class="nav-link">Products</a></li>
                    <li class="bold"><a href="aboutus.php" style="color: white;" class="nav-link">About Us</a></li>
                    <li class="bold"><a href="contactus.php" style="color: white;" class="nav-link">Contact</a></li>
                </ul>
                <form action="shop.php" method="GET" class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search_query" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['user_email'])) {
                        // User is logged in, show profile circle
                        echo '<li><a href="accountinfo.php" class="profile-circle">' . strtoupper(substr($_SESSION['user_email'], 0, 2)) . '</a></li>';
                    } else {
                        // User is not logged in, show login button
                        echo '<li class="bold"><a href="Signin.php" style="color: white;" class="nav-link">Login</a></li>';
                    }
                    ?>
                    <li><a href="carttable.php" style="color: white;" class="nav-link"><i
                                class="fas fa-shopping-cart"></i></a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>

</html>