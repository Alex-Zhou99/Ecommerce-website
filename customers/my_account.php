<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");
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
                <a href="../index.php"><img id="logo" src="images/logo.gif"/></a>
                <img id="banner" src="images/ad-banner.gif"/>
            </div>
            <!-- Header ends here-->
            
            <!-- Navegation Bar starts here-->
            <div class="menubar">
                <ul id="menu"><!-- 无序列表-->
                    <li><a href="../index.php">Home</a></li>
				    <li><a href="../all_products.php">All Products</a></li>
				    <li><a href="../customers/my_account.php">My Account</a></li>
				    <li><a href="../customer_register.php">Sign Up</a></li>
				    <li><a href="cart.php">Shopping Cart</a></li>
				    <li><a href="../contact_us.php">Contact Us</a></li>
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
                    <div id="sidebar_title">My Account</div>
                    <ul id="cats">
                        <?php
                            $user = $_SESSION['customer_email'];
                            $get_img = "select * from customers where customer_email='$user'";
                            $run_img = mysqli_query($con, $get_img); 
                            $row_img = mysqli_fetch_array($run_img); 
                            $c_image = $row_img['customer_image'];
                            $c_name = $row_img['customer_name'];
                            echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
                        ?>
                        <li><a href="my_account.php?my_orders">My Orders</a></li>
                        <li><a href="my_account.php?edit_account">Edit Account</a></li>
                        <li><a href="my_account.php?change_pass">Change Password</a></li>
                        <li><a href="my_account.php?delete_account">Delete Account</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                   
                <?php cart(); ?>
                <div id="shopping_cart">
                    <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                        <?php 
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome:</b>" . $_SESSION['customer_email'];
                            }
                        ?>
                        
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
                        <?php 
                            if(!isset($_GET['my_orders'])){
                                if(!isset($_GET['edit_account'])){
                                    if(!isset($_GET['change_pass'])){
                                        if(!isset($_GET['delete_account'])){
                            echo "
                            <h2 style='padding:20px;'>Welcome:  $c_name </h2>
                            <b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
                                        }
                                    }
                                }
                            }
                        ?>
                        <?php 
                            if(isset($_GET['edit_account'])){
                                include("edit_account.php");
                            }
                            if(isset($_GET['change_pass'])){
                                include("change_pass.php");
                            }
                            if(isset($_GET['delete_account'])){
                                include("delete_account.php");
                            }
                            if(isset($_GET['my_orders'])){
                                include("my_orders.php");
                            }
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