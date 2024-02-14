<?php

session_start(); // Bắt đầu phiên session
ob_start();
set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
include_once "Model/class.phpmailer.php";


 ?>