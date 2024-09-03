<?php

//include constant.php
include('../config/constants.php');
// echo "ha sain ky hal hai!!!!!";

if(isset($_GET['id']) && isset($_GET['image_name'])) // either use && or AND
{


    //process to delete
    // echo "process to delete";

      //1. get id and image name 
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

        //2. remove the image if availible
    //check whether the image is availible or not delete only if a availible
    if($image_name!="")
    {
        ///it has image and need remove from folder
        //get the image path
        $path = "../images/food/".$image_name;

        //remove image file from folder
        $remove = unlink($path);
        
        //check whether the image is removed or not
        if($remove==false)
        {
            //failed to remove image 
            $_SESSION['upload'] = "<div class='error'> Failed to remove Image file.</div>";
            //redirect to manage food 
            header("location:".SITEURL."admin/manage-food.php");
            //stop the process of deleting food
            die();
        }
    }
    
    //3. delete food from database
    $sql= "DELETE FROM tbl_food WHERE id = $id";

    // execute the query
    $res= mysqli_query($conn,$sql);
    //check whether the query executed or not and set the session message respectively
    //4. redirect with manage food with session message 

    if($res==true)
    {
        //food deleted
        $_SESSION['delete'] = "<div class='success'> Food deleted successfully .</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
    else
    {
              //failed to delete food 
              $_SESSION['delete'] = "<div class='error'> failed to delete food .</div>";
              header("location:".SITEURL."admin/manage-food.php");  
    }
}
else
    {
              //failed to delete food 
              $_SESSION['unauthorize'] = "<div class='error'> failed to delete food .</div>";
              header("location:".SITEURL."admin/manage-food.php");  
    }
?>