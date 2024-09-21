<?php
include 'connect.php';

class Feedback {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function submitFeedback($name, $orderId, $message) {
        $stmt = $this->conn->prepare("INSERT INTO feedback (name, order_id, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $orderId, $message);
        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $orderId = $_POST['order_id'];
    $message = $_POST['message'];

    $feedbackObj = new Feedback($conn);

    if ($feedbackObj->submitFeedback($name, $orderId, $message)) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error submitting feedback.";
    }
}

$conn->close();
?>

