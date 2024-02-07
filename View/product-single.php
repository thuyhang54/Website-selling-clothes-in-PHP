<!-- PHÂN TRANG -->
<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$hh = new binhluan();
$count = $hh->CountAllComment($id);
$limit = 3;
$page = new page();
$totalPages = $page->findPage($count, $limit);
$startPage = $page->findStart($limit);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<!-- /PHÂN TRANG -->
<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php?action=home">Trang chủ</a></li>
					<li><a href="index.php?action=shop">Nữ</a></li>
					<li class="active">Chi tiết</li>
				</ol>
			</div>
			<div class="col-md-6">
				<ol class="product-pagination text-right">
					<li><a href="blog-left-sidebar.html"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
					<li><a href="blog-left-sidebar.html">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
				</ol>
			</div>
		</div>
		<form id="form1" action="index.php?action=giohang&act=giohang_action" method="post" onsubmit="return validateForm()">
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
									$soluongton = $sp['tongsoluongton'];
									// echo $soluongton;
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
						<div class="" style="display:inline-flex;">
						<div class="rating">
							<div class="pstar" data-prid="<?= $id ?>"></div>
							<?php
							$rating ='';
							for ($i=1; $i <=5 ; $i++) { 
								$img = $i <= $rating ? "star": "star-blank";
								echo "<img src='Content/images/star/$img.png' alt='' style='width:20px; cursor:pointer;'data-set='$i' />" ;
							}
							?>

						</div>
							<?php
							$bl = new binhluan();
							$countComment = $bl->CountAllComment($id);
							echo '<p style="border-left: 1px solid #dedede; margin-left:12px; padding:0 12px; height:100%;><a data-toggle="tab" href="#reviews" aria-expanded="false">' . $countComment . '</a> Đánh giá</p>';
							?>
							<?php
							$bl = new hanghoa();
							$sumSold = $bl->tongLuotMua($id);
							echo '<p style="border-left: 1px solid #dedede; margin-left:12px; padding:0 12px; height:100%; "><a data-toggle="tab" href="#reviews" aria-expanded="false">' . $sumSold . '</a> Đã Bán</p>';
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
						<!-- Hiển thị số lượng tồn -->
						<p>Kho: <?php echo isset($soluongton) ? $soluongton : 0 ?></p>
						<p class="product-description mt-20">
							<?php echo $mota; ?>
						</p>
						<div class="product-category">
							<span>Vận chuyển:</span>
							<ul>
								<li><a href="product-single.html">Products</a></li>
								<li><a href="product-single.html">Soap</a></li>
							</ul>
						</div>
						<div class="color-swatches">
							<span>Màu sắc:</span>
							<input type="text" name="mymausac" id="mymausac" value="" />
							<small class="error-message" id="colorEmpty"></small>

							<?php
							$mau = $hh->getHangHoaMau($id);
							while ($set = $mau->fetch()) :
							?>
								<button type="button" name="" class="btn" style="margin-left: 12px;" value="<?php echo $set['Idmau']; ?>" onclick="chonMau(<?php echo $set['Idmau']; ?>)">
									<?php echo $set['mausac']; ?>
								</button>
							<?php endwhile; ?>



						</div>
						<div class="product-size">
							<input type="text" name="mysize" id="mysize" value="" />
							<small class="error-message" id="sizeEmpty"></small>

							<span>Size:</span>
							<?php
							$size = $hh->getHangHoaSize($id);
							while ($set = $size->fetch()) :
							?>
								<button type="button" onclick="chonSize(<?php echo $set['Idsize']; ?>)" name="" class="btn" style="margin-left: 12px;" value="<?php echo $set['Idsize']; ?>"> <?php echo $set['size']; ?></button>
							<?php endwhile; ?>
							<p id="soluongton" style="margin-left:12px;"></p>

						</div>
						<div class="product-quantity">
							<span>Số lượng:</span>
							<div class="product-quantity-slider">
								<input type="text"   data-bts-min="1" data-bts-max="100000" id="product-quantity" class="quantity-input"  name="product-quantity" >
							</div>
						</div>


					</div>

				</div>
				<button type="submit" class="btn btn-main mt-20" id="addToCartBtn" disabled>Thêm vào giỏ hàng</button>
			</div>
		</form>
		<div class="alertPart">
			<div class="alert alert-success alert-common" role="alert" id="successAlert" style="display: none;">
				<i class="tf-ion-thumbsup"></i><span>Chúc mừng!</span> Bạn đã thêm thành công vào giỏ hàng
			</div>
		</div>
	</div>

	</div>
	<div class="container">
		<div class="row ">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
						<?php
						// if (isset($_SESSION['makh'])) {
							$bl = new binhluan();
							$countComment = $bl->CountAllComment($id);
							echo '<li class="" ><a data-toggle="tab" href="#reviews" aria-expanded="false" style ="color:red">Reviews (' . $countComment . ')</a></li>';
						// }

						?>
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
										$noidung = $bl->showAllComment($id, $startPage, $limit);
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
										<!-- HIỂN THỊ SỐ TRANG (Pagination) -->
										<div class="text-center">
											<ul class="pagination post-pagination">
												<?php
												$baseUrl = "index.php?action=sanpham&act=sanphamchitiet&iddm=4&id=28&reviews";
												if ($current_page > 1 && $totalPages > 1) {
													echo '<li style="font-size: 18px;"><a href="' . $baseUrl . '&page=' . ($current_page - 1) . '"><i class="tf-ion-ios-arrow-left"></i></a></li>';
												}
												for ($i = 1; $i <= $totalPages; $i++) {
													echo '<li style="font-size: 18px;" ' . ($i == $current_page ? 'class="active"' : '') . '><a href="' . $baseUrl . '&page=' . $i . '">' . $i . '</a></li>';
												}
												if ($current_page < $totalPages && $totalPages > 1) {
													echo '<li style="font-size: 18px;"><a href="' . $baseUrl . '&page=' . ($current_page + 1) . '"><i class="tf-ion-ios-arrow-right"></i></a></li>';
												}
												?>
											</ul>
										</div>
									</ul>
								
							</div>

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
								if ($set['giamgia'] > 0) {
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
	// document.addEventListener("DOMContentLoaded", function() {
	// 	checkSoluong();
	// });
// Khai báo biến toàn cục để lưu số lượng tồn
var soLuongTon = 0;
	function chonSize(a) {
		document.getElementById("mysize").value = a;
		// Thêm đường viền cho nút được nhấp
		var selectedButton = document.querySelector('.product-size .btn[value="' + a + '"]');
		selectedButton.classList.add('selected');
		if (document.getElementById("mymausac").value !== "") {
			updateStock();
		}

		document.querySelectorAll('.product-size .btn').forEach((button) => {
			if (button !== selectedButton) {
				button.classList.remove('selected');
			}
		});
		// Gọi validateForm() chỉ khi cả màu sắc và size đều đã được chọn
		if (document.getElementById("mymausac").value !== "") {
			validateForm();
		}

	}

	function chonMau(a) {
		document.getElementById("mymausac").value = a;
		var selectedButton = document.querySelector('.color-swatches .btn[value="' + a + '"]');
		selectedButton.classList.add('selected');

		// Gửi yêu cầu AJAX để lấy số lượng tồn kho dựa trên màu sắc và kích cỡ
		if (document.getElementById("mysize").value !== "") {
			updateStock();
		}
		// Xóa viền từ tất cả các nút (ngoại trừ nút đã chọn)
		document.querySelectorAll('.color-swatches .btn').forEach((button) => {
			if (button !== selectedButton) {
				button.classList.remove('selected');
			}
		});

		// Gọi validateForm() chỉ khi cả màu sắc và size đều đã được chọn
		if (document.getElementById("mysize").value !== "") {
			validateForm();
		}
	}

	function updateStock() {
		var id_hang_hoa = <?php echo $id; ?>; // Truyền id hàng hóa từ PHP vào JavaScript
		console.log(id_hang_hoa);
		var mausac = document.getElementById("mymausac").value;
		console.log(mausac);
		var size = document.getElementById("mysize").value;
		console.log(size);

		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var soluongton = parseInt(xhr.responseText);
				soLuongTon = soluongton;  // Cập nhật giá trị toàn cục
				document.getElementById("soluongton").innerHTML = soluongton > 0 ? `${soluongton} sản phẩm có sẵn` : 'Hết hàng';
				checkSoluong();
			}
		};
		//http://localhost:8080/PHP2/MyProject-update/index.php?action=sanpham&act=sanphamchitiet&iddm=4&id=28
		xhr.open("GET", "Controller/soluongton.php?idhh=" + id_hang_hoa + "&idmau=" + mausac + "&idsize=" + size, true);
		xhr.send();
	}


	function validateForm() {

		var chonmau = document.getElementById("mymausac").value;
		var chonsize = document.getElementById("mysize").value;
		var addToCartBtn = document.getElementById("addToCartBtn");
		var soluong = document.getElementById("product-quantity");
	// Kiểm tra giá trị nhập có phải là số và không được là 0
		if (soluong.value === ''){
			soluong.value = 1; 
		}
			
		
		if (chonmau === "" || chonsize === "") {
			addToCartBtn.disabled = true;
			soluong.disabled = true;
			return false;
		}else{
			addToCartBtn.disabled = false;
			soluong.disabled = false;
		}
		

		return true;
	}

