<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['users'])) {
    // User is logged in, perform logout actions
    // ...

    // Destroy the session
    session_unset();
    session_destroy();
}

// Redirect the user to the login window
header("Location: login.php");
exit();
?>
