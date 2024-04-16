<?php
include 'navbar_login.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Keratin Nepal</title>
    <style>
        /* Reset CSS */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #f64c72;
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-bottom: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative;
        }

        header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 100%);
            z-index: 1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        h1,
        h2 {
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        section {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 40px;
            position: relative;
        }

        section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.6) 100%);
            z-index: 1;
            border-radius: 10px;
        }

        .owner-section {
            background-color: #f9f9f9;
            text-align: center;
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .owner-photo {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .owner-name {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .owner-advice {
            font-size: 18px;
            color: #666;
            line-height: 1.5;
        }

        /* Media Queries */
        @media screen and (max-width: 768px) {
            header {
                padding: 30px 0;
            }

            h1 {
                font-size: 24px;
            }


            section {
                padding: 30px;
                border-radius: 0;
                margin-bottom: 30px;
            }

            .owner-photo {
                width: 120px;
                height: 120px;
                margin-bottom: 10px;
            }

            .owner-name {
                font-size: 20px;
                margin-bottom: 5px;
            }

            .owner-advice {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1 style="font-size: 48px;">Discover the Beauty of Keratin Nepal</h1>
    </header>
    <div class="container">
        <section>
            <h2
                style="background-color: #4158D0; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%); font-size: 20px; color: white; padding: 10px; text-align: center;">
                Who We Are</h2>
            <p style="font-size: 20px; font-family: 'Roboto', sans-serif; color: #333">At Keratin Nepal, we believe in
                the
                transformative power of beauty. We offer a
                carefully curated selection of premium skincare, haircare, and makeup products designed to enhance your
                natural beauty and boost your confidence. With a commitment to quality and innovation, we strive to
                empower individuals to embrace their unique beauty and express themselves with confidence.</p>
        </section>
        <section>
            <h2
                style="background-color: #4158D0; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%); font-size: 20px; color: white; padding: 10px; text-align: center;">
                Our Mission</h2>
            <p style="font-size: 20px; font-family: 'Roboto', sans-serif; color: #333">Our mission at Keratin Nepal is
                to
                revolutionize the beauty industry by
                providing exceptional cosmetic products that inspire self-expression and celebrate diversity. We are
                dedicated to promoting inclusivity, sustainability, and ethical practices in everything we do. By
                empowering individuals to feel confident and beautiful, we aim to make a positive impact on the world
                around us.</p>
        </section>
        <section>
            <h2
                style="background-color: #4158D0; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%); font-size: 20px; color: white; padding: 10px; text-align: center;">
                Why Choose Keratin Nepal</h2>

            <p style="font-size: 20px; font-family: 'Roboto', sans-serif; color: #333">When you choose
                Keratin Nepal, you're choosing more than just beauty products;
                you're choosing a lifestyle. Our commitment to authenticity, transparency, and customer satisfaction
                sets us apart from the rest. With a diverse range of high-quality products, personalized customer
                service, and a passion for innovation, we are dedicated to helping you look and feel your best every
                day.</p>
        </section>
        <div class="owner-section">
            <img src="../img/sudarshan.jpg" alt="Owner Photo" class="owner-photo">
            <h3 class="owner-name">Mr. Sudarshan K.C.</h3>
            <p style="color: orange;">Owner</p>
            <p class="owner-advice">"Beauty begins the moment you decide to be yourself."</p>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>