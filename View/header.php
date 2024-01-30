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
						<a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
							<i class="tf-ion-android-cart" style="font-size: 22px; "></i>
							<span class="badge" style="font-size:12px; line-height: 12px; background-color: red; position: absolute; top: -39%; left: 27%;">
							<?php echo count($_SESSION['cart']); ?></span>Cart
						</a>
						<div class="dropdown-menu cart-dropdown">
							<!-- Cart Item -->
							<div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="Content/images/shop/cart/cart-1.jpg" alt="image" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!">Ladies Bag</a></h4>
									<div class="cart-price">
										<span>1 x</span>
										<span>1250.00</span>
									</div>
									<h5><strong>$1200</strong></h5>
								</div>
								<a href="#!" class="remove"><i class="tf-ion-close"></i></a>
							</div><!-- / Cart Item -->
							<!-- Cart Item -->
							<!-- <div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="Content/images/shop/cart/cart-2.jpg" alt="image" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!">Ladies Bag</a></h4>
									<div class="cart-price">
										<span>1 x</span>
										<span>1250.00</span>
									</div>
									<h5><strong>$1200</strong></h5>
								</div>
								<a href="#!" class="remove"><i class="tf-ion-close"></i></a>
							</div> -->
							<!-- / Cart Item -->

							<!-- <div class="cart-summary">
								<span>Total</span>
								<span class="total-price">$1799.00</span>
							</div> -->
							<ul class="text-center cart-buttons">
								<li><a href="index.php?action=giohang" class="btn btn-small">View Cart</a></li>
								<li><a href="checkout.html" class="btn btn-small btn-solid-border">Checkout</a></li>
							</ul>
						</div>

					</li><!-- / Cart -->

					<!-- Search -->
					<li class="dropdown search dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong" style="font-size: 22px;"></i> Search</a>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<form method="post" action="index.php?action=sanpham&act=timkiem"><input type="search" name="txtsearch" class="form-control" placeholder="Search...">

								</form>
							</li>
						</ul>
					</li><!-- / Search -->

					<?php
					if (isset($_SESSION['makh']) && $_SESSION['makh'] != "") {
						echo '<li><a href="index.php?act=userinfo" class="nav-link " style="color:red; font-size:25px">' . $_SESSION['tenkh'] . '</a></li>
						<li><a href="index.php?action=dangnhap&act=dangxuat">Đăng xuất</a></li>
						';
					} else {
					?>

						<li>
							<a href="index.php?action=dangky" class="nav-link">Đăng Ký</a>
						</li>
						<li>
							<a href="index.php?action=dangnhap" class="nav-link">Đăng Nhập</a>
						</li>
					<?php } ?>

				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->

<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav">
					<?php
					$menu = new menu();
					$result = $menu->getMenu();
					while ($menuItem = $result->fetch()) :
						// tao mot mang pages(luu tru duong dan) de thuc hien anh xa (mapping) voi $set['tenmenu]
						$pages = array(
							'Trang Chủ' => 'index.php',
							'Cửa Hàng' => 'index.php?action=shop-sidebar',
							'Blog' => 'index.php?action=blog-left-sidebar',
							'Giới Thiệu' => 'index.php?action=about',
							'Liên Hệ' => 'index.php?action=contact'
						);

					?>
						<!-- Elements -->
						<li class="dropdown full-width dropdown-slide <?php echo ($menuItem['idmenu'] == 2) ? 'dropdown' : ''; ?>">
							<a href="<?php echo $pages[$menuItem['tenmenu']]; ?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuItem['tenmenu']; ?> <span class=""></span></a>
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

