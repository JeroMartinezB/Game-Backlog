/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Js program to collapse and show the adding forms

// Wait for DOM to load
document.addEventListener("DOMContentLoaded", add);

// Create event listener
function add(){
    document.querySelector("#addButton").addEventListener("click", show);
}

// Function to show after click
function show(){
    let form = document.querySelector("#addForm");

    // Make it visible
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}