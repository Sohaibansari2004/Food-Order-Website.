<?php   include('../config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
<h1 class = "text-center">Login-page </h1>

           <?php
            if(isset($_SESSION['login'])) 
            {
            echo $_SESSION['login'];  // Display session message 
            unset($_SESSION['login']);  // Removing session message 
        }
        if(isset($_SESSION['no-login-message'])) 
            {
            echo $_SESSION['no-login-message'];  // Display session message 
            unset($_SESSION['no-login-message']);  // Removing session message 
        }
       
                ?>
            <!-- login form start here  -->
            <form action="" method="POST" class = "text-center"> <br>
                Username :  <br>
                <input type="text"name="username" placeholder="Enter username">
                <br><br>
                Password : <br>
                <input type="password"name="password" placeholder="Enter password">
                <br> <br>
                <input type="submit" name="submit" value="login" class="btn-primary">
                <br><br>
             </form>

            <!-- login form end here  -->
            <p class = "text-center">Created by - <a href="Sohaib Ansari">Sohaib Ansari</a></p>

</body>
</html>
<?php
// chek whether the submit button is clicked or not 
if(isset($_POST['submit']))
{


    // process for login
    // 1. get the data from login form
    // $username = $_POST['username'];
    // $password = md5($_POST['password']);

    $username = mysqli_real_escape_string($conn, $_POST['username']);

     $raw_password = md5($_POST['password']);

    $password = mysqli_real_escape_string($conn,$raw_password);



  //    2. sql to check the user with uername and password exist or not
$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password= '$password'";

// 3.// execute the query
$res = mysqli_query($conn,$sql);


//    4.count rows to check whether the user exist or not
$count = mysqli_num_rows($res);

if ($count==1)
{
    // user availible and login success
$_SESSION['login'] =" <div class= 'success'>Login successfull</div> ";
$_SESSION['user'] = $username;  //to check whetherthe user is logged in or not and log out wil unset it 

// redirect to home oage dashboard
header('location:'.SITEURL.'admin/');
}
else
{
   // user availible and login fail
   $_SESSION['login'] =" <div class = 'error text-center'>username or password did not match</div> ";
   // $_SESSION['user'] = $username;  //to check whetherthe user is logged in or not and log out wil unset it 
   // redirect to home oage dashboard
   header('location:'.SITEURL.'admin/login.php');
}
}
   ?>