<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin_name'];
    $password = $_POST['admin_password'];

    // Check if the username exists in the 'users' table
    $sql = "SELECT * FROM admin WHERE admin_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['admin_password'])) { // Verify the password
            $_SESSION['admin_id'] = $row['admin_id']; // Store user ID in the session
            header("Location: index.html"); // Redirect to appointments page after login
            exit();
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Username not found. Please register if you're a new user.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    
    <!-- Login form -->
    <form action="" method="post">
        <label for="admin_name">Username:</label>
        <input type="text" name="admin_name" id="admin_name" required><br>
        
        <label for="admin_password">Password:</label>
        <input type="password" name="admin_password" id="admin_password" required><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
