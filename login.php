<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if ($username === "admin" && $password === "admin123") {
       
        header("Location: adminIndex.php");
        exit();
    } else {
    
        $sql = "SELECT * FROM customers WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
            if (password_verify($password, $stored_password)) {
                
                header("Location: index.html");
                exit();
            } else {
                echo "<script>alert('Invalid customer username or password');</script>";
            }
        } else {
            echo "<script>alert('Customer not found');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Corner Cafe</title>
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
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="signUp.php">Sign Up</a></p>
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
