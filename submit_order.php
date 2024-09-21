<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            color: #5d4037;
        }

        .order-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .order-details p {
            font-size: 16px;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #5d4037;
            background-color: #fff3e0;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        a:hover {
            background-color: #ffe0b2;
        }
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <div class="order-details">
        <?php
        include 'connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize inputs to prevent SQL injection and XSS
            $name = htmlspecialchars($conn->real_escape_string($_POST['name']));
            $tableNumber = htmlspecialchars($conn->real_escape_string($_POST['number']));
            $foodIds = $_POST['food_id']; // Array of selected food IDs
            $quantities = $_POST['quantities']; // Associative array with food_id as key and quantity as value

            // Iterate over the food items and quantities and process each order
            foreach ($foodIds as $foodId) {
                if (isset($quantities[$foodId]) && !empty($quantities[$foodId])) {
                    $quantity = (int)$quantities[$foodId]; // Ensure quantity is an integer

                    // Prepare the SQL query to avoid SQL injection
                    $stmt = $conn->prepare("INSERT INTO orders (customer_name, table_number, food_id, quantity) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssii", $name, $tableNumber, $foodId, $quantity);

                    // Execute the prepared statement and check for success
                    if ($stmt->execute()) {
                        echo "<p>Order placed successfully for food item ID: $foodId with quantity: $quantity</p>";
                    } else {
                        echo "<p>Error: " . $conn->error . "</p>";
                    }

                    $stmt->close(); // Close the prepared statement
                } else {
                    echo "<p>No quantity specified for food item ID: $foodId</p>";
                }
            }
        }

        $conn->close(); // Close the database connection
        ?>
    </div>
    <a href="order_success.html">Go  to payment Page</a>
    <a href="index.html">Go Back </a>
    <a href="index.html">pay with cash </a>
</body>
</html>
