document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll('[role="alert"]');

    notifications.forEach((notification) => {
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            notification.classList.remove("rombo-in");
            notification.classList.add("rombo-out");
            // Remove the element after animation completes
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 5000);
    });
});