function checkSoluong() {
	
	var currentQuantity = parseInt(quantityInput.value);

	
	// Sự kiện input để ngăn nhập giá trị không hợp lệ
	document.addEventListener('input', function(event) {
		var target = event.target;

		// Kiểm tra nếu là input số lượng
		if (target.classList.contains('quantity-input')) {
			var inputValue = target.value.trim();

			// Kiểm tra xem giá trị nhập liệu có phải là số và là số dương
			if (/[^0-9]/.test(inputValue)) {
				// Nếu có ký tự đặc biệt, loại bỏ chúng
				target.value = inputValue.replace(/[^0-9]/g, '');
			}
			// Kiểm tra xem giá trị có "0" đầu tiên hay không và có chiều dài >= 1
			if ( inputValue[0] === '0' && inputValue.length >= 1) {
				// Loại bỏ "0" đầu tiên
				target.value = inputValue.slice(1);
			}
			

			// var currentQuantity  = parseInt(target.value);

			// if(isNaN(currentQuantity) || currentQuantity < 0) {
			// 	console.log(currentQuantity);
			// 	currentQuantity = 1;
			// 	// target.value = 1;
			// }
			// !isNaN(currentQuantity) && currentQuantity > 0 && (disabled nếu quatity-input rỗng)
			if ( currentQuantity <= soLuongTon ) {
				document.getElementById("addToCartBtn").disabled = false;
			}else{
				document.getElementById("addToCartBtn").disabled = true;
			}

			// Kiểm tra nút "+" cần bị ẩn khi soluongcanmua > soluongton .bootstrap-touchspin-up
			var increaseButton = document.querySelector('.bootstrap-touchspin-up');
			// console.log(increaseButton);
			var slt = parseInt(soLuongTon);
			if (slt !== undefined && currentQuantity >= soLuongTon) {
				increaseButton.disabled = true;
			} else {
				increaseButton.disabled = false;
			}

			// var decreaseButton = document.querySelector('.bootstrap-touchspin-down');
			// console.log(decreaseButton);
			// if(currentQuantity < 1){
			// 	decreaseButton.disabled = true;
			// }else{
			// 	decreaseButton.disabled =false;
			// }
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
		
	var starts = {
		init: function() {
			for (let docket of document.getElementsByClassName("pstar")){// lấy được thẻ div bên ngoài
				for(let star of docket.getElementsByTagName("img")){ // 5 ngôi sao
					star.addEventListener("click", starts.click)
				}
			} 
			
		},
		click: function() {
			// lấy ra 5 ngôi sao
			let all = this.parentElement.getElementsByTagName("img"), set = this.dataset.set // 3
			i =1;
			for(let star of all){
				star.src = i <= $set ?"star.png": "star-blank.png";
				i++;
		}
		// đỗ dữ liệu lên form
		
	}

	};


</script>