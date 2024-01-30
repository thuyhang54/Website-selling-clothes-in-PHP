<?php
// $colorEmpty=$sizeEmpty="";
// $isDisabled = true;
// if(isset($_POST['submit'])){
// 	$chon_mau = $_POST["mymausac"];
// 	$chon_size = $_POST["mysize"];

// 	if(empty($chon_mau)){
// 		$colorEmpty ="Vui lòng chọn màu";
// 	};
// 	if(empty($chon_size)){
// 		$sizeEmpty ="Vui lòng chọn kích cỡ";
// 	};
// 	if (!empty($chon_mau) && !empty($chon_size)) {
// 		 $isDisabled = false;
// 		echo "<script>alert('Thêm vào giỏ hàng thành công');</script>";
//     }
// }
?>
<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li><a href="shop.html">Shop</a></li>
					<li class="active">Single Product</li>
				</ol>
			</div>
			<div class="col-md-6">
				<ol class="product-pagination text-right">
					<li><a href="blog-left-sidebar.html"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
					<li><a href="blog-left-sidebar.html">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
				</ol>
			</div>
		</div>
		<form id="form1" action="index.php?action=giohang&act=giohang_action" method="post"  onsubmit="return validateForm()">
			<div class="row mt-20">

				<div class="col-md-5">
					<div class="single-product-slider">
						<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
							<div class='carousel-outer'>
								<!-- me art lab slider -->

								<div class='carousel-inner '>
									<?php
									$id = isset($_GET['id']) ? $_GET['id'] : 0;
									$hh = new hanghoa();
									$sp = $hh->getHangHoaId($id);
									$tenhh = $sp['tenhh'];
									$mota = $sp['mota'];
									$dongia = $sp['dongia'];
									$giamgia = $sp['giamgia'];
									$soluongton = $sp['soluongton'];
									echo $soluongton;
									?>
									<?php
									$hinh = $hh->getHangHoaHinh($id);
									$active = true; // Đánh dấu hình đầu tiên là active
									while ($img = $hinh->fetch()) :
									?>
										<div class='item <?php echo $active ? 'active' : ''; ?>'>
											<img src='Content/images/shop/products/<?php echo $img['hinh']; ?>' alt='' data-zoom-image='Content/images/shop/products/<?php echo $img['hinh']; ?>' />
										</div>
									<?php
										$active = false; // Đánh dấu các hình sau là không active
									endwhile;
									?>
								</div>

								<!-- sag sol -->
								<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
									<i class="tf-ion-ios-arrow-left"></i>
								</a>
								<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
									<i class="tf-ion-ios-arrow-right"></i>
								</a>

							</div>

							<!-- thumb -->
							<ol class='carousel-indicators mCustomScrollbar meartlab' data-target='#carousel-custom'>
								<?php
								$hinh = $hh->getHangHoaHinh($id);
								$countImg = $hinh->rowCount();
								for ($i = 0; $i < $countImg; $i++) :
									$img = $hinh->fetch();
								?>
									<li data-target='#carousel-custom' data-slide-to='<?php echo $i; ?>' <?php echo $i == 0 ? 'class="active"' : ''; ?>>
										<img src='Content/images/shop/products/<?php echo $img['hinh']; ?>' alt='' />
									</li>
								<?php endfor; ?>
							</ol>
						</div>
					</div>
				</div>
				<div class="col-md-7">

					<input type="text" name="mahh" id="mahh" value="<?php echo $id; ?>">
					<div class="single-product-details">
						<h2><?php echo $tenhh; ?></h2>
						<div class="rating">
							<div class="pstar" data-prid="<?= $id ?>"></div>
							<?php
							// for ($i=1; $i <=5 ; $i++) { 
							// 	$img = $i <= $rating ? "star": "star-blank";
							// 	echo "<img src='Content/images/star/$img.png' alt='' style='width:20px; cursor:pointer;'data-set='$i' />" ;
							// }
							?>

						</div>
						<?php
						if ($giamgia) {
							echo '  <h5 class="my-4 font-weight-bold" style="color: red;">
							<font color="red">' . number_format($giamgia) . '<sup><u>đ</u></sup></font>
							<strike>' . number_format($dongia) . '<sup><u>đ</u></sup></strike>
							</h5>';
						} else {
							echo '<h3 class="price">' . number_format($dongia) . ' <u><sup>đ</sup></u></h3>';
						}
						?>
						<p>Kho: <?php echo $soluongton; ?></p>

						<p class="product-description mt-20">
							<?php echo $mota; ?>
						</p>
						<div class="color-swatches">
							<span>Màu sắc:</span>
							<input type="hidden" name="mymausac" id="mymausac" value="" />
							<small class="error-message" id="colorEmpty"></small>

							<?php
							$mau = $hh->getHangHoaMau($id);
							while ($set = $mau->fetch()) :
							?>
								<button type="button" name="" class="btn" style="margin-left: 12px;" value="<?php echo $set['Idmau']; ?>" onclick="chonMau(<?php echo $set['Idmau']; ?>)">
									<?php echo $set['mausac']; ?>
								</button>
							<?php endwhile; ?>

							<!-- <select name="mymausac" class="form-control" style="width:150px;">
                                <?php
								$mau = $hh->getHangHoaMau($id);
								while ($set = $mau->fetch()) :
								?>
                                <option value="<?php echo $set['Idmau']; ?>"><?php echo $set['mausac']; ?></option>
                                <?php endwhile; ?>
                            </select> -->

						</div>
						<div class="product-size">
							<input type="hidden" name="mysize" id="mysize" value="" />
							<small class="error-message" id="sizeEmpty"></small>

							<span>Kích cỡ:</span>
							<?php
							$size = $hh->getHangHoaSize($id);
							while ($set = $size->fetch()) :
							?>
								<button type="button" onclick="chonSize(<?php echo $set['Idsize']; ?>)" name="" class="btn" style="margin-left: 12px;" value="<?php echo $set['Idsize']; ?>"> <?php echo $set['size']; ?></button>
							<?php endwhile; ?>

						</div>
						<div class="product-quantity">
							<span>Số lượng:</span>
							<div class="product-quantity-slider">
								<input type="number" id="product-quantity" name="product-quantity" value="1" disabled>
							</div>
							<div id="message" style="display: none;">
								<p>Không đủ số lượng hàng. Chỉ còn <?php echo $soluongton; ?> sản phẩm.</p>
								<!-- <p id="remaining-stock-quantity"></p> -->
							</div>
						</div>
						<div class="product-category">
							<span>Categories:</span>
							<ul>
								<li><a href="product-single.html">Products</a></li>
								<li><a href="product-single.html">Soap</a></li>
							</ul>
						</div>

					</div>

				</div>
				<button type="submit" class="btn btn-main mt-20" id="addToCartBtn" disabled>Thêm vào giỏ hàng</button>
			</div>
		</form>
		<div class="alertPart">
    <div class="alert alert-success alert-common" role="alert" id="successAlert" style="display: none;" >
        <i class="tf-ion-thumbsup"></i><span>Chúc mừng!</span> Bạn đã thêm thành công vào giỏ hàng
    </div>
