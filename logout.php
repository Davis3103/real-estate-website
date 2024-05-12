<<<<<<< HEAD
<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
=======
<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
>>>>>>> 8684dd3655dfe61c5c89ee8f02d7f0fcff21cb89
exit();