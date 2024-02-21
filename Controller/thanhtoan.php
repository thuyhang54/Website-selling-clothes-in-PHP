<?php 

if(isset($_SESSION['makh'])){
    $makh =$_SESSION['makh'];
    $hd = new hoadon();
    $sohd = $hd->insertHoaDon($makh); 
    // lưu số hóa đơn vào session
    $_SESSION['masohd']=$sohd;
    $total=0;
    // có được mshd thì insert vào chitiethoadon 
    // chi tiết hóa đơn ? lấy thông tin từ giỏ hàng
    foreach ($_SESSION['cart'] as $key => $item){
        $hd->insertCTHoaDon($sohd,$item['mahh'],$item['soluong'],$item['mausac'],$item['size'],$item['thanhtien']);
        $total += $item['thanhtien'];
        // cap nhat so luong ton
        $hd->updatesoluongton($item['mahh'], $item['mausac'],$item['size'], $item['soluong']);
      
    }
    $hd->updateHoaDonTongTien($sohd,$makh,$total);
    include "./View/confirmation.php";
    unset($_SESSION['cart']);
}
// 

// include_once "./View/checkout.php";
// include_once "./View/orderSuccess.php";


?>