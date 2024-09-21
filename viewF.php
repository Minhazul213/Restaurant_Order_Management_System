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
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
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

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background-color: #2c3e50;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 240px;
            padding: 40px;
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .main-content h2 {
            font-size: 28px;
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
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: #fff;
            text-transform: uppercase;
        }

        td {
            background-color: #f9f9f9;
        }

        button {
            padding: 8px 12px;
            background-color: #27ae60;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2ecc71;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 10px 0;
            position: relative;
            width: 100%;
            margin-top: 40px;
        }

        footer p {
            margin: 5px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="addF.php">Add Food Item</a></li>
            <li><a href="adminIndex.php">Back to Dashboard</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Food Inventory</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
            <?php
            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch food items
            $sql = "SELECT id, name, description, price, category, availability FROM food_items";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . ($row['availability'] ? 'Available' : 'Not Available') . "</td>";
                    echo "<td>
                            <a href='updateF.php?id=" . $row['id'] . "'><button>Update</button></a>
                            <a href='deleteF.php?id=" . $row['id'] . "'><button class='delete-btn'>Delete</button></a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No food items found.</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 The Corner Cafe. All Rights Reserved.</p>
        <p>1234 Mohammadpur Lane, Dhaka, Bangladesh | Phone: +123-456-7890</p>
    </footer>

</body>
</html>
