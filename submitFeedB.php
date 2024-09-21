<?php
include 'connect.php';
session_start();

// Fetch food items from the database
$sql = "SELECT id, name FROM food_items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback - The Corner Cafe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
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
            color: #f39c12;
        }

        .feedback-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 40px 0;
        }

        .feedback-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }

        .feedback-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #333;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        .input-group textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2ecc71;
        }

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
            <h1>Submit Your Feedback</h1>
            <form action="Feedback.php" method="POST">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="food_id">Select Food Item</label>
                    <select id="food_id" name="food_id" required>
                        <option value="">Select a food item</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="message">Feedback</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Submit Feedback</button>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 The Corner Cafe. All rights reserved.</p>
        <p>1234 Mohammadpur Lane, Dhaka, Bangladesh | Phone: +123-456-7890</p>
        <p>Email: <a href="mailto:CornerCafe@gmail.com">CornerCafe@gmail.com</a></p>
    </footer>
</body>
</html>
