<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Start the session
session_start();

require_once 'sessionManager.php';

$sessionManager = new sessionManager($pdo);

// Make sure the user is logged in
if (!$sessionManager->isLoggedIn()) {
    $sessionManager->redirectToLogin();
}

?>