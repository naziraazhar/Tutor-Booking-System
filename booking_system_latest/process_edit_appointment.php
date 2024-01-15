<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Retrieve data from the form
        $appointment_id = $_POST['appointment_id'];
        $user_id = $_SESSION['user_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // You may want to add additional validation and error handling here

        // Update the appointment in the database
        $stmt = $conn->prepare("UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE id = ?");
        $stmt->bind_param("ssi", $appointment_date, $appointment_time, $appointment_id);
    
        if ($stmt->execute()) {
            // Redirect the user to the appointment page after successful update
            header("Location: appointment.php");
            exit(); // Terminate the script after redirection
        } else {
            echo "Error updating appointment: " . $stmt->error;
        }
    } else {
        echo "User not logged in. Please log in to update an appointment.";
    }

    $conn->close();
} else {
    echo "Invalid request. Please submit the appointment update form.";
}
?>
