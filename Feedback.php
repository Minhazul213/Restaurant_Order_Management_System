<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $food_id = $_POST['food_id'];
    $message = $_POST['message'];

    // Prepare and execute the SQL statement to insert feedback
    $stmt = $conn->prepare("INSERT INTO feedback (name, food_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $food_id, $message);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>