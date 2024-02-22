<?php 
try {
if(isset($_SESSION['makh'])){
    $makh =$_SESSION['makh'];
    $hd = new hoadon();
    $sohd = $hd->insertHoaDon($makh);
      // lưu số hóa đơn vào session
      $_SESSION['masohd']=$sohd;
      $total = 0; 
if(isset($_GET['vnp_Amount'])){
    $data_vnpay = [
        'vnp_Amount' => $_GET['vnp_Amount'],
        'vnp_BankCode' => $_GET['vnp_BankCode'],
        'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
        'vnp_CardType' => $_GET['vnp_CardType'],
        'vnp_OrderInfo' => $_GET['vnp_OrderInfo'],
        'vnp_PayDate' => $_GET['vnp_PayDate'],
        'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
        'vnp_TmnCode' => $_GET['vnp_TmnCode'],
        'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
        'vnp_TxnRef' => $_GET['vnp_TxnRef'],
        'vnp_SecureHash' => $_GET['vnp_SecureHash']

    ];
    // lưu data vào vnpay
    // $hd = new hoadon();
   $hd->insertVNPay($data_vnpay); 
   foreach ($_SESSION['cart'] as $key => $item){
    $hd->insertCTHoaDon($sohd,$item['mahh'],$item['soluong'],$item['mausac'],$item['size'],$item['thanhtien']);
    $total += $item['thanhtien'];
   $hd->updatesoluongton($item['mahh'], $item['mausac'],$item['size'], $item['soluong']);
   }
   $hd->updateHoaDonTongTien($sohd,$makh,$total);
   unset($_SESSION['cart']);
}
}
include './View/confirmation.php';
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
 ?>