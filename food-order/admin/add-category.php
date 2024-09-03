<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br> 
        <?php 
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // Display session message 
            unset($_SESSION['add']);  // Removing session message 
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];  // Display session message 
            unset($_SESSION['upload']);  // Removing session message 
        }
        ?>

        <!-- add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Select Image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //1. Get the values from category form
            $title = $_POST['title'];

            // For radio input, we need to check whether the button is selected or not
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Check whether the image is selected or not and set the value for image name accordingly
            if (isset($_FILES['image']['name'])) {
                // upload the image 
                // to upload image we need image name, source path, and destination path
                $image_name = $_FILES['image']['name'];

 //  upload the image if only image is selected
        if($image_name != "")
        {
                // Auto rename our image
                // Get the extension of our image (jpg, png, gif, etc.)
                $ext = end(explode('.', $image_name));
                
                // Rename the image name
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;  // e.g "food_category_123.jpg"

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                // Finally, upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                // If the image is not uploaded then we will stop the process and redirect with error message
                if ($upload == false) {
                    // Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    // Redirect to add category page
                    header("location:" . SITEURL . "admin/add-category.php");
                    // Stop the process
                    die();
                }
            }
            } else {
                // Don't upload image and set the image_name value as blank
                $image_name = "";
            }

            //2. Create SQL query to insert category into database
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            //3. Execute the query
            $res = mysqli_query($conn, $sql);

            //4. Check whether query executed or not and data added or not
            if ($res == true) {
                // Query executed and category added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                // Redirect to manage category page
                header("location:" . SITEURL . "admin/manage-category.php");
            } else {
                // Failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                // Redirect to add category page
                header("location:" . SITEURL . "admin/add-category.php");
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
