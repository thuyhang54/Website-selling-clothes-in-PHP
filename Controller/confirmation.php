<?php 
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
    $hd = new hoadon();
   $hd->insertVNPay($data_vnpay); 
   foreach ($_SESSION['cart'] as $key => $item){
   $hd->updatesoluongton($item['mahh'], $item['mausac'],$item['size'], $item['soluong']);
   }
}
include './View/confirmation.php';
 ?>