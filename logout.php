<?php
session_start(); // Start the session

// Destroy the session to log out the user
session_destroy();

// Optionally, you can clear any specific session variables if needed
// unset($_SESSION['username']); // Example of unsetting a specific variable

// Redirect to the login page
header("Location: login.php?message=Successfully logged out."); // Update the URL as needed
exit(); // Ensure no further code is executed after the redirect
?>