<?php 
 if (isset($_POST['insertproduct'])){
    // lấy dữ liệu về
    $name = $_POST['name'];
    $price = $_POST['price'];
    $iddm = $_POST['id_loai'];
    $img = $_FILES['image']['name']; // name để lấy ra tên file
    // insert into 

    // sau đó chuyển về trang danh sác sản phẩm
   include '../Admin/View/products.php';

 }
include '../Admin/View/edithanghoa.php' ;
?>