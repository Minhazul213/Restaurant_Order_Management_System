<?php
include 'connect.php';
session_start();

$sql = "SELECT f.name AS food_name, fb.name AS customer_name, fb.message 
        FROM feedback fb 
        JOIN food_items f ON fb.food_id = f.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - The Corner Cafe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        header {
            background-color: #2c3e50;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: flex-start;
            padding-left: 20px;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            font-size: 18px;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: #3498db;
        }

        /* Feedback Section */
        .feedback-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
            background-color: #ecf0f1;
        }

        .feedback-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
        }

        .feedback-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #e74c3c;
            font-size: 18px;
        }

        /* Footer Styles */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }

        footer p {
            margin-bottom: 8px;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
        }

        footer a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Back</a></li>
            </ul>
        </nav>
    </header>

    <section class="feedback-section">
        <div class="feedback-container">
            <h1>Customer Feedback</h1>
            <table>
                <tr>
                    <th>Food Item</th>
                    <th>Customer Name</th>
                    <th>Feedback</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['food_name'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='no-data'>No feedback available.</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 The Corner Cafe. All rights reserved.</p>
        <p>1234 Mohammadpur Lane, Dhaka, Bangladesh | Phone: +123-456-7890</p>
        <p>Email: <a href="mailto:CornerCafe@gmail.com">CornerCafe@gmail.com</a></p>
    </footer>
</body>
</html>
