<?php
$act = "hanghoa";
if (isset($_GET["act"])) {
    $act = $_GET["act"];
}
switch ($act) {
    case 'hanghoa':
        include_once "./View/hanghoa.php";
        break;
    case 'insert_hanghoa':
        include_once "./View/edithanghoa.php";
        break;
    case 'insert_action':
        // nhận thông tin
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $mahh = $_POST['mahh'];
            $tenhh = $_POST['tenhh'];
            $maloai = $_POST['id_loai'];
            $dacbiet = $_POST['dacbiet'];
            $slx = $_POST['slx'];
            $ngaylap = $_POST['ngaylap'];
            $mota = $_POST['mota'];
            // đem dl lưu vào db
            $hh = new hanghoa();
            $check = $hh->insertHangHoa($tenhh, $maloai, $dacbiet, $slx, $ngaylap, $mota);
            if ($check !== false) {
                echo '<script>alert("Thêm hàng hóa thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=hanghoa"/>';
            } else {
                echo '<script>alert("Lỗi, Thêm hàng hóa ")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=hanghoa&act=insert_action"/>';
            }
        }
        break;
    case 'update_hanghoa':
        include_once "./View/edithanghoa.php";
        break;
    case 'update_action':
          // nhận thông tin
          if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $mahh = $_POST['mahh'];
            $tenhh = $_POST['tenhh'];
            $maloai = $_POST['id_loai'];
            $dacbiet = $_POST['dacbiet'];
            $slx = $_POST['slx'];
            $ngaylap = $_POST['ngaylap'];
            $mota = $_POST['mota'];
            // đem dl lưu vào db
            $hh = new hanghoa();
           $check =$hh->updateHangHoa($mahh,$tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota);
            if ($check !== false) {
                echo '<script>alert("Cập nhật hàng hóa thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=hanghoa"/>';
            } else {
                echo '<script>alert("Lỗi, Cập nhật hàng hóa")</script>';
            }
        }
        break;

}
?>
