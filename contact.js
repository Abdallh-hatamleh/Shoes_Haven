// script.js
document.addEventListener("DOMContentLoaded", function() {
    const popupTrigger = document.getElementById("popupTrigger");
    const popupBox = document.getElementById("popupBox");
    const closeButton = document.querySelector(".close-btn");

    popupTrigger.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the link from navigating
        popupBox.style.display = "flex"; // Show the floating box
    });

    closeButton.addEventListener("click", function() {
        popupBox.style.display = "none"; // Hide the floating box
    });

    // Hide the floating box when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target === popupBox) {
            popupBox.style.display = "none";
        }
    });
});
