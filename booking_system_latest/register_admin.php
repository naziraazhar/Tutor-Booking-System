<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin_name'];
    $password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT); // Hash the password


    // Insert user data into the 'users' table
    $sql = "INSERT INTO admin (admin_name, admin_password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to add_tutor.php
        header("Location: add_tutor.php");
        exit(); // Terminate the script after redirection
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
    <title>Admin Registration</title>
    <style>
         body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #FFE6C0;
    color: white;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #601204;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 10px;
    z-index: 1000;
}

.nav-box {
    flex: 2;
    text-align: center;
    border-radius: 5px;
}

.navbar a {
    color: white;
    font-weight: bold;
    font-size: 20px;
    text-decoration: none;
    padding: 10px;
    display: block;
}
        h1 {
            color: #007BFF;
            text-align: center;
        }

        form {
    max-width: 400px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    text-align: center;
    margin: 50px auto; /* Updated to auto for both horizontal and vertical centering */
    display: flex;
    flex-direction: column;
    align-items: center;
}


        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 12px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        footer {
    background-color: #601204;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 20px;
}
    </style>
</head>
<body>
<div class="navbar">
        <div class="nav-box">
            <a href="user_register.php">Register</a>
        </div>
        <div class="nav-box">
            <a href="user_login.php">Login</a>
        </div>
        <div class="nav-box">
            <a href="contact.html">Contact Us</a>
        </div>
        <div class="nav-box">
            <a href="about.html">About Us</a>
        </div>
        <div class="nav-box">
            <a href="home.html">Home</a>
        </div>
    </div>
    <h1>Admin Login</h1>
    
    <!-- Registration form -->
    <form action="" method="post">
        <label for="admin_name">Username:</label>
        <input type="text" name="admin_name" id="admin_name" required>
        
        <label for="admin_password">Password:</label>
        <input type="password" name="admin_password" id="admin_password" required>

        <input type="submit" value="Login">
    </form>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>
</html>