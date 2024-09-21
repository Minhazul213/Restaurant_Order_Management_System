<?php

include 'connect.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - The Corner Cafe</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        header nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
        }

        header nav ul li a:hover {
            background-color: #1abc9c;
            border-radius: 5px;
        }

        #restaurant-info {
            text-align: center;
            background-color: #ecf0f1;
            padding: 40px;
            border-radius: 8px;
            margin: 30px auto;
            width: 80%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #restaurant-info h1 {
            color: #2980b9;
            margin-bottom: 20px;
        }

        #restaurant-info p {
            font-size: 18px;
            color: #7f8c8d;
            line-height: 1.6;
        }

        .highlights {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }

        .highlight-item {
            width: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .highlight-item:hover {
            transform: scale(1.05);
        }

        .highlight-item h2 {
            color: #16a085;
            margin-bottom: 10px;
        }

        .highlight-item p {
            color: #7f8c8d;
            font-size: 16px;
        }

        footer {
            background-color: #34495e;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer p {
            margin-bottom: 5px;
        }

        footer a {
            color: #1abc9c;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="orderV.php">Orders Check</a></li>
                <li><a href="feedBack1.php">Feedback View</a></li>
                <li><a href="viewF.php">Food Menu</a></li>
                <li><a href="payment.php">Check Payment</a></li>
            </ul>
        </nav>
    </header>

    <section id="restaurant-info">
        <h1>Dashboard</h1>
        <h1>Welcome to The Corner Cafe </h1>
        <p>The Corner Cafe is a family-friendly restaurant located in the heart of Dhaka. We are committed to offering our customers the freshest ingredients and the best service. Whether you're here for a quick bite or a gourmet dinner, we have something for everyone!</p>
    </section>

    <section class="highlights">
        <div class="highlight-item">
            <h2>Fresh Ingredients</h2>
            <p>We prioritize using only the freshest ingredients in every dish to ensure top-quality meals for our customers.</p>
        </div>
        <div class="highlight-item">
            <h2>Excellent Service</h2>
            <p>Our friendly staff ensures a delightful dining experience by offering the best service with a smile.</p>
        </div>
        <div class="highlight-item">
            <h2>Comfortable Atmosphere</h2>
            <p>Enjoy your meal in our cozy and welcoming environment, perfect for families and friends.</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 The Corner Cafe. All rights reserved.</p>
        <p>1234 Mohammadpur Lane, Dhaka, Bangladesh | Phone: +123-456-7890</p>
        <p>Email: <a href="mailto:CornerCafe@gmail.com">CornerCafe@gmail.com</a></p>
    </footer>
</body>
</html>
