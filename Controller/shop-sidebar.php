<?php 
$act = isset($_GET['act']) ? $_GET['act'] : 'shop-sidebar';
switch ($act) {
    case 'shop-sidebar': include_once './View/shop-sidebar.php'; break;
    case 'sanphamkhuyenmai': include_once "./View/shop-sidebar.php"; break;
    case 'sanphamchitiet': include_once "./View/product-single.php"; break;  
}
?>