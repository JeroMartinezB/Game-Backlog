<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Main Backlog page

// Check Login and connect to database
require_once 'src/loginChecker.php';
require_once 'src/database.php';
require_once 'src/home.php';
require_once 'src/filter.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backlog Home</title>
    <script src="js/addNew.js"></script>
    <script src="js/gameButtons.js"></script>
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
<!--Add a new game to the backlog-->
<div id="home-container">
    <div id="add-container">
        <button id="addButton" class="button">Add New</button>
        <form id="addForm" action="index.php" method="POST" style="display:none;">
            <label for="game">Game:</label><br>
            <input type="text" id="game" name="game" required><br>

            <label for="platform">Platform:</label><br>
            <input type="text" id="platform" name="platform" required><br><br>

            <button type="submit" class="button">Create</button> 
        </form><br>
    </div>
<!--Logout-->
    <div class="logout-button">
        <a href="src/logout.php">Logout</a> 
    </div>

    <!--Filter option-->
    <div id="filter-container">
        <br>
        <h3>Filter:</h3>
        <form action="index.php" method="GET">
            <input type="hidden" name="filter" value="all">
            <button type="submit" class="button">All</button>
        </form> <br>
        <form action="index.php" method="GET">
            <input type="hidden" name="filter" value="started">
            <button type="submit" class="button">Started</button>
        </form> <br>
        <form action="index.php" method="GET">
            <input type="hidden" name="filter" value="completed">
            <button type="submit" class="button">Completed</button>
        </form> <br>
    </div>

<!--Games-->
    <?php foreach ($games as $game): ?>
    <!--Determine Class for layout-->
    <?php

        $status = "";
        if (!is_null($game['date_completed'])) {
            $status = "-completed";
        } elseif (!is_null($game['date_started'])) {
            $status = "-started";
        }
    ?>
        <div class="game-item<?php echo $status;?>">
            <h3> <?php echo htmlspecialchars($game['game_name']);?></h3>
    <!--Delete-->
        <form action="delete.php" method="POST">
            <input type="hidden" name="backlog_id" value="<?php echo $game['backlog_id'];?>">
            <button type="submit" class="backlog-button">Delete</button>
        </form> <br>
    <!--Mark the game as started using AJAX-->    
        <button 
            type="button" 
            class="backlog-started-button"
            data-id="<?php echo $game['backlog_id'];?>">
            Start
        </button>
    <!--Mark the game as completed using AJAX-->    
        <button 
            type="button" 
            class="backlog-completed-button"
            data-id="<?php echo $game['backlog_id'];?>">
            Complete
        </button>
        </div>
    <?php endforeach ?>
</div>
</body>
</html>