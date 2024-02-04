<?php

session_start(); // Bắt đầu phiên session
ob_start();
set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
include_once "Model/class.phpmailer.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Aviato | E-commerce template</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="aviato" />
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="Content/images/favicon.png" />
  
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="Content/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="Content/plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- Animate css -->
  <link rel="stylesheet" href="Content/plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="Content/plugins/slick/slick.css">
  <link rel="stylesheet" href="Content/plugins/slick/slick-theme.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="Content/css/style.css">
  
  <!-- <link rel="stylesheet" href="Content/plugins/toast/toastMess.css"> -->


  

</head>

<body id="body">

    <?php include_once 'View/header.php'; ?>
  
  
        <?php
        $ctrl ="home";
        if(isset($_GET['action'])){
            $ctrl=$_GET['action'];
        }
        require_once("Controller/$ctrl.php");
		?>
		
    <?php  include_once 'View/footer.php';?>
  </body>
      <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="Content/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="Content/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="Content/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Instagram Feed Js -->
    <script src="Content/plugins/instafeed/instafeed.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="Content/plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="Content/plugins/syo-timer/build/jquery.syotimer.min.js"></script>

    <!-- slick Carousel -->
    <script src="Content/plugins/slick/slick.min.js"></script>
    <script src="Content/plugins/slick/slick-animation.min.js"></script>

    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="Content/plugins/google-map/gmap.js"></script>

    <!-- Main Js File -->
    <script src="Content/js/script.js"></script>

    <!-- toastJS -->
    <script src="Content/plugins/toast/toastMess.js"></script>
  </html>
