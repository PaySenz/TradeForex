<?php
// login_processor.php

// Start a session to handle login state
session_start();

// Include the database connection file
require_once 'db_connection.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the username and password from POST data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Prepare a SQL query to fetch user data based on the username
        $stmt = $pdo->prepare("SELECT id, password, status FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Check if a user with the given username exists
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify password and check if user account is active
            if (password_verify($password, $user['password']) && $user['status'] == 1) {
                // Password is correct, and the user is active
                $_SESSION['user_id'] = $user['id'];
                header("Location: dashboard");
                exit;
            } else {
                // Password is incorrect or account is inactive
                header("Location: login?error=Invalid login credentials or account inactive.");
                exit;
            }
        } else {
            // User with the given username not found
            header("Location: login?error=User not found.");
            exit;
        }
    } catch (PDOException $e) {
        // Redirect to login with an error message if a database error occurs
        header("Location: login?error=Database error occurred.");
        exit;
    }
} else {
    // Redirect to login if accessed directly without POST data
    header("Location: login");
    exit;
}