<?php
include 'connect.php'; // Ensure this file exists and is in the correct directory

class Feedback {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllFeedback() {
        $sql = "SELECT * FROM feedback";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }
}

// Create a new instance of the Feedback class
$feedbackObj = new Feedback($conn);
$feedbacks = $feedbackObj->getAllFeedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback - The Corner Cafe</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: #3498db;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
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
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            font-size: 18px;
        }

        /* Feedback Section */
        .feedback-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            background-color: #ecf0f1;
            padding: 40px 0;
        }

        .feedback-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }

        .feedback-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .feedback-table {
            width: 100%;
            border-collapse: collapse;
        }

        .feedback-table th,
        .feedback-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .feedback-table th {
            background-color: #2c3e50;
            color: #fff;
        }

        .feedback-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .feedback-table tr:hover {
            background-color: #f1f1f1;
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
                <li><a href="adminIndex.php">Back</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="feedback-section">
        <div class="feedback-container">
            <h1>Customer Feedback</h1>

            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order ID</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($feedbacks)) {
                        while ($row = $feedbacks->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['order_id'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No feedback available.</td></tr>";
                    }
                    ?>
                </tbody>
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
