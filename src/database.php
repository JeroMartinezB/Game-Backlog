<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Connect to the database
$host = 'db'; //localhost
$db   = 'Project 4'; 
$user = 'root';
$pass = 'root';

$dsn = "mysql:host=$host;dbname=$db";

// Use pdo to connect
$pdo = new PDO($dsn, $user, $pass);
?>