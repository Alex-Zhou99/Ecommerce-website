
                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
					    <table align="center" width="750">
                            <tr align="center">
                                <td colspan="6"><h2>Update Your Account</h2></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Name:</td>
                                <td><input type="text" name="c_name" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Customer Email:</td>
                                <td><input type="text" name="c_email" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Customer Password:</td>
                                <td><input type="password" name="c_pass" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Customer Image:</td>
                                <td><input type="file" name="c_image" required/></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Country:</td>
                                <td>
                                <select name="c_country">
                                    <option>Select a Country</option>
                                    <option>Afghanistan</option>
                                    <option>India</option>
                                    <option>Japan</option>
                                    <option>Pakistan</option>
                                    <option>Israel</option>
                                    <option>Nepal</option>
                                    <option>United Arab Emirates</option>
                                    <option>United States</option>
                                    <option>United Kingdom</option>
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td align="right">Customer City:</td>
                                <td><input type="text" name="c_city" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Customer Contact:</td>
                                <td><input type="text" name="c_contact" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Customer Address</td>
                                <td><input type="text" name="c_address" required/></td>
                            </tr>
                            <tr align="center">
                                <td colspan="6"><input type="submit" name="register" value="Update Your Account" /></td>
                            </tr>
					</table>
				</form>
            

<?php
    if(isset($_POST['register'])){
		$ip = getIp();
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
        
		move_uploaded_file($c_image_tmp,"customers/customer_images/$c_image");
		
        $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
        
        $run_c = mysqli_query($con, $insert_c); 
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con, $sel_cart); 
		$check_cart = mysqli_num_rows($run_cart); 
        if($check_cart==0){
            $_SESSION['customer_email']=$c_email; 
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('customers/my_account.php','_self')</script>";
        }else {
            $_SESSION['customer_email']=$c_email; 
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
		}
    }
?>
