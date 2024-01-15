<?php
include 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $phone = $_POST['phone'];
    $description= $_POST['description'];

    // Insert the new tutor into the database
    $sql = "INSERT INTO tutors (name, subject, state, district, phone, description)
            VALUES ('$name', '$subject', '$state', '$district', '$phone', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Tutor added successfully!";
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
    <title>Add Tutor</title>
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
        align-items: center;
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


        form {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin-top: 40px;
        }
        

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="submit"] {
            background-color: #63b5a9;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #4a8f7e;
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
            margin-top: 30px;
        }
    </style>
</head>
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

<body>
    <form action="add_tutor.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="description">Description:</label>
        <input type="descrption" id="description" name="description" required>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>

        <label for="district">District:</label>
        <input type="text" id="district" name="district" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <input type="submit" value="Add Tutor">
    </form>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>

</html>
