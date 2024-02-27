<?php 
if(isset($_SESSION['makh'])){
 
    $makh = $_SESSION['makh'];
    $masp = $_POST['txtmahh'];
    $star_rating = $_POST['star_rating_value'];
    $content = $_POST['comment'];
    
    // Đặt múi giờ cho Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Lấy ngày và giờ hiện tại
    $ngayGio = date('Y-m-d H:i:s');
    // tiến hành insert vào db
    $bl = new binhluan();
    $bl->insertBinhLuan($makh,$masp,$content,$ngayGio,$luotthich=0,$star_rating);
}
$hh = new hanghoa;
$id_loai= $hh->getHangHoaId($masp);
$iddm = $id_loai['id_loai'] ;
// echo $iddm;
echo '<meta http-equiv="refresh" content="0;url=index.php?action=sanpham&act=sanphamchitiet&iddm='.$iddm.'&id='.$masp.'"/>';


?>