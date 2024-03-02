<?php
$act = "dangnhap";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'dangnhap':
        include_once './View/dangnhap.php';
        break;
    case 'dangnhap_action':
        //nhận về, kiểm tra
        // c1:  if(isset($_POST['txtusername']) && isset($_POST['txtpassword']))
        //  c2: if(isset($_POST['login']) )
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $_POST['txtusername'];
            $pass = $_POST['txtpassword'];
            //đem thông tin này kiểm tra có hay không
            $nv = new nhanvien();
            $check = $nv->getAdmin($user,$pass);
            if($check !== false){
                $_SESSION['admin'] = $check['username'];
                echo '<script>alert("Đăng nhập thành công")</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=hanghoa"/>';
                
            }else{
                echo '<script>alert("Đăng nhập không thành công")</script>';
                include_once './View/dangnhap.php';
            }
        }
        break;
        case 'dangxuat':
            unset($_SESSION['admin']);
            unset($_SESSION['username']);
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangnhap"/>';
        break;
}
