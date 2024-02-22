<?php
    $act="forget";
    if(isset($_GET['act']))
    {
        $act=$_GET['act'];
    }
    switch ($act) {
        case 'forget':
            include_once "./View/forget-password.php";
            break;
        
        case 'forget_action':
            // nhận email về
            if(isset($_POST['submit_email']))
            {
                $email=$_POST['email'];//huynhhoang2024@gmail.com
                $_SESSION['email']=array();
                // kiểm tra xem email này có tồn tại hay không
                $kh=new user();
                $checkemail=$kh->checkEmail($email)->rowCount();
                if($checkemail>0)
                {
                    // tạo code cấp cho email
                    $code=random_int(10000,100000);
                    // tạo đối tượng
                    $item=array(
                        'id'=>$code,
                        'email'=>$email,
                    );
                    // add vào session
                    $_SESSION['email'][]=$item;
                    // tiến hàng gửi mail
                    $mail = new PHPMailer();
                    $mail->CharSet =  "utf-8";
                    $mail->IsSMTP();
                    // enable SMTP authentication
                    $mail->SMTPAuth = true;                  
                    // GMAIL username to:
                    // $mail->Username = "php22023@gmail.com";//
                    $mail->Username = "thuyhang8563@gmail.com";//
                    // GMAIL password
                    // $mail->Password = "php22023ngoc";
                    $mail->Password = "jszb akhw gvbk afir";//Phplytest20@php
                    $mail->SMTPSecure = "tls";  // ssl
                    // sets GMAIL as the SMTP server
                    $mail->Host = "smtp.gmail.com";
                    // set the SMTP port for the GMAIL server
                    $mail->Port = "587";// 465
                    $mail->From='thuyhang8563@gmail.com'; /// địa chỉ email của tổ chức/ cty
                    $mail->FromName='MyCompany';
                    // $getemail là địa chỉ mail mà người nhập vào địa chỉ của họ đã đăng ký trong trang web
                    $mail->AddAddress($email, 'reciever_name');
                    $mail->Subject  =  'Reset Password';
                    $mail->IsHTML(true);
                    $mail->Body    = 'Cấp lại mã code '.$code.'';
                    if($mail->Send())
                    {
                        echo '<script> alert("Check Your Email and Click on the 
                        link sent to your email");</script>';
                        include "./View/resetpw.php";
                    }
                    else
                    {
                        echo "Mail Error - >".$mail->ErrorInfo;
                        include "./View/forget-password.php";
                    }
                    // include "./View/resetpw.php";
                }
                else
                {
                    echo '<script> alert("Địa chỉ email không tồn tại. Vui lòng nhập lại địa chỉ email");</script>';
                    include "./View/forget-password.php";
                }
                
            }
            break;
            ///$_SESSION['email]=array('id':59829,email:huynhhoang2024@gmail.com)
            // 59829
            case 'resetpass': 
                //nhận pass mới mà người dùng nhập vào
                if(isset($_POST['submit_password'])){
                    $pass = $_POST['password'];
                    // echo $pass;
                    foreach ($_SESSION['email'] as $key => $item){
                        if ($item['id']==$pass){
                            // tiến hàng update
                            $saltF = "G234#!";
                            $saltL = "Ta78@#";
                            $passnew = md5($saltF . $pass . $saltL);
                            $emailold = $item['email'];
                            $kh = new user();
                            $kh->updatePassEmail($emailold,$passnew);
                        }
                    }
                }
                echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangnhap"/>';
                break;
        }
?>