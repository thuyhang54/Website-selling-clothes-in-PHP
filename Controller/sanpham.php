<?php

$act = 'sanpham';
if(isset($_GET['act'])){
    $act = $_GET['act'];
}
switch($act){
    case 'sanpham': include_once "./View/sanpham.php"; break;
    case 'sanphamkhuyenmai': include_once "./View/sanpham.php"; break;
    case 'sanphamchitiet': include_once "./View/product-single.php"; break;
    case 'timkiem': include_once "./View/sanpham.php"; break;
}
 ?>