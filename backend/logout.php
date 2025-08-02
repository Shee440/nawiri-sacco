<?php
ini_set('session.save_path', 'C:/Users/warima/Desktop/nawiri sacco/sessions');
session_start();
session_unset();     // remove session variables
session_destroy();   // destroy the session

// Redirect to login page
header("Location: ../frontend/login.html");
exit;
