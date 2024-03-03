<?php 
$act ="quanlyloaihang";
if(isset($_GET["act"])){
    $act = $_GET["act"];
}
switch ($act) {
    case 'quanlyloaihang':
        include './View/editloaisanpham.php';
        break;
    case 'insert_loaihang':
        include './View/addloaisanpham.php';
        break;
    case 'insert_action':
        if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
            $maloai = $_POST['id'];
            $tenloai = $_POST['namecata'];
            $idmenu = $_POST['menu'];
            $status = $_POST['status'];
            $loaihang = new loaisanpham();
            $check = $loaihang->insertLoaiHang($tenloai, $idmenu ,$status);
            if($check !== false){
                echo '<script>alert("Thêm danh mục thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang"/>';
            }else{
                echo '<script>alert("Lỗi, Thêm danh mục")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang&act=insert_action"/>';
            }
        }
        break;
    case 'update_loaihang':
        include './View/addloaisanpham.php';
        break;
    case 'update_action':
        if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
            $maloai = $_POST['id'];
            $tenloai = $_POST['namecata'];
            $idmenu = $_POST['menu'];
            $status = $_POST['status'];
            $loaihang = new loaisanpham();
            $check = $loaihang->updateLoaiHang($maloai,$tenloai, $idmenu ,$status);
            if($check !== false){
                echo '<script>alert("Cập nhật danh mục thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang"/>';
            }else{
                echo '<script>alert("Lỗi, Câp nhật danh mục")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang&act=insert_action"/>';
            }
        }
        break;
    }
?>