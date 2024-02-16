
<?php
 if (isset($_POST['submit'])){
    // lay du lieu ve
    $mahh = $_POST['mahh'];
    $tenhh = $_POST['tenhh'];
    $dongia = $_POST['dongia'];
    $giamgia = $_POST['giamgia'];
    $hinh = $_FILES['image']['name'];// name để lấy ra tên file
    $mausac = $_POST['mausac'];
    $size = $_POST['size'];
    $iddm = $_POST['id_loai'];
   //  $slx = $_POST['slx'];
   //  $ngaylap = $_POST['ngaylap'];
   //  $mota = $_POST['mota'];
    $slt = $_POST['slt'];

   // Gọi hàm insert_hanghoa để chèn dữ liệu vào các bảng
   // insert_hanghoa($tenhh, $dongia, $giamgia, $hinh, $mausac, $size, $iddm);

    // sau đó chuyển về trang danh sác sản phẩm
    include '../Admin/View/products.php';

   }
   
  include '../Admin/View/edithanghoa.php' ;
 ?>