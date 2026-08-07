<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Handles the like button logic (AJAX)
require_once 'loginChecker.php';
require_once 'database.php';

// Check form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the review and user ids
    $reviewId = $_POST['review_id']  ?? '';
    $userReview = (int)($_POST['user_id']  ?? 0);

    // User cannot like own review
    if ($_SESSION['user_id'] === $userReview) {
        header("Location: reviews.php");
        exit;
    } 

    // Prepare query
    $likeQuery = $pdo->prepare('UPDATE review SET likes = likes + 1 WHERE review_id = :review_id');
    // Bind
    $likeQuery->bindValue(':review_id', $reviewId);
    // Run
    $likeQuery->execute();

    // Fetch the updated counts 
    $updatedCount = $pdo->prepare('SELECT likes, dislikes FROM review WHERE review_id = :review_id');
    // Bind
    $updatedCount->bindValue(':review_id', $reviewId);
    // Execute
    $updatedCount->execute();
    // Get data
    $likeData = $updatedCount->fetch(PDO::FETCH_ASSOC);

    echo json_encode($likeData);
    exit;

}
?>