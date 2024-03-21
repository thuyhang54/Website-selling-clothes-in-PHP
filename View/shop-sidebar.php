<?php
$iddm = "";
// Kiểm tra xem có tham số id_loai trong URL không
if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
	$iddm = $_GET['iddm'];
	// echo $iddm;

}
?>
<!-- PHÂN TRANG -->
<?php
$hh = new hanghoa();
$count = $hh->getAllHHByDM($iddm)->rowCount();
$limit = 4;
$page = new page();
$totalPages = $page->findPage($count, $limit);
$start = $page->findStart($limit);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
echo  " chỉ số bắt đầu: $start" ;
echo " tổng số trang: $totalPages";
echo " trang hiện tại: $current_page";
?>

<?php
// $ac = isset($_GET['act']) && $_GET['act'] == 'sanphamkhuyenmai' ? 2 : 1;
// switch ($ac) {
// 	case 1:
// 		$pageTitle = 'Shop';
// 		break;
// 	case 2:
// 		$pageTitle = 'Sale Products';
// 		break;
// }
?>


<!-- <section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php echo $pageTitle; ?></h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active"><?php echo strtolower($pageTitle); ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section> -->


<section class="products section">
	<div class="container-fluid">
		<div class="col-md-3">
			<div class="widget">
				<h4 class="widget-title">Danh mục</h4>
				<div id="categoryForm">
					<?php

					$loai = new loaisanpham();
					$dsLoai = $loai->getAllCategories();
					while ($row = $dsLoai->fetch()) {
					?>
						<div class="form-check">
							<a href="index.php?action=shop-sidebar&iddm=<?php echo  $row['id_loai'] ?>" class="category-link" data-category-id="<?php echo $row['id_loai']; ?>">
								<?php echo $row['tenloai']; ?>
							</a>
						</div>
					<?php }; ?>
				</div>


			</div>
			<div class="widget product-category">
				<h4 class="widget-title">Categories</h4>
				<div class="panel-group commonAccordion" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Shoes
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Shoe Color</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Duty Wear
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Shoe Color</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									WorkOut Shoes
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">
								<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Gladian Shoes</a></li>
									<li><a href="#!">Swis Shoes</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="col-md-9">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title text-center">
							<!-- <h2>Mới</h2> -->
						</div>
					</div>
				</div>

				<div class="row">
					<?php $hh = new hanghoa();
					
						$result = $hh->getHangHoaTheoDanhMuc($iddm, $start, $limit);
					
					while ($set = $result->fetch()) {
					?>
						<div class="col-md-4">
							<div class="product-item">
								<div class="product-thumb">
								<?php if ($set['giamgia'] > 0) {echo '<span class="bage">Sale</span>';}?>
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
									<h4><a href="product-single.html"><?php echo $set['tenhh']  ?></a></h4>
									<?php
									if ($set['giamgia'] > 0) {
										echo '  <h5 class="my-4 font-weight-bold" style="color: red;">
										<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
										<strike>' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
										</h5>';
										
									}else{
										echo '<p class="price">' . number_format($set['dongia']) . ' <u><sup>đ</sup></u></p>';
									}

									?>

								</div>
							</div>


						</div>
					<?php }; ?>
				</div>
			</div>

		<!-- HIỂN THỊ SỐ TRANG (Pagination) -->
<div class="text-center">
    <ul class="pagination post-pagination">
        <?php
        $baseUrl = "index.php?action=shop-sidebar&iddm={$iddm}";

        if ($current_page > 1  && $totalPages > 1) {
            echo '<li><a href="' . $baseUrl . '&page=' . ($current_page - 1) . '">Prev</a></li>';
        }

        for ($i = 1; $i <= $totalPages ; $i++) {
            echo '<li ' . ($i == $current_page ? 'class="active"' : '') . '><a href="' . $baseUrl . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($current_page < $totalPages && $totalPages > 1 ) {
            echo '<li><a href="' . $baseUrl . '&page=' . ($current_page + 1) . '">Next</a></li>';
        }
        ?>
    </ul>
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