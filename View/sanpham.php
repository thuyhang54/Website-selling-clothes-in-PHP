<!-- PHÂN TRANG -->
<?php
$hh = new hanghoa();
$count = $hh->getHangHoaAll()->rowCount();
$limit = 6;
$page = new page();
$totalPages = $page->findPage($count, $limit);
$start = $page->findStart($limit); 
$current_page = isset($_GET['page'])? (int)$_GET['page']:1;
echo  " chỉ số bắt đầu: $start" ;
echo "tổng số trang: $totalPages";
echo " trang hiện tại: $current_page";
?>
<!-- /PHÂN TRANG -->
<?php
$ac = 1;
if (isset($_GET['action'])) {
	// echo "hello";
	if (isset($_GET['act']) && $_GET['act'] == 'sanphamkhuyenmai') {
		$ac = 2;
	}else if(isset($_GET['act']) && $_GET['act'] == 'sanphamnoibat'){
		$ac= 4;
	}else if(isset($_GET['act']) && $_GET['act']=='timkiem'){
		$ac =3;
	}
	 else {
		$ac = 1;
	}
}
?>
<?php
// $id_loai="";
// // Kiểm tra xem có tham số id_loai trong URL không
// if (isset($_GET['id']) && ($_GET['id'] > 0)) {
// 	$id_loai = $_GET['id'];
// 	//echo $id_loai;
// }
?>

<section class="products section bg-gray">
<div class="container-fluid">
	<div class="row">
		<div class="title text-center">
			<?php
			if ($ac == 1) {

				echo '<h2>Tất cả sản phẩm</h2>';
			}
			if ($ac == 2) {
				echo '<h2>Tất cả sản phẩm ưu đãi</h2>';
			}
			if($ac == 3){
				echo '<h2>Sản phẩm tìm kiếm</h2>';
			}
			if($ac == 4) {
				echo '<h2> Sản phẩm nổi bật</h2>';
			}
			?>

		</div>
	</div>
	<div class="row">
		<?php $hh = new hanghoa();

		if ($ac == 1) {
			// Nếu không có id_loai thì lấy tất cả sản phẩm
			$result =  $hh->getHangHoaAllPage($start, $limit);
			// $result = $hh->getHangHoaAllPage($start,$limit);
		}
		if ($ac==2) {

			$result =  $hh->getHangHoaAllSalePage($start, $limit);
		}
		if($ac==3){
			if(isset($_POST['txtsearch'])){
				$tk=$_POST['txtsearch'];
				$result=$hh->searchProduct($tk,$start,$limit);
			}
		}
		if($ac ==4){
			$result = $hh->getHangHoaAllNoiBat($start,$limit);
		}
		// else{
		// 	$result = $hh->getHangHoaTheoDanhMuc($id_loai,$start, $limit);	
		// }
		while ($set = $result->fetch()) {
		?>
			<div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<?php if ($ac==2 ||( $ac==4 && $set['giamgia']>0)) {echo '<span class="bage">Sale</span>';}?>
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
									<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai'];?>&id=<?php echo $set['mahh']; ?>"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai'];?>&id=<?php echo $set['mahh']; ?>">
						<?php 
						if($ac == 4){
							echo $set['tenhh'] .  "<p> lượt mua: "  . $set['soluotmua']. " </p>"; 
						}else{
							echo $set['tenhh'] . " - " . $set['mausac'];
						}; ?></a></h4>
						<?php
						if ($ac == 1) {
							echo '<p class="price">' . number_format($set['dongia']) . ' <u><sup>đ</sup></u></p>';
						} else if ($ac == 2) {
							echo '  <h5 class="my-4 font-weight-bold" style="color: red;">
							<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
							<strike>' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
							</h5>';
						}else if ($ac == 4 && $set['giamgia']>0){
							echo '<h5 class="my-4 font-weight-bold" style="color: red;">
							<font color="red">'.number_format($set['giamgia']).'<sup><u>đ</u></sup></font>
							<strike>'.number_format($set['dongia']).'<sup><u>đ</u></sup></strike>
								</h5>';
						   }else{
							   echo '<p class="price">'.number_format($set['dongia']).' <u><sup>đ</sup></u></p>';
						   };?>

					</div>
				</div>
			</div>
		<?php }; ?>
	</div>
	<?php
	if ($ac==1 || $ac==2 || $ac==4):
	 ?>
		<!-- HIỂN THỊ SỐ TRANG (Pagination) -->
	<div class="text-center">
			<ul class="pagination post-pagination">
				<?php
				$baseUrl = "index.php?action=";
				if ($ac == 1) {
					$baseUrl .= "sanpham&act=sanpham";
				} elseif ($ac == 2) {
					$baseUrl .= "sanpham&act=sanphamkhuyenmai";
				}elseif($ac==4){
					$baseUrl .= "sanpham&act=sanphamnoibat";
				}else {
					$baseUrl .= "sanpham";
				}
				if($current_page >1 && $totalPages >1){
					echo '<li><a href="'.$baseUrl.'&page='.($current_page-1).'">Prev</a></li>';
				}
				for ($i=1; $i <= $totalPages; $i++) { 
					echo '<li ' .($i == $current_page ? 'class="active"': ''). '><a href="'.$baseUrl.'&page='.$i.'">'.$i.'</a></li>';
				}
				if ($current_page < $totalPages && $totalPages > 1) {
					echo '<li><a href="'.$baseUrl.'&page=' . ($current_page + 1) . '">Next</a></li>';
				}
				?>
			</ul>
		</div>
		<?php endif; ?>
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
										<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai'];?>&id=<?php echo $set['mahh']; ?>" class="btn btn-main">Xem chi tiết</a>
										<!-- <a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai'];?>&id=<?php echo $set['mahh']; ?>" class="btn btn-transparent">View Product Details</a> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }; ?>
		<!-- /.modal -->
	