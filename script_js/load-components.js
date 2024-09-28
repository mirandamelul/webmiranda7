document.addEventListener("DOMContentLoaded", function() {
    // Funcionalidad de fade-in
    const elements = document.querySelectorAll(".fade-in");

    elements.forEach(function(element) {
        element.style.opacity = 0;
        element.style.transition = "opacity 1s";

        setTimeout(function() {
            element.style.opacity = 1;
        }, 500);
    });
});
