<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Main review page

require_once 'src/loginChecker.php';
require_once 'src/database.php';
require_once 'src/submitReview.php';
require_once 'src/like.php';
require_once 'src/dislike.php';

// Get data to display
$reviewQuery = $pdo->prepare('SELECT * FROM review JOIN user ON review.user_id = user.user_id ORDER BY date_submitted DESC');
// Execute
$reviewQuery->execute();
// Fetch data
$reviews = $reviewQuery->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <script src="js/addNew.js"></script>
    <script src="js/likeButtons.js"></script>
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
    <!--Navigation-->
    <div class="navigation-bar">
        <nav>
                <a href="index.php">Backlog</a>
                <a href="reviews.php">Reviews</a>
        </nav><br>
    </div>
    <div id="reviews-container">
    <!--Logout-->
        <div class="logout-button">
            <a href="src/logout.php">Logout</a> 
        </div>
    <!--Submit a review-->
        <div>
            <br>
            <button id="addButton" class="button">Add New Review</button>
            <form id="addForm" action="reviews.php" method="POST" style="display:none;">
                <label for="rating">Rating (Stars)</label><br>
                <select name="rating" id="rating">
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select> <br>

                <label for="name">Game Name</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="platform">Platform</label><br>
                <input type="text" id="platform" name="platform" required><br>

                <label for="review">Review</label><br>
                <textarea name="review" id="review" placeholder="Enter your review here..."></textarea><br>

                <button type="submit" class="button">Add</button>
            </form>
        </div>
    <!--Display reviews-->
        <?php foreach ($reviews as $review): ?>
            <div class="review-item">
                <h2> <?php echo htmlspecialchars($review['game_name']); ?></h2>
                <h4> On <?php echo htmlspecialchars($review['game_platform']); ?></h4>
                <h4> <?php echo htmlspecialchars($review['stars']); ?> Stars</h4>
                <p> By <?php echo htmlspecialchars($review['name']); ?> <br><br>
                    <?php echo htmlspecialchars($review['content']); ?></p><br>
        <!--Like / dislike using AJAX-->
                <div class="like-container">
                    <button 
                        type="button" 
                        class="like-button"
                        data-review-id="<?php echo $review['review_id'];?>"
                        data-user-id="<?php echo $review['user_id']; ?>">
                        👍
                    </button>
                    <span class="likes-count"> <?php echo $review['likes']; ?></span>

                    <button 
                        type="button" 
                        class="dislike-button"
                        data-review-id="<?php echo $review['review_id'];?>"
                        data-user-id="<?php echo $review['user_id']; ?>">
                        👎
                    </button>
                    <span class="dislikes-count"> <?php echo $review['dislikes']; ?></span>
                </div>  
            </div>
        <?php endforeach ?>
    </div>
</body>
</html>