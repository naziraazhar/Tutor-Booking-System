<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the 'users' table
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Verify the password
            $_SESSION['user_id'] = $row['id']; // Store user ID in the session
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFE6C0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Center vertically */
            align-items: center;
            /* Center horizontally */
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
            text-align: center;
            color: #333;
            margin-top: 20px; /* Adjust the margin as needed */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            margin-top: 160px; /* Margin for spacing */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .error-message {
            color: red;
            margin-bottom: 16px;
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
            margin-top: 20px; /* Margin for spacing */
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

    <!-- Login form -->
    <form action="" method="post">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($row) && $result->num_rows == 1 && !password_verify($password, $row['password'])) {
                echo '<div class="error-message">Incorrect password. Please try again.</div>';
            } else {
                echo '<div class="error-message">Username not found. Please register if you\'re a new user.</div>';
            }
        }
        ?>
         <h1>User Login</h1>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
    </form>

    <!-- Move the h1 element here -->
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>

</html>