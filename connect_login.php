<?php
session_start(); // Start the session
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        header("Location: dashboard.php"); // Redirect to dashboard
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>