<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // User already exists, display a popup message
        echo "<script>alert('User with the same username or email already exists. Please choose a different one.');</script>";
    } else {
        // Insert user data into the 'users' table
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Display alert with two options
            echo "<script>
                var confirmation = confirm('Registration successful! Do you want to proceed to login?');
                if (confirmation) {
                    window.location.href = 'user_login.php';
                } else {
                    // Additional code if needed for staying on the registration page
                }
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

    $conn->close();
}
?>

<!-- Remaining HTML code remains unchanged -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

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
            margin-top: 20px;
            /* Adjust the margin as needed */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            margin-top: 160px;
            /* Margin for spacing */
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

        footer {
            background-color: #601204;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 20px;
            margin-top: 20px;
            /* Margin for spacing */
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

    <div>

        <!-- Registration form -->
        <form action="" method="post">
            <h1>User Registration</h1>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <input type="submit" value="Register">

            <div style="text-align: center; margin-top: 10px;">
        <span>Already an admin? </span>
        <a href="register_admin.php"><button type="button">Register as Admin</button></a>
    </div>
</form>
</div>
        </form>
    </div>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>

</html>