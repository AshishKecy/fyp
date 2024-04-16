<?php
// Include the database connection file
session_start();
include 'navbar_login.php';
include 'database_connect.php';

// Fetch random products from the database
$query = "SELECT * FROM product1 LIMIT 5";
$result = mysqli_query($conn, $query);

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
            z-index: -1;
        }

        .explore-button {
            position: absolute;
            top: 90%;
            left: 25%;
            transform: translate(-50%, -50%);
            padding: 6px 14px;
            background-color: #C5A38E;
            color: #935026;
            text-decoration: none;
            border: 2px solid #000000;
            border-radius: 10px;
            font-weight: bold;
            z-index: 1;
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
            height: 250px;
            /* Fixed height for uniformity */
            object-fit: cover;
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

        .brands-section {
            text-align: center;
            margin-bottom: 10px;
        }

        .section-heading {
            margin-bottom: 0px;
            /* Adjust margin-bottom to bring the heading closer */
            margin-top: 10;
            /* Remove margin-top to bring the heading closer */
            text-align: center;
            /* Center align the text */
        }

        .top-brands {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            max-width: 800px;
            margin: 0 auto;
        }

        .brand-logo {
            max-width: 30%;
            height: auto;
            margin: 10px;
            transition: opacity 0.3s;
        }

        .brand-logo:hover {
            opacity: 0.7;
            color: blue;
            cursor: pointer;
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
    </style>
</head>

<body>

    <div class="hero-container">
        <img src="/img/banner.png" alt="Banner Image" class="hero-image">
        <a href="#" class="explore-button">Explore Now</a>
    </div>

    <div class="featured-products">
        <h2 class="section-heading">Featured Products</h2>
        <div class="slider-container">
            <div class="product-slider">
                <?php
                // Loop through the fetched product data
                while ($row = mysqli_fetch_assoc($result)) {
                    // Generate HTML for each product card dynamically
                    echo '<div class="product">';
                    // Output the image data with appropriate MIME type
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" alt="' . $row['Name'] . '">';
                    echo '<h5>' . $row['Name'] . '</h5>';
                    echo '</div>';
                }
                ?>
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