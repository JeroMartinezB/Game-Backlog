/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */

// Uses AJAX to update the game status

// Wait for DOM to load
document.addEventListener("DOMContentLoaded", buttons);

// Create event listeners in the buttons
function buttons(){
    // Started button 
    let startButtons = document.querySelectorAll(".backlog-started-button");
    startButtons.forEach(addStartListener);
    // Completed button
    let completedButtons = document.querySelectorAll(".backlog-completed-button");
    completedButtons.forEach(addCompletedListener);
}

// Start button listener
function addStartListener(button){
    // Specify where the request goes and which class it changes to
    button.addEventListener("click", function(){
        updateStatus(button, "started.php", "game-item-started");
    });
}

// Complete button listener
function addCompletedListener(button){
    // Specify where the request goes and which class it changes to
    button.addEventListener("click", function(){
        updateStatus(button, "completed.php", "game-item-completed");
    });
}

// Send the AJAX request to update
async function updateStatus(button, phpFile, newClass) {
    // Read the backlog id
    let backlogId = button.dataset.id;

    try {
        // Send request and get response
        let response = await sendPostRequest(phpFile, "backlog_id=" + encodeURIComponent(backlogId));

        // If the request is successful update the visuals
        if (response === "success") {

            // Change the color of the div to differentiate
            // Find the div that contains the button
            let gameDiv = button.closest(".game-item");

            // Add the new CSS class
            gameDiv.classList.add(newClass);

        } else {
            alert("Server error");
        }

    } catch (error) {
        console.error("Ajax request failed", error);
    }
}

// Helper function that sends POST request using fetch
// File being the php file the request goes to, and body all the necessary information to update the database
async function sendPostRequest(file, body) {
    let response = await fetch(file, {
        // Request parameters (Did some research)
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"}, 
        body: body

    });

    // Return the response from php
    return await response.text();
}
