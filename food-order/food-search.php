
<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
  // Check if the search form is submitted and the search keyword is set
  if (isset($_POST['search'])) {
    // Get the search keyword and escape it to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_POST['search']);
} else {
    // If no search keyword is provided, set a default value or handle it as needed
    $search = "";  // You can also redirect or show a message if no search is performed
}


        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
           

            //sql query to get food based on search keyword
            //$search = burger; drop database name; 
            //"SELECT * FROM tbl_food WHERE title LIKE '%burger%' OR DESCRIPTION LIKE '%burger%'"
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whetehr foods are availible or not 
            if($count>0)    
            {
            //food availible 
            while($row = mysqli_fetch_assoc($res))
            {
                //get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];    
                ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php
                             //check whetehr foods are availible or not 
                             if($image_name=="")
                             {
                                //Image not availible 
                                echo "<div class = 'error'>image not availible.</div>";
                             }
                             else
                            {
                                  //Image  availible 
                                  ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                  <?php
                            }
                            
                            ?>
                            
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                <?php
          
            }
        }
        else
        {
           //food not availible
           echo "<div class='error text-center'>Food not found for the search term \"<strong>$search</strong>\".</div>";
        }
            
            
            ?>

           
           
            </div>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>