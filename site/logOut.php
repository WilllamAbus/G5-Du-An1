<?php


session_start();
ob_start();
// Clear all session variables
if (isset($_COOKIE['ma_nd'])) {

    setcookie('ma_nd', "", time() - 3600);
    unset($_COOKIE['ma_nd']);
}


// Redirect to the login page or any other page
function nextPage()
{
    echo "<script>window.location.href = '../signIn.php'</script>";
    exit();
}

nextPage();
ob_end_flush();


?>

