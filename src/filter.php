<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Handles all the filtering logic

// Connect to database and check login
require_once 'loginChecker.php';
require_once 'database.php';

// Get the user id
$userId = $_SESSION['user_id'];

// FILTERING AND DISPLAY
$filter = $_GET['filter'] ?? 'all';

// Get backlog data accordingly
if ($filter === 'started') {
    $query = $pdo->prepare('SELECT * FROM backlog WHERE user_id = :id 
    AND date_started IS NOT NULL AND date_completed IS NULL');
} 
elseif ($filter === 'completed') {
    $query = $pdo->prepare('SELECT * FROM backlog WHERE user_id = :id 
    AND date_completed IS NOT NULL');
} 
else { 
    $query = $pdo->prepare('SELECT * FROM backlog WHERE user_id = :id ORDER BY date_created DESC');
}

// Bind
$query->bindValue(':id', $userId);
// Execute
$query->execute();

// Get the data back from the query
$games = $query->fetchAll(PDO::FETCH_ASSOC);


?>