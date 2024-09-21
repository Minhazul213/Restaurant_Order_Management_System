<?php

include 'connect.php';

class FoodItem {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllFoodItems() {
        $sql = "SELECT id, name, description, price, category, availability FROM food_items";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$foodItemObj = new FoodItem($conn);
$foodItems = $foodItemObj->getAllFoodItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - The Corner Cafe</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #3f3e3e;
            background-color: #f5e4e4;
        }

        a {
            text-decoration: none;
            color: #337ab7;
        }

        a:hover {
            color: #23527c;
        }

        header {
            background-color: #333;
            padding: 20px;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
        }

        header nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            font-size: 18px;
        }

        header nav ul li a:hover {
            color: #ffdd57;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
        }

        .food-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .food-table th, .food-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .food-table th {
            background-color: #f0f0f0;
        }

        .food-table td {
            background-color: #fff;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
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

    <h1>Welcome to The Corner Cafe!</h1>
    <h2>Our Menu</h2>

    <table class="food-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($foodItems)) {
                while ($row = $foodItems->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . ($row['availability'] ? 'Available' : 'Not Available') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No food items available.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <p>&copyThe Corner Cafe.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
