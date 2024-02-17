<?php
// if (!isset($_SESSION['makh'])) {
//    echo '<script> alert("Bạn chưa đăng nhập"); </script>';
//    echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangnhap"/>';
?>
<section class="page-header">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="content">
               <h1 class="page-name">Checkout</h1>
               <ol class="breadcrumb">
                  <li><a href="index.html">Home</a></li>
                  <li class="active">checkout</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="block billing-details">
                  <h4 class="widget-title">Địa chỉ nhận hàng</h4>

                  <?php
                  //   if (isset($_SESSION['makh'])) {
                  ?>
                  <?php
                  if (isset($_GET['masohd'])) {
                     $masohd = $_GET['masohd'];
                     $hd = new hoadon();
                     $thongtinkh = $hd->getThongTinKhachHang($masohd);
                     $ngay = $thongtinkh['ngaydat'];
                     $tenkh = $thongtinkh['tenkh'];
                     $dc = $thongtinkh['diachi'];
                     $sdt = $thongtinkh['sodienthoai'];

                  ?>
                     <form class="checkout-form" method="post">
                        <div class="form-group">

                           <label for="full_name">Mã số hóa đơn:</label>
                           <input type="text" class="form-control" id="maso_hoadon" placeholder="" value="<?php echo $masohd; ?>">
                        </div>
                        <div class="form-group">
                           <label for="full_name">Họ và tên:</label>
                           <input type="text" class="form-control" id="full_name" placeholder="" value="<?php echo $tenkh; ?>">
                        </div>
                        <div class="form-group">
                           <label for="full_name">Ngày lập:</label>
                           <input type="text" class="form-control" id="full_name" placeholder="" value="<?php echo $ngay; ?>">
                        </div>
                        <div class="form-group">
                           <label for="user_address">Địa chỉ</label>
                           <input type="text" class="form-control" id="user_address" placeholder="" value="<?php echo $dc; ?>">
                        </div>
                        <!-- <div class="checkout-country-code clearfix">
                        <div class="form-group">
                           <label for="user_post_code">Zip Code</label>
                           <input type="text" class="form-control" id="user_post_code" name="zipcode" value="">
                        </div>
                        <div class="form-group" >
                           <label for="user_city">City</label>
                           <input type="text" class="form-control" id="user_city" name="city" value="">
                        </div>
                     </div> -->
                        <div class="form-group">
                           <label for="user_phone">Số điện thoại:</label>
                           <input type="text" class="form-control" id="user_phone" placeholder="" value="<?php echo $sdt; ?>">
                        </div>

                     </form>
               </div>
               <!-- <div class="block">
                     <h4 class="widget-title">Payment Method</h4>
                     <p>Credit Cart Details (Secure payment)</p>
                     <div class="checkout-product-details">
                        <div class="payment">
                           <div class="card-details">
                              <form class="checkout-form">
                                 <div class="form-group">
                                    <label for="card-number">Card Number <span class="required">*</span></label>
                                    <input id="card-number" class="form-control" type="tel" placeholder="•••• •••• •••• ••••">
                                 </div>
                                 <div class="form-group half-width padding-right">
                                    <label for="card-expiry">Expiry (MM/YY) <span class="required">*</span></label>
                                    <input id="card-expiry" class="form-control" type="tel" placeholder="MM / YY">
                                 </div>
                                 <div class="form-group half-width padding-left">
                                    <label for="card-cvc">Card Code <span class="required">*</span></label>
                                    <input id="card-cvc" class="form-control" type="tel" maxlength="4" placeholder="CVC">
                                 </div>
                                 <a href="confirmation.html" class="btn btn-main mt-20">Place Order</a>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div> -->
            </div>
            <div class="col-md-4">

               <div class="product-checkout-details">
                  <div class="block">
                     <h4 class="widget-title">Chi tiết hóa đơn</h4>
                     <?php
                     $sp = $hd->getTTHD($masohd);
                     // echo $sp;
                     while ($setsp = $sp->fetch()) :
                     ?>
                        <div class="media product-card">
                           <a class="pull-left" href="product-single.html">
                              <img class="media-object" src="Content/images/shop/products/<?php echo $setsp['hinh']; ?>" alt="Image" />
                           </a>
                           <div class="media-body">
                              <h4 class="media-heading"><a href="product-single.html"><?php echo $setsp['tenhh'] ?></a></h4>
                              <p> Phân loại:
                              <?php
                              $hh = new hanghoa();
                              $availableColors = $hh->getHangHoaMau($setsp['mahh']);
                              while ($color = $availableColors->fetch()) {
                                 if ($setsp['idcolors'] == $color['Idmau'])
                                    echo '<label for="">' . $color['mausac'] . '</label>';
                                 // echo $color['Idmau'];
                              }
                              ?>-
                              <?php
                              $hh = new hanghoa();
                              $availableSizes = $hh->getHangHoaSize($setsp['mahh']);
                              while ($size = $availableSizes->fetch()) {
                                 if ($setsp['idsizes'] == $size['Idsize'])
                                    echo '<label for="">' . $size['size'] . '</label>';
                                 
                              }; ?>
                                 </p>
                              <p class="price"><?php echo $setsp['soluongmua']; ?> x <?php echo $setsp['giamgia'] ? $setsp['giamgia'] : $setsp['dongia']; ?><sup><u>đ</u></sup></p>
                           </div>
                        </div>
                        <ul class="summary-prices">
                           <li>
                              <span>Subtotal:</span>
                              <span class="price"><?php echo $setsp['thanhtien']; ?><sup><u>đ</u></sup></span>
                           </li>
                           <li>
                              <span>Shipping:</span>
                              <span>Free</span>
                           </li>
                        </ul>
                        
                     <div class="summary-total">
                        <span>Tổng tiền:</span>
                        <span class="price"><?php echo $setsp['tongtien']; ?><sup><u>đ</u></sup></span>
                        <?php endwhile; ?>
                        <?php };?>
                       
                     </div>
                     <div class="verified-icon">
                        <img src="images/shop/verified.png">
                     </div>
                     <!-- <a href="index.php?action=thanhtoan" class="btn btn-main pull-right">Thanh toán</a> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
   // unset($_SESSION['cart']);
   // };

   ?>
   <!-- Modal -->
   <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <input class="form-control" type="text" placeholder="Enter Coupon Code">
                  </div>
                  <button type="submit" class="btn btn-main">Apply Coupon</button>
               </form>
            </div>
         </div>
      </div>
   </div>