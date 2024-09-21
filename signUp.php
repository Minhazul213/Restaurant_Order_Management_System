<?php
include 'connect.php';
function generateCustomerID() {
    $year = date("y"); 
    $month = date("m"); 
    $random_id = str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT); 
    return $year . $month . $random_id; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $customerID = generateCustomerID();

  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO customers (id, username, phone, password) 
            VALUES ('$customerID', '$username', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Customer registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - The Corner Cafe</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="form-container">
        <a href="index.html">home</a>
            <h1>Sign Up</h1>
            <form action="signup.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Sign Up</button>
               
                </p><p>Already have an account? <a href="login.php">Login</a> 
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 [The Corner Cafe]. All rights reserved.</p>
        <p>1234 Mohammadpur Lane, Dhaka, Bangladesh | Phone: +123-456-7890</p>
        <p>Email: <a href="mailto:CornerCafe@gmail.com">CornerCafe@gmail.com</a></p>
        <ul>
            <li><a href="https://github.com/Minhazul213" target="_blank">Github</a></li>
        </ul>
    </footer>
</body>
</html>
