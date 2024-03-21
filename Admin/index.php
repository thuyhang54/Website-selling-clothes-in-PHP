<?php
session_start(); // Bắt đầu phiên session
ob_start();

// unset($_SESSION['admin']);
set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

 ?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- link đăng nhập -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- link đăng nhập -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- end -->
    <!-- <link rel="stylesheet" href="./layout/assets/css/main.css"> -->
    <script src="https://kit.fontawesome.com/8c204d0fdf.js" crossorigin="anonymous"></script>
    
    <!-- <link href="./Content/css/style.css" rel="stylesheet"> -->
    <title>Document</title>
</head>


<body>
<!-- Thanh header tao menu -->
<?php
 if(isset($_SESSION['admin'])){
    include "View/headder.php";
   
 }

 ?>
       
        <?php
            //load controler
            $ctrl="dangnhap";
            if(isset($_GET['action']))
                $ctrl=$_GET['action'];
            include './Controller/'.$ctrl.'.php';
        //end controller   
        ?>
   
    <!-- footer -->
    <?php 
    if(isset($_SESSION['admin'])){
        include "View/footer.php" ;
    }
    ?>
    <!-- end footer -->
   
</body>
  <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./Content/vendor/global/global.min.js"></script>
    <script src="./Content/js/quixnav-init.js"></script>
    <script src="./Content/js/custom.min.js"></script>

</html>