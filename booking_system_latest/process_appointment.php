<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Retrieve data from the form
        $tutor_id = $_POST['tutor_id'];
        $user_id = $_SESSION['user_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // You may want to add additional validation and error handling here

        // Check if the specified tutor_id exists in the tutors table
        $checkTutorExistence = "SELECT COUNT(*) AS tutor_count FROM tutors WHERE id = $tutor_id";
        $tutorResult = $conn->query($checkTutorExistence);
        $tutorCount = $tutorResult->fetch_assoc()['tutor_count'];

        if ($tutorCount > 0) {
            // Insert the appointment into the database
            $sql = "INSERT INTO appointments (tutor_id, user_id, appointment_date, appointment_time)
                    VALUES ('$tutor_id', '$user_id', '$appointment_date', '$appointment_time')";

            if ($conn->query($sql) === TRUE) {
                // Redirect the user to the appointment page after successful booking
                header("Location: appointment.php");
                exit(); // Terminate the script after redirection
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Invalid tutor selection. Please select a valid tutor.";
        }
    } else {
        echo "User not logged in. Please log in to book an appointment.";
    }

    $conn->close();
} else {
    echo "Invalid request. Please submit the appointment form.";
}
?>
