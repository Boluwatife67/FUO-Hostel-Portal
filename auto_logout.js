// auto-logout.js
document.addEventListener('DOMContentLoaded', function () {
    var inactivityTimeout = 1200000;
    var logoutUrl = 'logout.php';

    var timeout;
    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(logout, inactivityTimeout);
    }

    function logout() {
        window.location.href = logoutUrl;
    }

    // Reset the timer on any user activity
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keydown', resetTimer);

    // Initialize the timer on page load
    resetTimer();
});