</div>
	</div>

	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="tabCommon mt-20">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
					<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews (3)</a></li>
				</ul>
				<div class="tab-content patternbg">
					<div id="details" class="tab-pane fade active in">
						<?php echo $mota; ?>
					</div>
					<div id="reviews" class="tab-pane fade">
						<div class="post-comments">
							<?php
							if (isset($_SESSION['makh'])) :
							?>
								<form action="index.php?action=binhluan" method="post">
									<div class="row">
										<input type="hidden" name="txtmahh" value="<?php echo $id; ?>" />
										<!-- <img src="./Content/imagetourdien/people.png" width="100px" height="100px" />-->
										<textarea class="input-field" type="text" name="comment" rows="2" cols="70" id="comment" placeholder="Thêm bình luận"></textarea>
										<input type="submit" name="submit" class="btn " id="submitButton" value="Bình Luận" />
									</div>
								</form>
							<?php endif; ?>
							<ul class="media-list comments-list m-bot-50 clearlist">
								<!-- Comment Item start-->
								<?php
								$bl = new binhluan();
								$noidung = $bl->showAllComment($id);
								while ($set = $noidung->fetch()) :
								?>
									<li class="media">

										<a class="pull-left" href="#!">
											<img class="media-object comment-avatar" src="Content/images/blog/OIP.jpg" alt="" width="50" height="50" />
										</a>

										<div class="media-body">
											<div class="comment-info">
												<h4 class="comment-author">
													<a href="#!"> <?php echo '<b>' . $set['username'] . '</b>'; ?></a>

												</h4>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#!"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												<?php echo  $set['content']; ?>
											</p>
										</div>

									</li>
								<?php endwhile; ?>
								<!-- End Comment Item -->

							</ul>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Sản phẩm tương tự</h2>
			</div>
		</div>
		<div class="row">
			<?php
			$iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$sptt = $hh->getHangHoaTuongTu($id, $iddm);
			while ($set = $sptt->fetch()) {
			?>
				<div class="col-md-3">
					<div class="product-item">
						<div class="product-thumb">
							<?php if ($set['giamgia']) {
								echo '<span class="bage">Sale</span>';
							} ?>
							<img class="img-responsive" src="Content/images/shop/products/<?php echo $set['hinh'] ?>" alt="product-img" />
							<div class="preview-meta">
								<ul>
									<li>
										<span data-toggle="modal" data-target="#product-modal-<?php echo $set['mahh']; ?>">
											<i class="tf-ion-ios-search"></i>
										</span>
									</li>
									<li>
										<a href="#"><i class="tf-ion-ios-heart"></i></a>
									</li>
									<li>
										<a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><i class="tf-ion-android-cart"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="product-content">
							<h4><a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><?php echo $set['tenhh']; ?></a></h4>
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
						</div>
					</div>
				</div>
			<?php
			};
			?>


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
								<!-- <a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>" class="btn btn-transparent">View Product Details</a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }; ?>
