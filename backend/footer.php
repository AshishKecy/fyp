<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Footer</title>
    <style>
        /* Footer styles */
        .footer {
            
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
            color: #fff;
            padding: 50px 0;
            font-family: Arial, sans-serif;
        }

        .footer-content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            flex: 1;
            margin-bottom: 20px;
        }

        .footer-section h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #fff;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #fff;
        }

        .footer-social {
            margin-top: 20px;
        }

        .footer-social a {
            display: inline-block;
            margin-right: 20px;
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            border: 1px solid #444;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
        }

        .footer-social a:hover {
            color: #fff;
            border-color: #fff;
        }

        .contact-info {
            margin-top: 20px;
            color: white;
            font-size: 16px;
        }

        .contact-info p {
            margin: 10px 0;
        }

        p {
            color: white;
        }


        /* Media query for smaller screens */
        @media screen and (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Your website content here -->

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h2>About Us</h2>
                <p>At Keratin Nepal, we are dedicated to providing premium hair and beauty products infused with the
                    transformative power of keratin. With a focus on innovation and quality, we strive to empower
                    individuals to achieve their beauty goals and enhance their confidence.</p>
            </div>
            <div class="footer-section">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h2>Follow Us</h2>
                <div class="footer-social">
                    <a href="#" target="_blank">Facebook</a>
                    <a href="#" target="_blank">Twitter</a>
                    <a href="#" target="_blank">Instagram</a>
                </div>
            </div>
            <div class="footer-section">
                <h2>Contact Us</h2>
                <div class="contact-info">
                    <p>Basantapur, Kathmandu, Nepal</p>
                    <p>Email: KeratinNepal@gmail.com</p>
                    <p>Phone: +977 9841576840</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>