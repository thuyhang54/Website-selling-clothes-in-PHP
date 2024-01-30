
<?php
$act = "dangky";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'dangky':
        include_once "./View/signin.php";
        break;
    case 'dangky_action':
        $tenkh = $diachi = $sodt = $user = $email = $pass = '';
        if (isset($_POST['submit'])) {
            $tenkh = $_POST['txttenkh'];
            $diachi = $_POST['txtdiachi'];
            $sodt = $_POST['txtsodt'];
            $user = $_POST['txtusername'];
            $email = $_POST['txtemail'];
            $pass = $_POST['txtpass'];
            // mã hoas pass
            $saltF = "G234#!";
            $saltL = "Ta78@#";
            $passnew = md5($saltF . $pass . $saltL);
            $kh = new user();
            $checkUserNanme = $kh->checkKhachHangUser($user)->rowCount();
            $checkEmail = $kh->checkKhachHangEmail($email)->rowCount();
            if ($checkUserNanme || $checkEmail) {
                if($checkUserNanme>=1){
                    echo '<script>alert("Tên người dùng đã tồn tại, Vui lòng nhập lại tên người dùng khác!");</script>';
                   include_once "./View/signin.php";
                }elseif($checkEmail>=1){
                    echo '<script>alert("Email đã tồn tại, Vui lòng nhập email khác!");</script>';
                    echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangky"/>';
                }
               
            } else {
                // insert vào db
                $iskh = $kh->insertKhachHang($tenkh, $user, $passnew, $email, $diachi, $sodt);
                if ($iskh !== false) {
                    echo '<script>alert("Chúc mừng bạn đã đăng ký thành công!");</script>';
                    include_once "./View/home.php";
                } else {
                    echo '<script>alert("Đăng ký không thành công, có lỗi xảy ra");</script>';
                    echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangky"/>';
                }
            }
        }
        break;
}
?>
