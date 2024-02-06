
<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>0129- 12323-123123</span>
				</div>

				<!-- Languages -->
				<!-- <li class="commonSelect">
						<select class="form-control">
							<option>EN</option>
							<option>DE</option>
							<option>FR</option>
							<option>ES</option>
						</select>
					</li> -->

			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.html">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40" font-family="AustinBold, Austin" font-weight="bold">
								<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
									<text id="AVIATO">
										<tspan x="108.94" y="325">AVIATO</tspan>
									</text>
								</g>
							</g>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Cart -->
				<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide" style="position: relative;">
						<a href="index.php?action=giohang" class="dropdown-toggle"  data-hover="dropdown">
							<i class="tf-ion-android-cart" style="font-size: 22px; "></i>
							<span class="badge" style="font-size:12px; line-height: 12px; background-color: red; position: absolute; top: -49%; right: -10%;">
								<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
							</span>
						</a>

						<?php if (isset($_SESSION['cart']) ){ ?>
						<div class="dropdown-menu cart-dropdown"  style="min-width: 350px;">
						<?php foreach ($_SESSION['cart'] as $key => $item) : ?>
							<!-- Cart Item -->
							<div class="media">
								<a class="pull-left" href="#!">
								<img width="150px" src="Content/images/shop/products/<?php echo $item['hinh']; ?>" alt="imgProduct" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!"><?php echo $item['tenhh']; ?></a></h4>
									<div class="cart-price">
										<span><?php echo $item['soluong']; ?> x</span>
										<span><?php
											$hh = new hanghoa();
											$sp = $hh->getHangHoaId($item['mahh']);
											$giamgia = $sp['giamgia'];
											$dongiacu = $sp['dongia'];
											if ($giamgia) {
												echo '<font color="red"> ' . number_format($item["dongia"]) . '<sup><u>đ</u></sup></font>
												<strike> ' . number_format($dongiacu) . ' <sup><u>đ</u></sup></strike>';
											} else {
												echo '<font class="price">' . number_format($item['dongia']) . '<u><sup>đ</sup></u></font>';
											}; ?></span>
									</div>
									<h5><strong><?php echo number_format($item['thanhtien']); ?> <sup><u>đ</u></sup></strong></h5>
								</div>
								<a href="index.php?action=giohang&act=giohang_xoa&id=<?php echo $key; ?>" class="remove"><i class="tf-ion-close"></i></a>
							</div><!-- / Cart Item -->
							<?php endforeach; ?>
							

							<div class="cart-summary">
								<span>Tổng tiền:</span>
								<span class="total-price">
									<strong>
									<?php
									$gh = new giohang();
									$total = $gh->getSubTotal();
									echo "$total <sup><u>đ</u></sup>";
									?>
								</strong></span>
							</div>
							<ul class="text-center cart-buttons" >
								<li><a href="index.php?action=giohang" class="btn btn-small">View Cart</a></li>
								<li><a href="checkout.html" class="btn btn-small btn-solid-border">Checkout</a></li>
							</ul>
						</div>
						<?php 
						}else{
							echo '
							<div class="dropdown-menu cart-dropdown" style="min-width: 350px;">
								<div class="media-body">
								<div class="text-center" style="padding: 20px;">
								<img style="min-width: 50%;" src="Content/images/empty/emptyCart.png" alt="imgProduct" />
								<p style=" margin-top: 8px;">Chưa có sản phẩm</p>
								</div>
								</div>
							</div>';
						};?>
					
					</li><!-- / Cart -->

					<!-- Search -->
					<li class="dropdown search dropdown-slide" >
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong" style="font-size: 22px;"></i> Search</a>
						<ul class="dropdown-menu search-dropdown" style="min-width: 100%;">
							<li>
								<form method="post" action="index.php?action=sanpham&act=timkiem"><input type="search" name="txtsearch" class="form-control" placeholder="Search...">

								</form>
							</li>
						</ul>
					</li><!-- / Search -->

					
					<?php
					if (isset($_SESSION['makh'])) {
						echo '<li class="dropdown dropdown-slide" >
						<a href="#!" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" style="color:red; font-size:16px;"><i class="tf-ion-android-person"></i> ' . $_SESSION['tenkh'] . '</a>
						<ul class="dropdown-menu " style="min-width: 50%;">
							<li style="margin-top:12px;"><a href=""  >Tài khoản của tôi</a></li>
							<li style="margin-top:12px;"><a href="" >Đơn mua</a></li>
							<li style="margin:12px 0px;"><a href="index.php?action=dangnhap&act=dangxuat" >Đăng xuất <i class="tf-ion-log-out"></i></a></li>
						</ul> 
						</li>';
						// echo '<li><a href="index.php?act=userinfo" class="nav-link " style="color:red; font-size:16px"><i class="tf-ion-android-person"></i> ' . $_SESSION['tenkh'] . '</a></li>
						// <li><a href="index.php?action=dangnhap&act=dangxuat">Đăng xuất </a></li>';
					} else {
						echo '<li><a href="index.php?action=dangnhap" style="color:red; font-size:16px;" class="nav-link"><i class="tf-ion-log-in"></i> Đăng Nhập</a></li>';
					};?>
					
						<!-- <li>
							<a href="index.php?action=dangky" class="nav-link">Đăng Ký</a>
						</li> -->	
					
				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->

<!-- Main Menu Section -->
<section class="menu" >
	<nav class="navbar navigation" >
		<div class="container">
			<div class="navbar-header" >
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>
			<!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav" >
					<?php
					$menu = new menu();
					$result = $menu->getMenu();
					while ($menuItem = $result->fetch()) :
						// tao mot mang pages(luu tru duong dan) de thuc hien anh xa (mapping) voi $set['tenmenu]
						$pages = array(
							'1' => 'index.php?action=sale',
							'2' => 'index.php?action=shop',
							'3' => 'index.php?action=blog-left-sidebar',
							
						);

					?>
						<!-- Elements -->
						<li class="dropdown full-width dropdown-slide <?php echo ($menuItem['idmenu'] == 2) ? 'dropdown' : ''; ?>">
							<a href="<?php echo $pages[$menuItem['idmenu']]; ?>" style="font-size: 18px;" class="dropdown-toggle"  data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuItem['tenmenu']; ?> </a>
							<?php if ($menuItem['idmenu'] == 2) : ?>
								<div class="dropdown-menu">
									<div class="row">

										<!-- Basic Sub -->
										<div class="col-lg-6 col-md-6 mb-sm-3">
											<ul>
												<?php
												if (!empty($menuItem['idmenu'])) {
													$loai = new loaisanpham();
													$idcon = $loai->getLoaiSanPham($menuItem['idmenu']);
													while ($menuItem = $idcon->fetch()) {
														echo '<li class="dropdown-header"><a href="index.php?action=shop-sidebar&act=shop-sidebar&id=' . $menuItem['id_loai'] . '">' . $menuItem['tenloai'] . '</a></li>
															<li role="separator" class="divider"></li>';
													};
												}; ?>
											</ul>
										</div>

									</div><!-- / .row -->
								</div><!-- / .dropdown-menu -->
							<?php endif; ?>
						</li>
					<?php endwhile; ?>
					<!-- / Elements -->
				</ul><!-- / .nav .navbar-nav -->
			</div>
			<!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>

