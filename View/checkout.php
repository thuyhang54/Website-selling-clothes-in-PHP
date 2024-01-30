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
                  <h4 class="widget-title">Billing Details</h4>
                  <?php
                  if (!isset($_SESSION['makh'])) :
                     echo '<script> alert("Bạn chưa đăng nhập"); </script>';
                     echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangnhap"/>';
                  ?>
                  <?php
                  else :
                  ?>

                     <form class="checkout-form" method="post">
                        <div class="form-group">
                           <?php

                           if (isset($_SESSION['masohd'])) {
                              // echo '<pre>';
                              // print_r($_SESSION);
                              // echo '</pre>';
                              $mshd = $_SESSION['masohd'] ;

                              $hd = new hoadon();
                              $thongtinkh = $hd->getThongTinKhachHang($mshd);
                              $ngay = $thongtinkh['ngaydat'];
                              $tenkh = $thongtinkh['tenkh'];
                              $dc = $thongtinkh['diachi'];
                              $sdt = $thongtinkh['sodienthoai'];

                           ?>
                              <label for="full_name">Mã số hóa đơn:</label>
                              <input type="text" class="form-control" id="maso_hoadon" placeholder="" value="<?php echo $mshd; ?>">
                        </div>
                        <div class="form-group">
                           <label for="full_name">Ngày lập:</label>
                           <input type="text" class="form-control" id="full_name" placeholder="" value="<?php echo $ngay; ?>">
                        </div>
                        <div class="form-group">
                           <label for="full_name">Họ và tên:</label>
                           <input type="text" class="form-control" id="full_name" placeholder="" value="<?php echo $tenkh; ?>">
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
                              $sp = $hd->getThongTinHHID($mshd);
                              // echo $sp;
                              while ($setsp = $sp->fetch()) :
                     ?>
                        <div class="media product-card">
                           <a class="pull-left" href="product-single.html">
                              <img class="media-object" src="Content/images/shop/products/<?php echo $setsp['hinh']; ?>" alt="Image" />
                           </a>
                           <div class="media-body">
                              <h4 class="media-heading"><a href="product-single.html"><?php echo $setsp['tenhh'] ?></a></h4>
                              <p>Phân loại: <?php echo $setsp['mausac']; ?> - <?php echo $setsp['size'] ?></p>
                              <p class="price"><?php echo $setsp['soluongmua']; ?> x <?php echo $setsp['giamgia'] ? $setsp['giamgia'] : $setsp['dongia']; ?><sup><u>đ</u></sup></p>
                              <span class="remove">Remove</span>
                           </div>
                        </div>
                      
                        <div class="discount-code">
                           <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
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
                        <?php endwhile; ?>
                     <div class="summary-total">
                        <span>Tổng tiền:</span>
                        <span>
                        <?php
                              $gh = new giohang();
                              $total = $gh->getSubTotal();
                              echo "$total <sup><u>đ</u></sup>";
                           };
                        ?>
                        </span>
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
</div>
<?php
   unset($_SESSION['cart']);
 endif;

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