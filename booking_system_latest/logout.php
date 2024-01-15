<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    session_unset();
    
    // Destroy the session
    session_destroy();
    
    // Redirect the user to the login page or any other page after logout
    header("Location: home.html"); // You can change the destination URL
    exit();
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: home.html");
    exit();
}
?>