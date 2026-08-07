/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Uses AJAX to update like and dislike count

// Load DOM 
document.addEventListener("DOMContentLoaded", setUpButtons);

// Add event listeners to the buttons
function setUpButtons(){
    // Like button
    let likeButton = document.querySelectorAll(".like-button");
    likeButton.forEach(addLikeListener);
    // Dislike button
    let dislikeButton = document.querySelectorAll(".dislike-button");
    dislikeButton.forEach(addDislikeListener);
}

// Like button listener
function addLikeListener(button){
    button.addEventListener("click", function(){
        updateCount(button, "like.php");
    });
}

// Dislike button listener
function addDislikeListener(button){
    button.addEventListener("click", function(){
        updateCount(button, "dislike.php");
    });
}

// Send the AJAX request to the db
async function updateCount(button, phpFile) {
    // Read the review and user ids
    let reviewId = button.dataset.reviewId;
    let userId = button.dataset.userId;
    // Request Body
    let body = "review_id=" + encodeURIComponent(reviewId) +
                "&user_id=" + encodeURIComponent(userId);

    try {
        // Send request and get data back
        let data = await sendPostRequest(phpFile, body);

        // Update counts
        let reviewItem = button.closest(".like-container");
        reviewItem.querySelector(".likes-count").textContent = data.likes;
        reviewItem.querySelector(".dislikes-count").textContent = data.dislikes;
        
    } catch (error) {
        console.error("Ajax request failed", error);
    }
}

// Send POST request using fetch
async function sendPostRequest(file, body) {

    let response = await fetch(file, {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: body
    });
    // Return the response from php
    return await response.json();
}