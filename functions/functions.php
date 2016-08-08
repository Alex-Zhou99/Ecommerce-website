<?php
$con = mysqli_connect("localhost","root","","ecommerce");
//getting the catgories
function getCats(){
    global $con;
    $get_cats = "select * from categories";
    $run_cats = mysqli_query($con, $get_cats);
    while($row_cats = mysqli_fetch_array($run_cats)){
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='#'>$cat_title</a></li>";
    } 
}
function getBrands(){
    global $con;
    $get_brands = "select * from brands";
    $run_brands = mysqli_query($con, $get_brands);
    while($row_brands = mysqli_fetch_array($run_brands)){
        $brands_id = $row_brands['brands_id'];
        $brands_title = $row_brands['brands_title'];
        echo "<li><a href='#'>$brands_title</a></li>";
    } 
}

?>