<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
?>
<html>
    <head>
        <title>My Online Shop</title>
        <link rel="stylesheet" href="styles/style.css" media="all" />
    </head>
    
    <body>
        <!-- Main Container starts here-->
        <div class="main_wrapper">
            <!-- Header starts here-->
            <div class="header_wrapper">
                <a href="index.php"><img id="logo" src="images/logo.gif"/></a>
                <img id="banner" src="images/ad-banner.gif"/>
            </div>
            <!-- Header ends here-->
            
            <!-- Navegation Bar starts here-->
            <div class="menubar">
                <ul id="menu"><!-- 无序列表-->
                    <li><a href="index.php">Home</a></li>
				    <li><a href="all_products.php">All Products</a></li>
				    <li><a href="customers/my_account.php">My Account</a></li>
				    <li><a href="customer_register.php">Sign Up</a></li>
				    <li><a href="cart.php">Shopping Cart</a></li>
				    <li><a href="contact_us.php">Contact Us</a></li>
                    <div id="form">
                        <form method="get" action="results.php" enctype="multipart/form-data">
                            <input type="text" name="user_query" placeholder= "Search a Product"/>
                            <input type="submit" name="search" value="Search"/>
                        </form>
                    </div>
                </ul>

            </div>
            <!-- Navegation Bar ends here-->
            
            <!-- Content starts here-->
            <div class="content_wrapper">
                <div id="sidebar">
                    <div id="sidebar_title">Categories</div>
                    <ul id="cats">
                        <?php getCats(); ?>
                    </ul>
                    <div id="sidebar_title">Brands</div>
                    <ul id="cats">
                        <?php getBrands(); ?>
                    </ul>
                </div>
                <?php cart(); ?>
                <div id="shopping_cart">
                    <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                        <?php 
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
                            }else {
                                echo "<b>Welcome Guest:</b>";
                            }
                        ?>
                        
                        
                        <b style="color:yellow">Shopping Cart-</b>Total Items: <?php total_items(); ?>  Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow"> Go to Cart</a>
                        
                        <?php 
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php' style='color:orange;'>Login</a>";
                            }
                            else {
                                echo "<a href='logout.php' style='color:orange;'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div id="content_area">
                    
                    <div id="products_box">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table align="center" width="700" bgcolor="skyblue">
                                <tr align="center">
                                    <th>Remove</th>
                                    <th>Product(S)</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                <?php 
                                $total = 0;
                                global $con; 
                                $ip = getIp(); 
                                $sel_price = "select * from cart where ip_add='$ip'";
                                $run_price = mysqli_query($con, $sel_price); 
                                while($p_price=mysqli_fetch_array($run_price)){
                                    $pro_id = $p_price['p_id']; 
                                    $pro_price = "select * from products where product_id='$pro_id'";
                                    $run_pro_price = mysqli_query($con,$pro_price); 
                                    while ($pp_price = mysqli_fetch_array($run_pro_price)){
                                    $product_price = array($pp_price['product_price']);
                                    $product_title = $pp_price['product_title'];
                                    $product_image = $pp_price['product_image']; 
                                    $single_price = $pp_price['product_price'];
                                    $values = array_sum($product_price); 
                                    $total += $values; 

                                ?>
                                <tr align="center">
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                                <td><?php echo $product_title; ?><br>
                                <img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                                </td>
                                <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>
                                <?php 
                                if(isset($_POST['update_cart'])){
                                    $qty = $_POST['qty'];
                                    $update_qty = "update cart set qty='$qty'";
                                    $run_qty = mysqli_query($con, $update_qty); 
                                    $_SESSION['qty']=$qty;
                                    $total = $total*$qty;
                                }
                                ?>
                                <td><?php echo "$" . $single_price; ?></td>
                            </tr>
                            <?php } } ?>
                            <tr>
                                    <td colspan="4" align="right"><b>Sub Total:</b></td>
                                    <td><?php echo "$" . $total;?></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
                                    <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                                    <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
                                </tr>

                            </table>
                        </form>
                        <?php
                        function updatecart(){
                            global $con;
                            $ip = getIp();
                            if(isset($_POST['update_cart'])){
                                foreach($_POST['remove'] as $remove_id){
                                    $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                                    $run_delete = mysqli_query($con, $delete_product);
                                    if($run_delete){
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    }
                                }
                            }
                            if(isset($_POST['continue'])){
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                        }
                        echo @$up_cart = updatecart();
                       ?>	

                    </div>

                </div>
            </div>
            <!-- Content ends here-->
            
            <!-- Footer starts here-->
            <div id="footer">
                <h2 style="text-align: center; padding-top: 30px;">&copy;
                    2016 by edward-shi<!-- &copy元素用于通知版权资料-->
                </h2>
            </div>
            <!-- Footer ends here-->
        </div>
        <!-- Main Container ends here-->
    </body>

</html>