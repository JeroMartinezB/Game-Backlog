<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Submits reviews

// Check session and connect to database
require_once 'loginChecker.php';
require_once 'database.php';

// Get the user id
$userId = $_SESSION['user_id'];

// Check the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data
    $date = date('Y-m-d H:i:s') ?? '';
    $gameName = $_POST['name'] ?? '';
    $gamePlatform = $_POST['platform'] ?? '';
    $content = $_POST['review'] ?? '';
    $stars = $_POST['rating'] ?? '';

    // Get query ready
    $query = $pdo->prepare('INSERT INTO review
    (user_id, date_submitted, game_name, game_platform, content, stars)
    VALUES
    (:user_id, :date_submitted, :game_name, :game_platform, :content, :stars)');

    // Bind
    $query->bindValue(':user_id', $userId);
    $query->bindValue(':date_submitted', $date);
    $query->bindValue(':game_name', $gameName);
    $query->bindValue(':game_platform', $gamePlatform);
    $query->bindValue(':content', $content);
    $query->bindValue(':stars', $stars);

    // Run
    $query->execute();

    // Avoid form resubmission
    header("Location: reviews.php");
    exit;
}

?>