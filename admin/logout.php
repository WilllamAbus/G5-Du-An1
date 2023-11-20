<?php
ob_start(); // Start output buffering
session_start();
include_once '../dao/user.php';


// Clear all session variables

//  setcookie('user_admin', "", time() - 10800);

// Destroy the session
// session_destroy();

if (isset($_COOKIE['user_admin'])) {

    // setcookie('user_admin', time() - 3600);
    unset($_COOKIE['user_admin']);
}


function nextPage()
{
    echo "<script>window.location.href = '../signIn.php'</script>";
    unset($_COOKIE['user_admin']);
}

nextPage();
ob_end_flush();
?>












