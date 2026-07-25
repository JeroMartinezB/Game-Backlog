<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
session_start();

require_once 'sessionManager.php';

$sessionManager = new sessionManager($pdo);
// Destroy the session and redirect to login
$sessionManager->logout();
$sessionManager->redirectToLogin();
?>