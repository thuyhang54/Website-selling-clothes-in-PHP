
<?php
 if (isset($_POST['submit'])){
    // lay du lieu ve
    $mahh = $_POST['mahh'];
    $tenhh = $_POST['tenhh'];
    $dongia = $_POST['dongia'];
    $giamgia = $_POST['giamgia'];
    $hinh = $_FILES['image'];
    $mausac = $_POST['mausac'];
    $size = $_POST['size'];
    $maloai = $_POST['maloai'];
    // insert into
    // tro ve trang san pham
    include_once './View/hanghoa.php';
 }
 include_once './View/edithanghoa.php';?>