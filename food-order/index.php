<!-- index.php -->

<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];  // Display session message 
            unset($_SESSION['order']);  // Remove session message 
        }
        ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

        <?php
        //create sql query to display categories form database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured = 'Yes'LIMIT 3";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //Count row to check whether the category is availible or not
        $count = mysqli_num_rows($res);
        
        if($count>0)
        {
                //categories availible 
                while($row= mysqli_fetch_assoc($res))
                {
                    //Get the value like id, title, image name 
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
            <div class="box-3 float-container">
                <!-- check whether the image is availible or not  -->
                <?php
                if($image_name=="")
                {
                    //display the message
                    "<div class = 'error'>image not availible</div>";
                }
                else
                {
                        // image available
                        ?>
             <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">

                        <?php
                }
                ?>
                  <h3 class="float-text text-white"><?php echo $title;?></h3>
            </div>
            </a>

                    <?php
                }
        }
        else
        {
            //categories not availible 
            echo "<div class = 'error'>Category not added</div>";
        }
        
        
        ?>

 

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
             //getting food from database that are active and featured\
             //sql query
             $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

             
             //execute the query
             $res2 = mysqli_query($conn,$sql2);

             //count rows 
             $count2 = mysqli_num_rows($res2);

             //check whether categories are available or not 
             if($count2>0)
             {
                //food availible
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];    
              
                ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                <?php
                //check whether image is avalible or not
                if($image_name=="")
                {
                    //image not available
                    echo "<div class = 'error'>image not found.</div>";

                }
                else
                {
                    //image available
                
                    ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php

                    }
                ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$ <?php echo number_format($price, 2); ?></p>
                    <p class="food-detail">
                    <?php echo $description;?> 
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

             <?php
        
             }
            }
             else
             {
                 //food not availible
                 echo "<div class = 'error'>food not available.</div>";
             }

             ?>















            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php')?>