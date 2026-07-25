<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Handles all the main page logic for creating a new game

// Connect to database and check login
require_once 'loginChecker.php';
require_once 'database.php';

// Default values for input
$game = '';
$platform = '';

// Get the user id
$userId = $_SESSION['user_id']; 

// CREATE A NEW GAME 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data
    $game = $_POST['game'];
    $platform = $_POST['platform'] ?? '';
    $dateCreated = date('Y-m-d H:i:s') ?? '';
    $dateStarted = null;
    $dateCompleted = null;

    // Get query ready
    $gameQuery = $pdo->prepare('INSERT INTO backlog 
    (user_id, date_created, game_name, game_platform, date_started, date_completed)
    VALUES 
    (:user_id, :date_created, :game_name, :game_platform, :date_started, :date_completed)');

    // Placeholders
    $gameQuery->bindValue(':user_id', $userId);
    $gameQuery->bindValue(':date_created', $dateCreated);
    $gameQuery->bindValue(':game_name', $game);
    $gameQuery->bindValue(':game_platform', $platform);
    $gameQuery->bindValue(':date_started', $dateStarted);
    $gameQuery->bindValue(':date_completed', $dateCompleted);

    // Run
    $gameQuery->execute();


    
    // Avoid form resubmission
    header("Location: index.php");
    exit;
}

?>