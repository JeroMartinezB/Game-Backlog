<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Start session
session_start();

// Include session manager and database
require_once 'src/sessionManager.php';
require_once 'src/database.php';

// Check if the credentials were submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    // Get username and password from form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sessionManager = new sessionManager($pdo);

    if ($sessionManager->authenticate($username, $password)) {
        // Log user in
        $sessionManager->logUserIn($username);
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

<!--Login-->
    <div id="login-container">
        <div>
            <h1>Jero's Backlog</h1> <br>
            <form action="login.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit" class="button">Log in</button>
            </form>
            <br><p>New here? <a href="newLogin.php">Create an account</a></p>
        </div>
    </div>
</body>
</html>