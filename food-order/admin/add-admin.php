<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php 
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // Display session message 
            unset($_SESSION['add']);  // Removing session message 
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form> 
    </div>
</div>

<?php
include('partials/footer.php');

// Process the value from form and save it in the database
if (isset($_POST['submit'])) {
    // Get the data from form
    $full_name = $_POST['full_name']; 
    $username = $_POST['username']; 
    $password = md5($_POST['password']); // Password encryption

    // SQL query to save the data into the database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'";

    // Execute query and saving data into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Check whether data is inserted or not
    if ($res == true) {
        // Query executed and admin added
        $_SESSION['add'] = "Admin Added Successfully";
        // Redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        // Failed to add admin
        $_SESSION['add'] = "Failed to Add Admin";
        // Redirect page to add admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>
