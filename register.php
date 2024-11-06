<?php
// register.php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize input data
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $country_code = htmlspecialchars($_POST['country_code']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($country_code) || empty($mobile)) {
        echo "All fields are required.";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, email, country_code, mobile, password) VALUES (:firstname, :lastname, :username, :email, :country_code, :mobile, :password)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':country_code', $country_code);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':password', $hashed_password);

    try {
        $stmt->execute();
        $_SESSION['success_message'] = "Registration successful! Please log in."; // Set success message in session
        header("Location: login.php"); // Redirect to login page
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') { // Duplicate entry code
            echo "Username or email already exists.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>