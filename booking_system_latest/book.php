<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment with <?php echo $tutor_name; ?></title>
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

        main {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 30px;
            max-width: 400px;
            width: 100%;
            margin-top: 30px; /* Adjusted margin-top */
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
            background-color: #fff; /* Set form background color to white */
            padding: 50px; /* Added padding for better appearance */
            border-radius: 4px;
            text-align: center;
            color: black; /* Set text color to black */
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


        label {
            font-weight: bold;
            color: black; /* Set label color to black */
        }

        input {
            padding: 15px;
            border: 1px solid black; /* Added black border */
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            background-color: white;
            color: black; /* Set input text color to black */
        }

        input[type="date"],
        input[type="time"] {
            padding: 15px;
        }

        input[type="submit"] {
            background-color: #601204; /* Set background color to red */
            color: white;
            cursor: pointer;
            border: none;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: darkred; /* Set hover color to dark red */
            color: white;
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
    <main>
        <?php
        session_start(); // Start the PHP session

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // If not logged in, redirect to the login page or show an error message
            header("Location: user_login.php"); // Redirect to the login page
            exit(); // Terminate the script
        }

        include 'db.php';

        if(isset($_GET['tutor_id'])) {
            $tutor_id = $_GET['tutor_id'];

            // Fetch tutor information from the database based on tutor_id
            $sql = "SELECT name, phone,description  FROM tutors WHERE id = $tutor_id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $tutor_name = $row['name'];
                $tutor_phone = $row['phone'];
                $tutor_description= $row['description'];
            } else {
                // Tutor not found in the database
                echo "Tutor not found.";
                exit(); // Terminate the script
            }
        ?>

        <!-- Appointment booking form -->
        <form action="process_appointment.php" method="post">
            <input type="hidden" name="tutor_id" value="<?php echo $tutor_id; ?>">

            <!-- Add more fields for user details like name, email, date, time, etc. -->
            <label for="user_name">Your Name:</label>
            <input type="text" name="user_name" id="user_name" required><br>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" required><br>

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" name="appointment_time" id="appointment_time" required><br>

            <input type="submit" value="Book Appointment">
        </form>
    </main>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>
</html>

<?php
    } else {
        echo "Invalid request. Please select a tutor to book an appointment.";
    }
?>
