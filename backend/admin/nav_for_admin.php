<?php
// Include the database connection file
?>
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

        /* Container for content with padding-top */
        .content-container {
            padding-top: 70px;
            /* Adjust according to the height of the navbar */
            overflow-y: auto;
            /* Add scrollbar for content overflow */
            height: calc(100vh - 20px);
            /* Set height to viewport height minus navbar height */
            background-color: #8EC5FC;
            background-image: linear-gradient(90deg, #8EC5FC 0%, #E0C3FC 100%);

        }

        .nav-link {
            color: white;
            transition: color 0.3s;
        }

        .nav-link:hover {
            text-shadow: 0 0 5px rgb(13, 204, 218);
            /* Adjust the blur radius and color to your preference */
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
                    <li class="bold"><a href="admin_login.php" style="color: white;" class="nav-link">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="bold"><a href="admin_login.php" style="color: white;" class="nav-link">Products</a></li>
                    <li class="bold"><a href="customers.php" style="color: white;" class="nav-link">Customers</a></li>
                </ul>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="bold"><a href="admin_login.php" style="color: white;" class="nav-link">Login</a></li>
                </ul>

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