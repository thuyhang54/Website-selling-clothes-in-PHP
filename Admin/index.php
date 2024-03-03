<?php
session_start(); // Bắt đầu phiên session
// ob_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./layout/assets/css/main.css">
    <script src="https://kit.fontawesome.com/8c204d0fdf.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>


<body>
<!-- Thanh header tao menu -->
<?php
//  if(isset($_SESSION['admin'])){
//     include "View/headder.php";
//  }

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

</html>