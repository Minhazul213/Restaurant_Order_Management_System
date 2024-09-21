<?php
include 'connect.php';

class Order {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getOrderDetails($orderId) {
        // Fetch order details including food item details
        $sql = "SELECT o.id, o.customer_name, o.table_number, o.food_id, o.quantity, o.order_time, o.completed, f.name, f.price
                FROM orders o
                JOIN food_items f ON o.food_id = f.id
                WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function markOrderAsCompleted($orderId) {
        $stmt = $this->conn->prepare("UPDATE orders SET completed = 1 WHERE id = ?");
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}

// Initialize the connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Instantiate the Order class
$orderObj = new Order($conn);

// Fetch the order details based on the provided order ID
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $orderObj->markOrderAsCompleted($orderId);
    $orderDetails = $orderObj->getOrderDetails($orderId);
} else {
    echo "Invalid order ID.";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            padding: 10px 20px;
            color: #fff;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .order-details-table {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .order-details-table th, 
        .order-details-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .order-details-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        .order-details-table tr:last-child td {
            border-bottom: none;
        }

        .order-details-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .order-details-table tr:hover {
            background-color: #f1f1f1;
        }

        .order-details-table td {
            font-size: 14px;
            color: #333;
        }

        @media (max-width: 600px) {
            .order-details-table {
                width: 100%;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="orderV.php">Back</a></li>
        </ul>
    </nav>
</header>

<h1>Order Details</h1>

<?php if ($orderDetails) { ?>
<table class="order-details-table">
    <tr>
        <th>Customer Name</th>
        <td><?php echo htmlspecialchars($orderDetails['customer_name']); ?></td>
    </tr>
    <tr>
        <th>Table Number</th>
        <td><?php echo htmlspecialchars($orderDetails['table_number']); ?></td>
    </tr>
    <tr>
        <th>Food Name</th>
        <td><?php echo htmlspecialchars($orderDetails['name']); ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo htmlspecialchars($orderDetails['price']); ?> BDT</td>
    </tr>
    <tr>
        <th>Quantity</th>
        <td><?php echo htmlspecialchars($orderDetails['quantity']); ?></td>
    </tr>
    <tr>
        <th>Order Time</th>
        <td><?php echo htmlspecialchars($orderDetails['order_time']); ?></td>
    </tr>
    <tr>
        <th>Order Status</th>
        <td><?php echo $orderDetails['completed'] ? 'Completed' : 'Pending'; ?></td>
    </tr>
    <?php if (isset($orderDetails['quantity']) && isset($orderDetails['price'])) { ?>
    <tr>
        <th>Total Price</th>
        <td><?php echo htmlspecialchars($orderDetails['quantity'] * $orderDetails['price']); ?> BDT</td>
    </tr>
    <?php } ?>
</table>
<?php } else { ?>
<p>No order details found.</p>
<?php } ?>

</body>
</html>
