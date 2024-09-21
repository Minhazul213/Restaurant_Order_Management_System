<?php
// Include the connection file
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Item - The Corner Cafe</title>
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        .section {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        label {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2ecc71;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            text-align: center;
            color: #2c3e50;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <!-- Add Food Item Form -->
    <div id="add-section" class="section">
        <h2>Add Food Item</h2>
        <form action="addF.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category">

            <label for="availability">Availability:</label>
            <select id="availability" name="availability">
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>

            <input type="submit" value="Add Food Item">
            <a href="viewF.php">Back</a>
        </form>
    </div>

    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $availability = $_POST['availability'];

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO food_items (name, price, description, category, availability) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $price, $description, $category, $availability);

        if ($stmt->execute()) {
            echo "<p>New food item added successfully.</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

</body>
</html>
