<?php
// db_connection.php

// Database connection parameters
$host = 'localhost';       // Database host
$db = 'trading';     // Database name
$user = 'doller';   // Database username
$pass = '$#Iraji12120';   // Database password

try {
    // Create a new PDO instance and set error mode to exception
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop execution and display a user-friendly error message if connection fails
    die("Database connection failed: " . $e->getMessage());
}