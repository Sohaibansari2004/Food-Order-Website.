<?php
include('partials/menu.php');
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br>

        <?php 
      
       
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // Display session message 
            unset($_SESSION['add']);  // Removing session message 
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  // Display session message 
            unset($_SESSION['delete']);  // Removing session message 
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];  // Display session message 
            unset($_SESSION['update']);  // Removing session message 
        }
        if(isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']); // Remove session message after displaying it
        }
        if(isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']); // Remove session message after displaying it
        }
        if(isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']); // Remove session message after displaying it
        }
        ?> 

        <!-- Button to add admin -->
        <br> <br> <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>   
                <th>Full Name</th>   
                <th>Username</th>   
                <th>Actions</th>   
            </tr>

            <?php
            // Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check whether the query is executed or not 
            if ($res == TRUE) {
                // Count rows to check whether we have data in the database or not
                $count = mysqli_num_rows($res);  // Function to get all the rows in database
                $sn = 1;  // create a variable and assign a value

                // Check the number of rows
                if ($count > 0) {
                    // We have data in the database
                    $sn = 1; // Create a variable and assign the value

                    while ($rows = mysqli_fetch_assoc($res)) {
                        // Using while loop to get all the data from database
                        // And while loop will run as long as we have data in database

                        // Get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // Display the values in our table
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // We do not have data in database
                }
            }
            ?>
        </table>

        <div class="clearfix"></div>
    </div>
</div>

<?php
include('partials/footer.php');
?>
