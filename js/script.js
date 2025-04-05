document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", function () {
            navLinks.classList.toggle("active");
        });

        // Close menu when clicking outside
        document.addEventListener("click", function (event) {
            if (!menuToggle.contains(event.target) && !navLinks.contains(event.target)) {
                navLinks.classList.remove("active");
            }
        });
    }
});

// Function to copy text to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show a temporary tooltip or alert
        alert('The phone number has been copied to your clipboard!');
    }).catch(err => {
        console.error('Failed to copy text: ', err);
    });
}

// Toggle mobile menu
document.querySelector('.menu-toggle')?.addEventListener('click', function() {
    document.querySelector('.nav-links').classList.toggle('active');
});

