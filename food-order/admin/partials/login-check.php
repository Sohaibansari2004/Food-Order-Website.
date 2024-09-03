<?php 
// session_start();

// Authorization - Access Control
//check whether the user is logged in or not

if (!isset($_SESSION['user']))  //if user session is not set
{
     // User is not logged in
    // Redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin panel.</div>";
    header('location:'. SITEURL.'admin/login.php');
}
?>
