<?php
// function lấy và trả về dữ liệu JSON
function execPostRequest($url, $data)
{
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      array(
         'Content-Type: application/json',
         'Content-Length: ' . strlen($data)
      )
   );
   curl_setopt($ch, CURLOPT_TIMEOUT, 5);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
   //execute post
   $result = curl_exec($ch);
   //close connection
   curl_close($ch);
   return $result;
}
// url tạo giao dịch test thử của momo


if (isset($_POST['cod'])) {
   echo 'cod';
   // $cod=$_POST["cod"];

} elseif (isset($_POST['payUrl'])) {
   $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create"; // momo sẽ cung cấp URL real để sd thanh toán real
   $partnerCode = 'MOMOBKUN20180529'; // momo sẽ cung cấp code real để sd thanh toán real
   $accessKey = 'klm05TvNBzhg7h7j';  //momo sẽ cung cấp URL real để sd thanh toán real
   $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; // momo sẽ cung cấp URL real để sd thanh toán real

   $orderInfo = "Thanh toán qua MoMo";
   $amount = "10000";
   $orderId = rand(00, 9999); // idOder random
   $redirectUrl = "http://localhost:8080/PHP2/MyProject-update/index.php?action=confirmation"; //  kết quả trả về sau khi thanh toán thành công
   $ipnUrl = "http://localhost:8080/PHP2/MyProject-update/index.php?action=confirmation"; //  trang truy vấn kết quả
   $extraData = ""; // mã bưu điện, bưu chính, địa chỉ customer


   // if (!empty($_POST)) {
   $partnerCode = $partnerCode;
   $accessKey = $accessKey;
   $serectkey = $secretKey;
   $orderId = $orderId; // Mã đơn hàng
   $orderInfo = $orderInfo;
   $amount = $amount;
   $ipnUrl = $ipnUrl;
   $redirectUrl = $redirectUrl;
   $extraData = $extraData;

   $requestId = time() . "";
   $requestType = "payWithATM";
   // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
   //before sign HMAC SHA256 signature
   $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
   $signature = hash_hmac("sha256", $rawHash, $serectkey);
   $data = array(
      'partnerCode' => $partnerCode,
      'partnerName' => "Test",
      "storeId" => "MomoTestStore",
      'requestId' => $requestId,
      'amount' => $amount,
      'orderId' => $orderId,
      'orderInfo' => $orderInfo,
      'redirectUrl' => $redirectUrl,
      'ipnUrl' => $ipnUrl,
      'lang' => 'vi',
      'extraData' => $extraData,
      'requestType' => $requestType,
      'signature' => $signature
   );
   $result = execPostRequest($endpoint, json_encode($data));
   $jsonResult = json_decode($result, true);  // decode json

   //Just a example, please check more in there

   header('Location: ' . $jsonResult['payUrl']);
   // }

} elseif (isset($_POST['vnpay'])) {

   $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
   $vnp_Returnurl = "http://localhost:8080/PHP2/MyProject-update/index.php?action=confirmation"; // trả về thông tin để lưu csdl
   $vnp_TmnCode = "GNZYV9VI"; //Mã website tại VNPAY 
   $vnp_HashSecret = "IKHWHGPCSNHFBCGSEWZLGGICLXNIYPBU"; //Chuỗi bí mật

   $vnp_TxnRef = rand(00,9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
   $vnp_OrderInfo = 'noi dung thanh toan';
   $vnp_OrderType = 'billpayment';
   $vnp_Amount = 50000 * 100;
   $vnp_Locale = 'vn';
   $vnp_BankCode ='NCB';
   $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // 127.0.0.1
   //Add Params of 2.0.1 Version
   // $vnp_ExpireDate = $_POST['txtexpire'];
   //Billing
   // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
   // $vnp_Bill_Email = $_POST['txt_billing_email'];
   // $fullName = trim($_POST['txt_billing_fullname']);
   // if (isset($fullName) && trim($fullName) != '') {
   //    $name = explode(' ', $fullName);
   //    $vnp_Bill_FirstName = array_shift($name);
   //    $vnp_Bill_LastName = array_pop($name);
   // }
   // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
   // $vnp_Bill_City = $_POST['txt_bill_city'];
   // $vnp_Bill_Country = $_POST['txt_bill_country'];
   // $vnp_Bill_State = $_POST['txt_bill_state'];
   // // Invoice
   // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
   // $vnp_Inv_Email = $_POST['txt_inv_email'];
   // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
   // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
   // $vnp_Inv_Company = $_POST['txt_inv_company'];
   // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
   // $vnp_Inv_Type = $_POST['cbo_inv_type'];
   $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef
      // "vnp_ExpireDate" => $vnp_ExpireDate
      // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
      // "vnp_Bill_Email" => $vnp_Bill_Email,
      // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
      // "vnp_Bill_LastName" => $vnp_Bill_LastName,
      // "vnp_Bill_Address" => $vnp_Bill_Address,
      // "vnp_Bill_City" => $vnp_Bill_City,
      // "vnp_Bill_Country" => $vnp_Bill_Country,
      // "vnp_Inv_Phone" => $vnp_Inv_Phone,
      // "vnp_Inv_Email" => $vnp_Inv_Email,
      // "vnp_Inv_Customer" => $vnp_Inv_Customer,
      // "vnp_Inv_Address" => $vnp_Inv_Address,
      // "vnp_Inv_Company" => $vnp_Inv_Company,
      // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
      // "vnp_Inv_Type" => $vnp_Inv_Type
   );

   if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
   }
   // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
   //    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
   // }

   //var_dump($inputData);
   ksort($inputData);
   $query = "";
   $i = 0;
   $hashdata = "";
   foreach ($inputData as $key => $value) {
      if ($i == 1) {
         $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
         $hashdata .= urlencode($key) . "=" . urlencode($value);
         $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
   }

   $vnp_Url = $vnp_Url . "?" . $query;
   if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
   }
   $returnData = array(
      'code' => '00', 'message' => 'success', 'data' => $vnp_Url
   );
   if (isset($_POST['redirect'])) {
      header('Location: ' . $vnp_Url);
      die();
   } else {
      echo json_encode($returnData);
   }
   // vui lòng tham khảo thêm tại code demo
}
