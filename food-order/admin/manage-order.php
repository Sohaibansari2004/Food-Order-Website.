<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
    <h1>MANAGE ORDER</h1>
    <br>


    <?php
    
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];  // Display session message 
        unset($_SESSION['update']);  // Remove session message 
    }
    
    ?>
    <br><br>

<!-- button to add admin -->

<!-- <a href="#" class="btn-primary">Add Order</a>
<br>
<br> -->

<table class="tbl-full">
<tr>
                <th>S.N.</th>
                <th style="width: 122px;">Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th style="width: 59px;">Total</th>
                <th style="width: 105px;">Order_Date</th>
                <th style="width: 63px;">Status</th>
                <th style="width: 151px;">Customer-Name</th>
                <th>Contact</th>
                <th style="width: 151px;">Email</th>
                <th>Address</th>
                <th style="width: 134px;">Action</th>
            </tr>

            <?php
            //get all the orders from database
            $sql = "SELECT * FROM  tbl_order ORDER BY id DESC";   //display the latest order at first
            //execute Query
            $res = mysqli_query($conn,$sql);
            //count the rows
            $count = mysqli_num_rows($res);

            $sn = 1;  //create a serial number
            
            if($count>0)
            {
                //order availibale
                while($row = mysqli_fetch_assoc($res))
                {
                    //get all the order details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email= $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    ?>
                      <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $food;?></td>
                <td><?php echo $price;?></td>
                <td><?php echo $qty;?></td>
                <td><?php echo $total;?></td>
                <td><?php echo $order_date;?></td>

                <td>
                    <?php 
                    //Ordered , on delivery delivered , Cancellled;
                    if($status=="Ordered")
                    {
                        echo "<label>$status</label>";
                    }
                    elseif($status=="On Delivery")
                    {
                        echo "<label style = 'color: orange;'>$status</label>";    
                    }
                    elseif($status=="Delivered")
                    {
                        echo "<label style = 'color: green;'>$status</label>";    
                    }
                    elseif($status=="Cancelled")
                    {
                        echo "<label style = 'color: red;'>$status</label>";    
                    }
                
                    
                    ?>
                </td>
                <td><?php echo $customer_name;?></td>
                <td><?php echo $customer_contact;?></td>
                <td><?php echo $customer_email;?></td>
                <td><?php echo $customer_address;?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>

                 
                </td>
            </tr>



                    <?php
                }
            }
            else
            {
                 //order not availibale
                 echo "<tr><td colspan = '12' class = 'error'>Order not available</td></tr>";
            }
            
            
            ?>
          
     
</table>

    </div>
    
</div>


<?php
include('partials/footer.php')
?>