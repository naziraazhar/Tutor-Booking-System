<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Appointments</title>

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

        header {
            text-align: center;
            background-color: #FFE6C0;
            color: #fff;
            padding: 80px 0;
        }

        h1 {
            margin: 0;
            color: black; /* Set the color to black */
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        form {
            display: inline-block;
            margin-right: 5px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        button:hover {
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
            margin-top: 20px; /* Margin for spacing */
        }
    </style>
</head>

<body>

    <header>
        <h1>Your Booked Appointments</h1>
    </header>
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
    <?php
    session_start(); // Start the session (if not already started)

    // Check if a user is logged in (You need to implement your own authentication mechanism)
    if (!isset($_SESSION['user_id'])) {
        echo "User not logged in. Please log in to view appointments.";
        exit;
    }

    $user_id = $_SESSION['user_id']; // Get the user's ID from the session

    include 'db.php';

    // Fetch and display the booked appointments for the logged-in user
    $sql = "SELECT appointments.*, tutors.name AS tutor_name, users.username FROM appointments
        LEFT JOIN tutors ON appointments.tutor_id = tutors.id
        LEFT JOIN users ON appointments.user_id = users.id
        WHERE appointments.user_id = $user_id"; // Filter appointments by user_id

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Appointment ID</th><th>Tutor</th><th>Username</th><th>Appointment Date<th>Appointment Time</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['tutor_name']}</td>"; // Display tutor's name fetched from the database
            echo "<td>{$row['username']}</td>"; // Display username fetched from the database
            echo "<td>{$row['appointment_date']}</td>"; // Display username fetched from the database
            echo "<td>{$row['appointment_time']}</td>"; // Display username fetched from the database
            echo "<td>
                <form class='appointment-form' action='edit_appointment.php' method='get'>
                    <input type='hidden' name='appointment_id' value='{$row['id']}'>
                    <button type='submit'>Edit</button>
                </form>

                <form class='appointment-form' action='delete_appointment.php' method='post'>
                    <input type='hidden' name='appointment_id' value='{$row['id']}'>
                    <button type='submit'>Delete</button>
                </form>

                <form class='done-form' action='done_appointment.php' method='post'>
                    <input type='hidden' name='appointment_id' value='{$row['id']}'>
                    <button type='submit' class='done-button'>Done</button>
                </form>
              </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "You have no booked appointments.";
    }

    $conn->close();
    ?>

    <script>
        // Add JavaScript to hide the appointment row when "Done" is clicked
        document.querySelectorAll('.done-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const appointmentRow = form.parentElement.parentElement; // Get the appointment row
                appointmentRow.style.display = 'none';
            });
        });
    </script>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>

</html>
