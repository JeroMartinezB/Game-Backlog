<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// First time login
// Connect to database
require 'src/database.php';

// Default values for input
$username = '';
$email = '';
$password = '';

// Check the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Get query ready
    $query = $pdo->prepare('INSERT INTO user (name, email, password_hash) VALUES (:name, :email, :password_hash)');

    // Placeholders before running the query
    $query->bindValue(':name', $username);
    $query->bindValue(':email', $email);
    $query->bindValue(':password_hash', $hashedPassword);

    // Run
    $query->execute();

    // Redirect to Login
    header("Location: login.php");
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--Background elements-->
    <div class="stars"></div>
    <div class="shooting-star"></div>
    <div class="shooting-star"></div>
    <div class="shooting-star"></div>
    <div class="shooting-star"></div>
    <div class="shooting-star"></div>

    <!--New Login-->
    <div id="newLogin-container">
        <div>
            <h1>Register</h1><br>   
            <form action="newLogin.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit" class="button">Register</button>
            </form>
            <br><p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>