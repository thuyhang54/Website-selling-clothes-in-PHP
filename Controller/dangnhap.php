
<?php 
$act = "dangnhap";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'dangnhap':
        include_once "./View/login.php";
        break;
    case 'dangnhap_action':
         $user = $pass = "";
         if (isset($_POST['txtusername']) && isset($_POST['txtpass'])) {
            $user = $_POST['txtusername'];
            $pass = $_POST['txtpass'];
             // mã hoas pass
             $saltF = "G234#!";
             $saltL = "Ta78@#";
             $passnew = md5($saltF . $pass . $saltL);
             $kh = new user();
             $logkh = $kh->checkUser($user, $passnew);// tra ve array
             if ($logkh) {
                // Đăng nhập thành công, thiết lập session
                $_SESSION['makh'] = $logkh['makh'];
                $_SESSION['tenkh'] = $logkh['tenkh'];
              
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=giohang"/>';
                // echo '<script> showSuccessToast(); </script>';
            } else {
                // echo '<script>alert("Tài khoản hoặc mật khẩu sai");</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=home"/>';
                // echo '<script>showWarningToast();</script>';
            }

        }
        break;
        case 'dangxuat':
            unset($_SESSION['makh']);
            unset($_SESSION['tenkh']);
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=home"/>';
        break;

}
?>
<script>
  
</script>