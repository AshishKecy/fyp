<?php
// Start or resume the session
include 'navbar_logout.php';
session_start();
// Check if the user is logged in (i.e., if session variables are set)
if (isset ($_SESSION['user_email'])) {
    // User is logged in, so display personalized content
    $email = $_SESSION['user_email'];
    echo "Welcome back! Your email is $email.";
} else {
    // Redirect the user to the login page if not logged in
    header("Location: Signin.php");
    exit; // Make sure no other code is executed after redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keratin Nepal - Beauty Products</title>

    <style>
        .hero-container {
            position: relative;
            height: 500px;
            /* Adjust the height as needed */
            overflow: hidden;
            margin-top: 10px;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Cover the entire container */
            z-index: -1;
        }

        .explore-button {
            position: absolute;
            top: 90%;
            /* Adjust vertical position */
            left: 25%;
            /* Adjust horizontal position */
            transform: translate(-50%, -50%);
            padding: 6px 14px;
            background-color: #C5A38E;
            color: #935026;
            text-decoration: none;
            border: 2px solid #000000;
            border-radius: 10px;
            font-weight: bold;
            z-index: 1;
            /* Ensure the button appears above the image */
        }

        .featured-products {
            text-align: center;
        }

        .section-heading {
            margin-bottom: 20px;
        }

        .slider-container {
            overflow: hidden;
        }

        .product-slider {
            display: flex;
            transition: transform 0.5s ease;
        }

        .product {
            position: relative;
            width: calc(33.33% - 20px);
            margin: 10px;
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: translateY(-5px);
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }


        .product-content {
            position: relative;
            z-index: 1;
        }

        .product h3 {
            margin-bottom: 5px;
        }

        .product p {
            color: #666;
        }

        .product a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .product a:hover {
            text-decoration: underline;
        }

        .our-services {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* Adjust as needed */
            max-width: 1000px;
            /* Set maximum width to prevent overflow */
            margin: 0 auto;
            /* Center align */
            padding: 20px;
            /* Add padding */
        }

        .service-box {
            flex: 0 0 calc(25% - 20px);
            /* Adjust width of each box */
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
            /* Include padding in width calculation */
        }

        .service-box h3 {
            color: #333;
        }

        .service-box p {
            color: #666;
        }

        .brands-section {
            text-align: center;
            margin-bottom: 10px;
        }

        .section-heading {
            margin-bottom: 0px;
            /* Adjust margin-bottom to bring the heading closer */
            margin-top: 10;
            /* Remove margin-top to bring the heading closer */
        }

        .top-brands {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            max-width: 800px;
            /* Adjust as needed */
            margin: 0 auto;
        }

        .brand-logo {
            max-width: 30%;
            /* Adjust the maximum width of the logo */
            height: auto;
            margin: 10px;
            /* Adjust margin as needed */
            transition: opacity 0.3s;
            /* Add transition for smooth effect */
        }

        .brand-logo:hover {
            opacity: 0.7;
            color: blue;
            /* Change opacity when hovered over */
            cursor: pointer;
            /* Change cursor to indicate interactivity */
        }

        /* Other styles remain the same */
    </style>
</head>

<body>

    <div class="hero-container">
        <img src="/img/banner.png" alt="Banner Image" class="hero-image">
        <a href="#" class="explore-button">Explore Now</a>
        <!-- Your content here -->
        <!-- This will be scrollable content -->
    </div>

    <div class="featured-products">
        <h2 class="section-heading">Featured Products</h2>
        <div class="slider-container">
            <div class="product-slider">
                <div class="product">
                    <img src="/img/keratin shampoo.jfif" alt="Product 1">
                    <h3>Product 1 Name</h3>
                    <p>Description of Product 1.</p>
                    <a href="product1.html">Learn More</a>
                </div>
                <div class="product">
                    <img src="/img/treatment.jfif" alt="Product 2">
                    <h3>Product 2 Name</h3>
                    <p>Description of Product 2.</p>
                    <a href="product2.html">Learn More</a>
                </div>
                <div class="product">
                    <img src="/img/acne.jpg" alt="Product 2">
                    <h3>Product 2 Name</h3>
                    <p>Description of Product 2.</p>
                    <a href="product2.html">Learn More</a>
                </div>
                <div class="product">
                    <img src="/img/oxy.jpg" alt="Product 2">
                    <h3>Product 2 Name</h3>
                    <p>Description of Product 2.</p>
                    <a href="product2.html">Learn More</a>
                </div>
                <div class="product">
                    <img src="/img/sunplay.jpg" alt="Product 2">
                    <h3>Product 2 Name</h3>
                    <p>Description of Product 2.</p>
                    <a href="product2.html">Learn More</a>
                </div>
            </div>
        </div>
        <div class="brands-section">
            <h1 class="section-heading">Top Brands</h1>
            <div class="top-brands">
                <img src="/img/keratin.png" alt="Brand 3" class="brand-logo">
                <img src="/img/botox.png" alt="Brand 1" class="brand-logo">
                <img src="/img/Revlon logo.png" alt="Brand 2" class="brand-logo">
            </div>
        </div>
        <h2 class="section-heading">Our Services</h2>
        <div class="our-services">
            <div class="service-box">
                <h3>Home Delivery</h3>
                <p>We offer convenient home delivery services to bring your purchases right to your doorstep. Enjoy
                    the
                    ease and comfort of shopping from home without the hassle of visiting our store.</p>
            </div>
            <div class="service-box">
                <h3>Pre-Trial on Visiting Shop</h3>
                <p>Visit our shop and experience our products firsthand before making a purchase. Take advantage of
                    our
                    pre-trial service to ensure that you're completely satisfied with your selection.</p>
            </div>
            <div class="service-box">
                <h3>7 Days Return</h3>
                <p>We stand behind the quality of our products. If for any reason you're not satisfied with your
                    purchase, you can return it within 7 days for a full refund or exchange. Your satisfaction is
                    our
                    priority.</p>
            </div>
            <div class="service-box">
                <h3>Cash on Delivery</h3>
                <p>To make your shopping experience as convenient as possible, we offer cash on delivery payment
                    options. Simply pay for your order when it arrives at your doorstep, eliminating the need for
                    online
                    transactions.</p>
            </div>
        </div>

        <footer>
            <?php include 'footer.php'; ?>
        </footer>

</body>

</html>