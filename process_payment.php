<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['name'];
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];
    $transaction_id = $_POST['transaction_id'];

    // Prepare and execute the SQL statement to insert payment
    $stmt = $conn->prepare("INSERT INTO payments (customer_name, order_id, payment_method, transaction_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $customer_name, $order_id, $payment_method, $transaction_id);

    if ($stmt->execute()) {
        echo "Payment completed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>