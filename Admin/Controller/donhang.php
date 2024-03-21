<?php


$act = "donhang";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'donhang':
        include_once "./View/donhang.php";
        break;

    case 'update_donhang':
        include_once "./View/editdonhang.php";
        break;
    case 'update_action':
        if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
            $mahd = $_POST['id'];
            $ttrang = $_POST['tinhtrang'];
            // đem dữ liệu này lưu vào database
            $hh = new donhang();
            // $check=$hh->insertHangHoa($tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota);
            $check = $hh->updatedonhang($mahd, $ttrang);
            if ($check !== false) {
                echo '<script>alert("Update dữ liệu thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=donhang"/>';
            } else {
                echo '<script>alert("Update dữ liệu ko thành công");</script>';
                include_once "./View/editdonhang.php";
            }
        }
        break;
}