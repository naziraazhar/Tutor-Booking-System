<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];
        $user_name = $_POST['user_name'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // Perform validation and update the appointment in the database
        $sql = "UPDATE appointments 
                SET user_name = '$user_name', 
                    appointment_date = '$appointment_date', 
                    appointment_time = '$appointment_time' 
                WHERE id = $appointment_id";

        if ($conn->query($sql) === TRUE) {
            echo "Appointment updated successfully!";
        } else {
            echo "Error updating appointment: " . $conn->error;
        }
    }
} else {
    // If accessed directly without POST data or invalid data
    echo "Invalid request. Please submit the appointment form.";
}
?>
