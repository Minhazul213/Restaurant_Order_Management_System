<?php
include 'connect.php';

class Order {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllOrders() {
        $sql = "SELECT id, customer_name, table_number, food_id, quantity, order_time, completed FROM orders";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function markOrderAsCompleted($orderId) {
        $stmt = $this->conn->prepare("UPDATE orders SET completed = 1 WHERE id = ?");
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderObj = new Order($conn);
$orders = $orderObj->getAllOrders();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];
    if ($orderObj->markOrderAsCompleted($orderId)) {
        header("Location: orderV.php"); 
        exit(); 
    } else {
        echo "Error marking order as completed.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - The Corner Cafe</title>
    <link rel="stylesheet" href="orderV.css"> 
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="adminIndex.php">Back</a></li>
                <li><a href="viewF.php">View Food</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h1>Manager Dashboard</h1>
    <h2>Order Notifications</h2>

 
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Table Number</th>
                <th>Food Item ID</th>
                <th>Quantity</th>
                <th>Order Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($orders)) {
                while ($row = $orders->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['customer_name'] . "</td>";
                    echo "<td>" . $row['table_number'] . "</td>";
                    echo "<td>" . $row['food_id'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['order_time'] . "</td>";
                    echo "<td>";
                    if (!$row['completed']) {
                        echo "<form action='orderD.php' method='post'>";
                        echo "<input type='hidden' name='order_id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' value='Mark as Completed'>";
                        echo "</form>";
                    } else {
                        echo "<span class='completed'>Done</span>";
                    }
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No orders available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