<!-- /.modal -->
<style>
	.selected {
		border: 2px solid #000;
	}
</style>
<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(){

	checkSoluong();
});

	function chonSize(a) {
		document.getElementById("mysize").value = a;
		// Thêm đường viền cho nút được nhấp
		var selectedButton = document.querySelector('.product-size .btn[value="' + a + '"]');
		selectedButton.classList.add('selected');
		document.querySelectorAll('.product-size .btn').forEach((button) => {
			if (button !== selectedButton) {
				button.classList.remove('selected');
			}
		});
		validateForm();

	}

	function chonMau(a) {
		document.getElementById("mymausac").value = a;
		var selectedButton = document.querySelector('.color-swatches .btn[value="' + a + '"]');
		selectedButton.classList.add('selected');
		// Xóa viền từ tất cả các nút (ngoại trừ nút đã chọn)
		document.querySelectorAll('.color-swatches .btn').forEach((button) => {
			if (button !== selectedButton) {
				button.classList.remove('selected');
			}
		});

		validateForm();
	}


	function validateForm() {
		
		var chonmau = document.getElementById("mymausac").value;
		var chonsize = document.getElementById("mysize").value;
		var addToCartBtn = document.getElementById("addToCartBtn");
		var soluong = document.getElementById("product-quantity");

		if (chonmau === "" || chonsize === "") {
			addToCartBtn.disabled = true;
			soluong.disabled = true;
			return false;
		}
		soluong.disabled = false;
		if(checkSoluong()){
			addToCartBtn.disabled = false;
		
			// showSuccessAlert();
		}else{
			addToCartBtn.disabled = false;
		}
		
		return true;
	}

	function checkSoluong() {
    var soluongInput = document.getElementById("product-quantity");
    var addToCartBtn = document.getElementById("addToCartBtn");
    var message = document.getElementById('message');
    var soluongconlai = document.getElementById('remaining-stock-quantity');
    var soluongton = <?php echo $soluongton; ?>;

		// Kiểm tra số lượng tồn kho trước khi kiểm tra số lượng mua
		if (soluongton === 0){
			addToCartBtn.disabled = true;
			addToCartBtn.innerHTML = 'Hết hàng'
			message.style.display = "block";
			message.innerHTML = 'Sản phẩm đã hết hàng';
			soluongInput.disabled = true;
			return;
		}

    soluongInput.addEventListener('change', function() {
		var soluongmua = parseInt(soluongInput.value);
        if (isNaN(soluongmua) || soluongmua <= 0) {
            soluongmua = 1;
            soluongInput.value = soluongmua;
        }

        if (soluongmua > soluongton) {
            addToCartBtn.disabled = true;
            message.style.display = 'block';
            // soluongconlai.innerHTML = soluongton;
        } else {
            addToCartBtn.disabled = false;
            message.style.display = 'none';
			message.innerHTML = '';
            // soluongconlai.innerHTML = '';
        }
    });
}
//  function showSuccessAlert(){
// 	var successAlert = document.getElementById('successAlert');
// 	successAlert.style.display = "block";
// 	setTimeout(function () {
// 		successAlert.style.display = "none";
// 	},3000);
//  }

</script>