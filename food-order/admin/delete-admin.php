<?php

// include constants.php here
include('../config/constants.php');

// 1. get the Id of admin to be deleted
$id = $_GET['id'];

// 2. create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";

// execute the query
$res = mysqli_query($conn, $sql);

// check whether the query was successfully executed or not
if ($res == true) {
    // echo "admin deleted";
    // create session variable to display message
    $_SESSION['delete'] = "<div class = 'success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
} else {
    // echo "admin not deleted";
    $_SESSION['delete'] = "<div class = 'error'>Failed to delete admin, please try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// 3. redirect to manage admin page with message (success/error)
?>
