<?php
session_destroy();

// Redirect the user to the login page
header("Location: welcome_page.html");
exit();
?>