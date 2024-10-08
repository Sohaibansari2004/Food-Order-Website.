<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>
        <?php 
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // Display session message 
            unset($_SESSION['add']);  // Removing session message 
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];  // Display session message 
            unset($_SESSION['remove']);  // Removing session message 
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  // Display session message 
            unset($_SESSION['delete']);  // Removing session message 
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];  // Display session message 
            unset($_SESSION['no-category-found']);  // Removing session message 
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];  // Display session message 
            unset($_SESSION['update']);  // Removing session message 
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];  // Display session message 
            unset($_SESSION['failed-remove']);  // Removing session message 
        }
        ?>
        
        <br>
        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // query to get all category from database
            $sql = "SELECT * FROM tbl_category";

            // execute the query
            $res = mysqli_query($conn, $sql);
            
            // count rows
            $count = mysqli_num_rows($res);

            // create serial number variable and assign value as 1
            $sn = 1;

            // check whether we have data in database or not
            if ($count > 0) {
                // we have data in database
                // get the data and display
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                            // check whether image name is available or not
                            if($image_name != "") {
                                // display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="55px">
                                <?php
                            } else {
                                // display the message
                                echo "<div class='error'>Image not Added</div>";    
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?> &image_name=<?php echo "$image_name"?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                // we do not have data
                // we will display the message inside the table
                ?>
                <tr>
                    <td colspan="6"> <div class="error">No Category Added.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
