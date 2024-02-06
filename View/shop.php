

<!-- Category -->
<!-- <section class="product-category section">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Danh mục sản phẩm</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box">
					<a href="">
						<img src="Content/images/shop/category/category-1.jpg" alt="" />
						<div class="content">
							<h3>Clothes Sales</h3>
							<p>Shop New Season Clothing</p>
						</div>
					</a>	
				</div>
				<div class="category-box">
					<a href="">
						<img src="Content/images/shop/category/category-2.jpg" alt="" />
						<div class="content">
							<h3>Smart Casuals</h3>
							<p>Get Wide Range Selection</p>
						</div>
					</a>	
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box category-box-2">
					<a href="#!">
						<img src="Content/images/shop/category/category-3.jpg" alt="" />
						<div class="content">
							<h3>Jewellery</h3>
							<p>Special Design Comes First</p>
						</div>
					</a>	
				</div>
			</div>
		</div>
	</div>
</section> -->
<div class="row">
<div class="col-md-3">
			<div class=" widget">

				<div id="categoryForm">
					<?php

					$loai = new loaisanpham();
					$dsLoai = $loai->getAllCategories();
					while ($row = $dsLoai->fetch()) {
					?>
						<div class="form-check">
							<a href="index.php?action=shop-sidebar&act=shop-sidebar&id=<?php echo  $row['id_loai'] ?>" class="category-link" data-category-id="<?php echo $row['id_loai']; ?>">
								<?php echo $row['tenloai']; ?>
							</a>
						</div>
					<?php }; ?>
				</div>


			</div>
</div>
<!-- Products -->
<section class="products section bg-gray">
	<div class="container-fluid">
		<div class="row">
			<div class="title text-center">
				<h2>Sản phẩm mới nhất</h2>
			</div>
			
		</div>
		<div class="row">
		<div class="col-md-6">
				<div class="category-box">
					<a href="index.php?action=sanpham">
						<img src="Content/images/shop/category/category-1.jpg" alt="" />
						<div class="content">
							<h3>Xu hướng thời trang</h3>
							<p>Cập nhật liên tục áo quần trendy</p>
						</div>
					</a>	
				</div>
			</div>
			
			<?php $hh = new hanghoa();
			$result = $hh->getHangHoaNew();
			while ($set = $result->fetch()) {
			?>
				<div class="col-md-3 ">
					<div class="product-item">
						<div class="product-thumb">
							<img class="img-responsive" src="Content/images/shop/products/<?php echo $set['hinh']; ?>" alt="product-img" />
							<div class="preview-meta">
								<ul>
									<li>
										<span data-toggle="modal" data-target="#product-modal-<?php echo $set['mahh']; ?>">
											<i class="tf-ion-ios-search-strong"></i>
										</span>
									</li>
									<li>
										<a href="#!"><i class="tf-ion-ios-heart"><?php echo $set['soluotxem']; ?></i></a>
									</li>
									<li>

										<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><i class="tf-ion-android-cart"></i></a>

									</li>
								</ul>
							</div>
						</div>
						<div class="product-content">
							<h4><a href="index.php?action=sanpham&act=sanphamchitiet&id=<?php echo $set['mahh']; ?> ">
									<?php echo $set['tenhh'] . " - " . $set['mausac']; ?></a></h4>
							<p class="price"><?php echo number_format($set['dongia']); ?> <u><sup>đ</sup></u></p>
						</div>
					</div>
				</div>
			<?php }; ?>
			<div class="row text-center ">
				<div class="col-md-12">
					<button class="btn">
						<a href="index.php?action=sanpham">Xem thêm</a>
					</button>
				</div>
			</div>
		</div>
</section>

<section class="product-category section">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="category-box">
					<a href="index.php?action=sale">
						<img src="Content/images/shop/category/category-1.webp" alt="" />
						<!-- <div class="content">
							<h3>Clothes Sales</h3>
							<p>Shop New Season Clothing</p>
						</div> -->
					</a>	
				</div>
				
			</div>
		</div>
	</div>
</section>

<section class="products section bg-gray">
	<div class="container-fluid">
		<div class="row">
			<div class="title text-center">
				<h2>Sản phẩm ưu đãi</h2>
			</div>
		</div>
		<div class="row">
			<?php $hh = new hanghoa();
			$result = $hh->getHangHoaSale();
			while ($set = $result->fetch()) {
			?>
				<div class="col-md-4">
					<div class="product-item">
						<div class="product-thumb">
							<span class="bage">Sale</span>
							<img class="img-responsive" src="Content/images/shop/products/<?php echo $set['hinh']; ?>" alt="product-img" />
							<div class="preview-meta">
								<ul>
									<li>
										<span data-toggle="modal" data-target="#product-modal-<?php echo $set['mahh']; ?>">
											<i class="tf-ion-ios-search-strong"></i>
										</span>
									</li>
									<li>
										<a href="#!"><i class="tf-ion-ios-heart"><?php echo $set['soluotxem']; ?></i></a>
									</li>
									<li>
										<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><i class="tf-ion-android-cart"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="product-content">
							<h4><a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><?php echo $set['tenhh'] . " - " . $set['mausac']; ?></a></h4>
							<h5 class="my-4 font-weight-bold" style="color: red;">
								<font color="red"><?php echo number_format($set['giamgia']); ?><sup><u>đ</u></sup></font>
								<strike><?php echo number_format($set['dongia']); ?><sup><u>đ</u></sup></strike>
							</h5>
						</div>
					</div>
				</div>
			<?php }; ?>
			<div class="row text-center ">
				<div class="col-md-12">
					<button class="btn">
						<a href="index.php?action=sanpham&act=sanphamkhuyenmai">Xem thêm</a>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<?php

$hh = new hanghoa();
$result = $hh->getHangHoaAll();
while ($set = $result->fetch()) {

?>
	<div class="modal product-modal fade" id="product-modal-<?php echo $set['mahh']; ?>">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i class="tf-ion-close"></i>
		</button>
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8 col-sm-6 col-xs-12">
							<div class="modal-image">
								<img class="img-responsive" src="<?php echo 'Content/images/shop/products/' . $set['hinh']; ?>" alt="product-img" />
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="product-short-details">
								<h2 class="product-title"><?php echo $set['tenhh']; ?></h2>
								<?php
								if ($set['giamgia']) {
									echo '	<h5 class="my-4 font-weight-bold" style="color: red;">
										<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
										<strike> ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
									</h5>';
								} else {
									echo '<p class="product-price">' . number_format($set['dongia']) . '<u><sup>đ</sup></u>';
								}
								?>
								<p class="product-short-description">
									<?php echo $set['mota']; ?>
								</p>
								<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>" class="btn btn-main">Xem chi tiết</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }; ?>
<!-- /.modal -->
	<!--
Start Call To Action
==================================== -->
<?php if (!isset($_SESSION['makh'])) : ?>
<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>Đăng ký nhận thông báo mới nhất từ AVIATO</h2>
					<p>Cập nhật nhanh nhất các chương trình ưu đãi và thông tin sản phẩm mới </p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
				    <div class="input-group subscription-form">
				      <!-- <input type="text" class="form-control" placeholder="Nhập vào địa chỉ email của"> -->
				      <span class="input-group-btn">
				        <a href="index.php?action=dangky" class="btn btn-main" >Đăng ký ngay!</a>
				      </span>
				    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->

			</div>
		</div> 		<!-- End row -->
	</div>   	<!-- End container -->
</section>   <!-- End section -->
<?php endif ?>



