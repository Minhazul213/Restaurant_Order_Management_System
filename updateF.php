<?php
include 'connect.php';

$id = $_GET['id'];

// Fetch the food item details
$sql = "SELECT * FROM food_items WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No food item found with that ID.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $availability = isset($_POST['availability']) ? 1 : 0;

    $sql = "UPDATE food_items SET name='$name', price='$price', description='$description', category='$category', availability='$availability' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Food item updated successfully</p>";
        header("Location: viewF.php");
        exit();
    } else {
        echo "<p>Error updating food item: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: off-white;
            color: #f0e8e8;
            margin: 0;
            padding: 0;s
        }

        h2 {
            text-align: center;
            color:black;
            margin-top: 20px;
        }

        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #096d54;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type="text"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        input[type="checkbox"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #337ab7;
            font-size: 16px;
        }

        a:hover {
            color: #23527c;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: #f0e8e8;
        }
    </style>
</head>
<body>
    <h2>Update Food Item</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required>
        
        <label for="availability">Available:</label>
        <input type="checkbox" id="availability" name="availability" <?php if ($row['availability']) echo 'checked'; ?>>
        
        <input type="submit" value="Update Food Item">
        
        <a href="viewF.php">Back</a>
    </form>
</body>
</html>
