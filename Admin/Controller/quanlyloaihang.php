<?php 
$act ="quanlyloaihang";
if(isset($_GET["act"])){
    $act = $_GET["act"];
}
switch ($act) {
    case 'quanlyloaihang':
        include './View/editloaisanpham.php';
        break;
    case 'insert_loaihangfile':
        include './View/addloaisanpham.php';
        break;
     case 'loai_action':
       
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $db = new connect();
                $file = $_FILES['file']['tmp_name'];
                file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
                $file_open = fopen($file, "r");
    
                while(($csv = fgetcsv($file_open, 1000, ";")) !== false) {
                    if(isset($csv[0]) && isset($csv[1]) && isset($csv[2])) {
                        $id_loai = $csv[0];
                        $tenloai = $csv[1];
                        $idmenu = $csv[2];
                        $status = $csv[3];
                        // $db = new connect();
                        $query = "INSERT INTO tb_loai(id_loai, tenloai, idmenu, status) VALUES ($id_loai, '$tenloai', $idmenu, $status)";
                        $db->exec($query);
                    } else {
                        echo "Dữ liệu CSV không đúng định dạng";
                    }
                }
                fclose($file_open);
                echo '<script>alert("Import dữ liệu thêm danh mục thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=quanlyloaihang"/>';
            }
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
            // $status = $_POST['status'];
            $loaihang = new loaisanpham();
            $check = $loaihang->updateLoaiHang($maloai,$tenloai, $idmenu);
            if($check !== false){
                echo '<script>alert("Cập nhật danh mục thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang"/>';
            }else{
                echo '<script>alert("Lỗi, Câp nhật danh mục")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaihang&act=insert_action"/>';
            }
        }
        break;
     case 'soft_delete_loaihang':
            $iddm = $_GET['iddm'];
            // Kiểm tra xem người dùng đã xác nhận xóa chưa
            if(isset($iddm)) {
                // Thực hiện cập nhật trong cơ sở dữ liệu
                $hh = new loaisanpham();
                $hh->softDeleteLoai($iddm);
                // Sau khi cập nhật, chuyển hướng người dùng trở lại trang danh sách
                header("Location: index.php?action=quanlyloaihang");
                exit();
            }
        break;
    
    }
?>