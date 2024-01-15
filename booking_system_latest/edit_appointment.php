<?php
session_start();
include 'db.php';

// Check if the appointment_id is provided in the URL
if(isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Fetch appointment details from the database based on the appointment_id
    $sql = "SELECT * FROM appointments WHERE id = $appointment_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Display the appointment details in a form for editing
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
</head>
<body>
    <h1>Edit Appointment</h1>
    
    <!-- Edit appointment form -->
<!-- Edit appointment form -->
<form action="process_edit_appointment.php" method="post">
    <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
    
    <label for="user_id">Your User ID:</label>
    <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>" readonly><br>

    <label for="appointment_date">Appointment Date:</label>
    <input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" required><br>

    <label for="appointment_time">Appointment Time:</label>
    <input type="time" name="appointment_time" value="<?php echo $row['appointment_time']; ?>" required><br>

    <input type="submit" value="Save Changes">
</form>
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
<footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
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
            text-align: center;
            color: #333;
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

        input[type="date"],
        input[type="time"] {
            padding: 8px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
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
}
    </style>
</body>
</html>
<?php
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Invalid request. Please provide an appointment ID.";
}

$conn->close();
?>
