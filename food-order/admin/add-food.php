<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];  // Display session message
            unset($_SESSION['upload']);  // Remove session message
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        <?php
                        // Create SQL query to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        // Execute query
                        $res = mysqli_query($conn, $sql);
                        // Count rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        // If count is greater than zero, we have categories, else we do not have categories
                        if ($count > 0) {
                            // We have categories
                            while ($row = mysqli_fetch_assoc($res)) {
                                // Get the details of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        } else {
                            // We do not have categories
                            ?>
                            <option value="0">No category found</option>
                            <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check whether the radio button for featured and active are checked or not
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Upload the image if selected
            if (isset($_FILES['image']['name'])) {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // Check whether the image is selected or not and upload image only if selected
                if ($image_name != "") {
                    // Image is selected
                    // Rename the image
                    // Get the extension of the selected image (jpg, png, gif, etc)
                    $ext = end(explode('.', $image_name));

                    // Create a new name for the image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // New image name

                    // Upload the image
                    // Get the src and destination paths

                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;

                    // Finally, upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    // Check whether the image is uploaded or not
                    if ($upload == false) {
                        // Failed to upload the image
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header("location:" . SITEURL . "admin/add-food.php");
                        die();
                    }
                } else {
                    $image_name = "";
                }
            } else {
                $image_name = "";
            }

            // Insert data into database
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the data is inserted or not
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
