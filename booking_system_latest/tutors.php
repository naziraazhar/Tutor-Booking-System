<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFE6C0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
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
            background-color: #601204;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 80px auto 0; /* Adjusted margin-top */
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 40px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 20px; /* Adjusted margin-top */
        }

        select,
        input[type="submit"] {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }

        a {
            background-color: #601204;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
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
        <header>
            <h1>Tutor Page</h1>
        </header>
        <?php
        session_start(); // Start the PHP session
        include 'db.php'; // Include your database connection

        // Function to fetch unique states from the tutors table
        function getUniqueStates($conn)
        {
            $states = array();
            $query = "SELECT DISTINCT state FROM tutors ORDER BY state";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $states[] = $row['state'];
                }
            }
            return $states;
        }

        // Function to fetch unique districts for a given state
        function getUniqueDistricts($conn, $state)
        {
            $districts = array();
            $query = "SELECT DISTINCT district FROM tutors ORDER BY district";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $districts[] = $row['district'];
                }
            }
            return $districts;
        }

        // Function to display the form for state and district selection

        function displayStateDistrictForm($conn, $subject)
        {
            $states = getUniqueStates($conn);
            echo "<form action='tutors.php' method='get'>";
            echo "<input type='hidden' name='subject' value='$subject'>";
            echo "Select State: <select name='state'>";
            foreach ($states as $state) {
                echo "<option value='$state'>$state</option>";
            }
            echo "</select>";
            echo "Select District: <select name='district'>";
            // Initially populate with districts from the first state
            $firstStateDistricts = getUniqueDistricts($conn, $states[0]);
            foreach ($firstStateDistricts as $district) {
                echo "<option value='$district'>$district</option>";
            }
            echo "</select>";
            echo "<input type='submit' value='Find Tutors'>";
            echo "</form>";
        }

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "Please <a href='user_login.php'>login</a> to book a tutor.";
        } else {
            if (isset($_GET['subject'])) {
                $subject = $_GET['subject'];

                if (isset($_GET['state']) && isset($_GET['district'])) {
                    $state = $_GET['state'];
                    $district = $_GET['district'];

                    // SQL query to select tutors based on subject, state, and district
                    $sql = "SELECT id, name, phone, description FROM tutors WHERE subject = '$subject' AND state = '$state' AND district = '$district'";


                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>Tutors for $subject in $state, $district</h2>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<div>";
                            echo "<h3>{$row['name']}</h3>";
                            echo "<p>Phone: {$row['phone']}</p>";
                            echo "<p>Description: {$row['description']}</p>";
                            echo "<a href='book.php?tutor_id={$row['id']}'>Book</a>";
                            echo "</div>";
                        }
                    } else {
                        echo "No tutors found for $subject in $state, $district.";
                    }
                } else {
                    // Include the form here
                    displayStateDistrictForm($conn, $subject);
                }
            }
            $conn->close();
        }
        ?>
    </main>
    <footer>
        &copy; 2024 Tutor Booking. All rights reserved.
    </footer>
</body>

</html>
