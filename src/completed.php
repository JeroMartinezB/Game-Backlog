<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Handles the logic for the completed button in the backlog
require_once 'loginChecker.php';
require_once 'database.php';

// Check the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the backlog id
    $backlogId = $_POST['backlog_id']  ?? '';
    
    // Get the current date
    $date = date('Y-m-d H:i:s') ?? '';

    // Prepare the query
    $query = $pdo->prepare('UPDATE backlog SET date_completed = :date WHERE backlog_id = :backlog_id');

    // Bind values
    $query->bindValue(':date', $date);
    $query->bindValue(':backlog_id', $backlogId);

    // Execute
    if ($query->execute()) {
        echo "success";
    } else {
        echo "database error";
    }
    
    exit;
}
?>