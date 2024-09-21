<?php
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Manager Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            color: #333;
        }

        th, td {
            text-align: center;
        }

        /* Container styling for dashboard */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .no-data {
            text-align: center;
            color: #e74c3c;
            font-size: 18px;
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #2c3e50;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Payment Details</h1>
        <table border="1">
            <tr>
                <th>Customer Name</th>
                <th>Order ID</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Payment Date</th>
            </tr>

            <?php
            // Fetch the payment details from the payments table
            $sql = "SELECT customer_name, order_id, payment_method, transaction_id, payment_date FROM payments";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output the data in table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['customer_name'] . "</td>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['payment_method'] . "</td>";
                    echo "<td>" . $row['transaction_id'] . "</td>";
                    echo "<td>" . $row['payment_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-data'>No payment records found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 The Corner Cafe. All rights reserved.</p>
    </footer>

</body>
</html>
