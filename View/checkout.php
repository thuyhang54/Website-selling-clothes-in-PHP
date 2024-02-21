<?php
if (!isset($_SESSION['makh'])) {
   echo '<script> alert("Bạn chưa đăng nhập"); </script>';
   echo '<meta http-equiv="refresh" content="0;url=index.php?action=dangnhap"/>';
} else if (isset($_SESSION['makh']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
   $idkh = $_SESSION['makh'];
   $kh = new user();
   $thongtinkh = $kh->getThongTinUser($idkh);
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
                     <h4 class="widget-title">Thông tin khách hàng</h4>
                     <form class="checkout-form" method="post">
                        <div class="form-group">
                           <label for="full_name">Họ và tên:</label>
                           <input type="text" class="form-control" id="full_name" placeholder="" value="<?php echo $thongtinkh['tenkh'] ?>">
                        </div>
                        <div class="form-group">
                           <label for="email">Email:</label>
                           <input type="email" class="form-control" id="email" placeholder="" value="<?php echo $thongtinkh['email']; ?>">
                        </div>
                        <div class="form-group">
                           <label for="user_address">Địa chỉ</label>
                           <input type="text" class="form-control" id="user_address" placeholder="" value="<?php echo $thongtinkh['diachi']; ?>">
                        </div>
                        <div class="form-group">
                           <label for="user_phone">Số điện thoại:</label>
                           <input type="text" class="form-control" id="user_phone" placeholder="" value="<?php echo $thongtinkh['sodienthoai']; ?>">
                        </div>

                     </form>
                  </div>
                  <div class="block">
                     <h4 class="widget-title">Phương thức thanh toán</h4>
                     <p>Credit Cart Details (Secure payment)</p>
                     <div class="checkout-product-details">
                        <div class="payment">
                           <div class="card-details">
                              <form class="checkout-form" method="POST" action="index.php?action=online-checkout" onsubmit="return confirm('Xác nhân đặt hàng')">
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
                                 <!-- <button type="submit" name="cod">Thanh toán COD</button> -->
                                 <button type="submit" name="payUrl">Thanh toán MoMo</button>
                                 <button type="submit" name="redirect">Thanh toán VNpay</button>
                                 <a href="index.php?action=thanhtoan" class="btn btn-main mt-20">Đặt hàng</a>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">

                  <div class="product-checkout-details">
                     <div class="block">
                        <h4 class="widget-title">Chi tiết hóa đơn</h4>
                        <?php
                        foreach ($_SESSION['cart'] as $key => $item) :
                        ?>
                           <div class="media product-card">
                              <a class="pull-left" href="product-single.html">
                                 <img class="media-object" src="Content/images/shop/products/<?php echo $item['hinh']; ?>" alt="ImageProduct" />
                              </a>
                              <div class="media-body">
                                 <h4 class="media-heading"><a href="product-single.html"><?php echo $item['tenhh'] ?></a></h4>
                                 <p> Phân loại: </p>
                                 <?php
                                 $hh = new hanghoa();
                                 $availableColors = $hh->getHangHoaMau($item['mahh']);
                                 while ($color = $availableColors->fetch()) {
                                    if ($item['mausac'] == $color['Idmau'])
                                       echo '<label for="">' . $color['mausac'] . '</label>';
                                 }
                                 ?>-
                                 <?php
                                 $hh = new hanghoa();
                                 $availableSizes = $hh->getHangHoaSize($item['mahh']);
                                 while ($size = $availableSizes->fetch()) {
                                    if ($item['size'] == $size['Idsize'])
                                       echo '<label for="">' . $size['size'] . '</label>';
                                 }; ?>
                                 <!-- <p>Phân loại: <?php echo $setsp['idmau']; ?> - <?php echo $setsp['idsize'] ?></p> -->
                                 <p class="price"><?php echo $item['soluong']; ?> x <?php echo $item['giamgia'] ? $item['giamgia'] : $item['dongia']; ?><sup><u>đ</u></sup></p>
                                 <span class="remove">Remove</span>
                              </div>
                           </div>

                           <div class="discount-code">
                              <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                           </div>
                           <ul class="summary-prices">
                              <li>
                                 <span>Subtotal:</span>
                                 <span class="price"><?php echo number_format($item['thanhtien']); ?><sup><u>đ</u></sup></span>
                              </li>
                              <li>
                                 <span>Shipping:</span>
                                 <span>Free</span>
                              </li>
                           </ul>
                        <?php endforeach; ?>
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