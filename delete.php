<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Handles the logic to delete a game in the backlog
require_once 'loginChecker.php';
require_once 'database.php';    

// Check the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the backlog id
    $backlogId = $_POST['backlog_id']  ?? '';

    // Delete query
    $query = $pdo->prepare('DELETE FROM backlog WHERE backlog_id = :backlog_id');
    // Bind
    $query->bindValue(':backlog_id', $backlogId);
    // Run
    $query->execute();

    // Back to index
    header("Location: index.php");
    exit;
}
?>