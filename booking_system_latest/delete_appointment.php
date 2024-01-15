<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];

        // Delete the appointment from the database
        $sql = "DELETE FROM appointments WHERE id = $appointment_id";

        if ($conn->query($sql) === TRUE) {
            echo "Appointment deleted successfully!";
        } else {
            echo "Error deleting appointment: " . $conn->error;
        }
    }
} else {
    // If accessed directly without POST data or invalid data
    echo "Invalid request. Please submit the appointment form.";
}
?>
