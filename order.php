
<?php
include 'connect.php';

class FoodItem {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllFoodItems() {
        $sql = "SELECT id, name FROM food_items WHERE availability = 1";
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
    <title>Order - The Corner Cafe</title>
    <link rel="stylesheet" href="order.css">
    <script>
        function addQuantityInput(select) {
            const container = document.getElementById("quantities-container");
            container.innerHTML = ""; // Clear the existing content

            for (let i = 0; i < select.selectedOptions.length; i++) {
                const foodId = select.selectedOptions[i].value;
                const foodName = select.selectedOptions[i].text;

                const quantityLabel = document.createElement("label");
                quantityLabel.innerText = "Quantity for " + foodName + ":";

                const quantityInput = document.createElement("input");
                quantityInput.type = "number";
                quantityInput.name = "quantities[" + foodId + "]";
                quantityInput.min = 1;
                quantityInput.required = true;

                container.appendChild(quantityLabel);
                container.appendChild(quantityInput);
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body>
    <h1>Order Your Food</h1>
    <form action="submit_order.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="number">Table Number :</label>
        <input type="text" id="number" name="number" required><br>

        <label for="food">Select Food Items:</label>
        <select id="food" name="food_id[]" multiple onchange="addQuantityInput(this)" required>
            <?php
            if (!empty($foodItems)) {
                while ($row = $foodItems->fetch_assoc()) {
                    echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
                }
            } else {
                echo "<option>No available food items</option>";
            }
            ?>
        </select><br>

        <div id="quantities-container"></div>

        <input type="submit" value="Place Order">
        <a href="index.html">back</a>
    </form>
</body>
</html>

<?php
$conn->close();
?>
