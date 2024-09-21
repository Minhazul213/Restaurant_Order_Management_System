<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "DELETE FROM food_items WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Food item deleted successfully";
    header("Location: viewF.php");
} else {
    echo "Error deleting food item: " . $conn->error;
}

$conn->close();
?>
