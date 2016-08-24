<!DOCTYPE>
<?php
include("includes/db.php");
?>
<html>
    <head>
        <title>Inserting Product</title>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </head>
    <body bgcolor="skyblue">
        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            <table align="center" width="795" border="2" bgcolor="#187eae">
                <tr align="center"><!--colspan属性规定单元格可横跨的列数。b规定粗体文本-->
                    <td colspan="7"><h2>Insert New Post Here</h2></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="60" required="required" /></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="product_cat" required="required">
                            <option>Select a Category</option>
                            <?php
                                global $con;
                                $get_cats = "select * from categories";
                                $run_cats = mysqli_query($con, $get_cats);
                                while($row_cats = mysqli_fetch_array($run_cats)){
                                    $cat_id = $row_cats['cat_id'];
                                    $cat_title = $row_cats['cat_title'];
                                    echo "<option value='$cat_id'>$cat_title</option>";
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Brand:</b></td>
                    <td>
                        <select name="product_brand" required="required">
                            <option>Select a Brand</option>
                            <?php
                                $get_brand = "select * from brands";
                                $run_brand = mysqli_query($con, $get_brand);
                                while($row_brand = mysqli_fetch_array($run_brand)){
                                    $brand_id = $row_brand['brand_id'];
                                    $brand_title = $row_brand['brand_title'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Image:</b></td>
                    <td><input type="file" name="product_image" /></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="product_price" required="required"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="10" required="required"></textarea></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Keywords:</b></td>
                    <td><input type="text" name="product_keywords" size="50" required="required"/></td>
                </tr>
                <tr align="center">
                    <td colspan="7"><input type="submit" name="insert_post" value="Insert Now"/></td>
                </tr>
            </table>
        </form>
    
    
    </body>
    
</html>
<?php
    if(isset($_POST['insert_post'])){
        //getting the text data from the fields
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        
        //getting the image from the field
		$product_image = $_FILES["product_image"]["name"];
		$product_image_tmp = $_FILES["product_image"]["tmp_name"];
        $filepath ="product_images/".$product_image;
		
		move_uploaded_file($product_image_tmp,$filepath);
        
        $insert_product = "insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
        
        $insert_pro = mysqli_query($con, $insert_product);
        if($insert_pro){
            echo "<script>alert('product has been inserted')</script>";
            echo "<script>window.open('index.php?insert_product','_self')</script>";
        }
    }
?>