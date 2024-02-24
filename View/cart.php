<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Cart</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">cart</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>



<div class="page-wrapper">
	<div class="cart shopping">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="block">
						<div class="product-list">
							<?php
							if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

							?>
								<form method="post" action="index.php?action=giohang&act=update_gh">
									<table class="table">
										<thead>
											<tr>
												<th class="">STT</th>
												<th class="">Sản phẩm</th>
												<th class="">Phân loại</th>
												<th class="">Đơn giá</th>
												<th class="">Số lượng</th>
												<th class="">Thành tiền</th>
												<th class="">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$j = 0;
											foreach ($_SESSION['cart'] as $key => $item) :
												$j++;
											?>
												<tr class="">
													<td><?php echo $j; ?></td>
													<td class="">
														<div class="product-info">
															<?php
															// $hh = new hanghoa();
															// $availableImgs = $hh->getHangHoaHinh($item['mahh']);
															// foreach ($availableImgs as $hinh){
															// if ($item['hinh'] == $hinh['hinh'])
															//  echo '<img width="150px" src="Content/images/shop/products/'.$hinh['hinh'].'" alt="imgProduct" /><br>';
															// }
															?>
															<img width="150px" src="Content/images/shop/products/<?php echo $item['hinh']; ?>" alt="imgProduct" /><br>
															<h5><?php echo $item['tenhh']; ?></h5>
														</div>
													</td>
													<td>
														Màu:
														
														<?php 
														// echo $item['mausac'];
														 ?> 
														 <?php 
														 $hh = new hanghoa();
																$availableColors = $hh->getHangHoaMau($item['mahh']);
															while ($color = $availableColors->fetch()) {
																if($item['mausac']==$color['Idmau'])
																echo '<label for="">'.$color['mausac'].'</label>' ;
															}
															 ?>
														<!-- <select name="newmausac[<?php echo $key; ?>]" id="mausac_<?php echo $key; ?>">
															<?php
															// $hh = new hanghoa();
															// $availableColors = $hh->getHangHoaMau($item['mahh']);
															// while ($color = $availableColors->fetch()) {
															// 	$selected = ($item['mausac'] === $color['Idmau']) ? "selected" : "";
															// 	echo "<option value=" . $color['Idmau'] . " $selected>" . $color['mausac'] . "</option>";
															// }
															?>
														</select> -->
														

														<br>
														Size: <?php 
														// echo $item['size'];
														 ?> 
														<?php 
														 $hh = new hanghoa();
																$availableSizes = $hh->getHangHoaSize($item['mahh']);
															while ($size = $availableSizes->fetch()) {
																if($item['size']== $size['Idsize'])
																echo '<label for="">'.$size['size'].'</label>' ;
															}
															 ?>
														<!-- <select name="newsize[<?php echo $key; ?>]" id="size_<?php echo $key; ?>">
														<?php
															// $hh = new hanghoa();
															// $availableSizes = $hh->getHangHoaSize($item['mahh']);
															// while ($size = $availableSizes->fetch()) {
															// 	$selected = ($item['size'] === $size['Idsize']) ? "selected" : "";
															// 	echo "<option value=" . $size['Idsize'] . " $selected>" . $size['size'] . "</option>";
															// }
															?>
														</select> -->
													</td>
													<td class="">
														<?php
														$hh = new hanghoa();
														$sp = $hh->getHangHoaId($item['mahh']);
														$giamgia = $sp['giamgia'];
														$dongiacu = $sp['dongia'];
														if ($giamgia) {
															echo '<font color="red"> ' . number_format($item["dongia"]) . '<sup><u>đ</u></sup></font>
															<strike> ' . number_format($dongiacu) . ' <sup><u>đ</u></sup></strike>';
														} else {
															echo '<font class="price">' . number_format($item['dongia']) . '<u><sup>đ</sup></u></font>';
														}; ?>

													</td>
													<td>
														<?php 
														$hh = new hanghoa();
														$slt = $hh->getSoLuongTon($item['mahh'], $item['mausac'], $item['size']);
														echo $slt;
														?>
														<div class="quantity">
															<button class="quantity-btn" type="button" onclick="updateQuantity(<?php echo $key; ?>, 'decrease', <?php echo $slt; ?>)">-</button>
															<input type="text" data-index="<?php echo $key; ?>" name="newqty[<?php echo $key; ?>]" id="quantity_<?php echo $key; ?>" value="<?php echo $item['soluong']; ?>" class="quantity-input">
															<button class="quantity-btn" data-index="<?php echo $key; ?>" data-action="increase" data-slt="<?php echo $slt; ?>" type="button" onclick="updateQuantity(<?php echo $key; ?>, 'increase',<?php echo $slt; ?>)">+</button>
														</div>
													
													</td>
													<td><?php echo number_format($item['thanhtien']); ?> <sup><u>đ</u></sup></td>
													<td class="">
														<a class="badge badg" href="index.php?action=giohang&act=giohang_xoa&id=<?php echo $key; ?>">Xóa</a>
														
													</td>
												</tr>
											<?php endforeach; ?>
											<tr>
												<td colspan="5">
													<strong style="float:right">Tổng Tiền:</strong>
												</td>
												<td>
													<strong>
														<?php 
														$total = 0;
														$subtotal = 0;
																foreach ($_SESSION['cart'] as $key => $item) {
																	$subtotal = $item['soluong']*$item['dongia'];
																	$total += $subtotal;
																}
																echo number_format($total);
														?>
														<?php
														// $gh = new giohang();
														// $total = $gh->getSubTotal();
														// echo "$total <sup><u>đ</u></sup>";
														?>
													</strong>
												</td>
												<td><button type="submit" class="update_soluong btn btn-warning " data-index="<?php echo $key; ?>" data-slt="<?php echo $slt; ?>">Sửa</button></td>
											</tr>
										</tbody>
									</table>
									<a href="index.php?action=checkout" class="btn btn-main pull-right">Mua hàng</a>
									<!-- <a href="index.php?action=thanhtoan" class="btn btn-main pull-right">Thanh toán</a> -->
								</form>
							<?php
							} else {
								include_once './View/empty-cart.php';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.product-list .quantity {
		display: flex;
		align-items: center;
	}

	.quantity-btn {
		font-size: 20px;
		color: #777;
		border: none;
		padding: 5px 10px;
		cursor: pointer;
		transition: ease-in 0.2s;
	}

	/* .quantity-btn:hover{
background-color: #928b8b;
} */
	.quantity-input {
		width: 45px;
		text-align: center;
		margin: 0 5px;
		border: 1px solid #ddd;
		padding: 5px;
	}
</style>
<script>
	// Đoạn mã JavaScript để xử lý thay đổi số lượng
	function updateQuantity(index, action, soLuongTon) {
		var quantityInput = document.getElementById('quantity_' + index);
		var increaseButton = document.querySelector('[data-index="' + index + '"][data-action="increase"]');
		var currentQuantity = parseInt(quantityInput.value);

		// Kiểm tra giá trị nhập có phải là số và không được là 0
		if (isNaN(currentQuantity) || currentQuantity < 1) {
			currentQuantity = 1; // Đặt lại giá trị nếu không hợp lệ
		}

		if (action === 'increase' && currentQuantity <= soLuongTon) {

			quantityInput.value = currentQuantity + 1;

		} else if (action === 'decrease' && currentQuantity > 1) {
			quantityInput.value = currentQuantity - 1;
		}
		// Kiểm tra giá trị nhập không được lớn hơn số lượng tồn kho
		if (soLuongTon !== undefined && currentQuantity > soLuongTon) {
			alert("Chỉ còn " + soLuongTon + " sản phẩm trong kho.");
			currentQuantity = soLuongTon;
			quantityInput.value = currentQuantity;
			increaseButton.disabled = true;
		} else {
			increaseButton.disabled = false;
		}
		// Nếu số lượng giảm và sẽ về 1, hiển thị hộp thoại xác nhận
		if (action === 'decrease' && currentQuantity === 1) {
			var confirmed = confirm("Hành động này sẽ xóa sản phẩm khỏi giỏ hàng. Bạn có chắc chắn muốn tiếp tục?");
			if (!confirmed) {
				return; // Hủy bỏ nếu người dùng chọn "Hủy"
			} else {
				window.location.href = "index.php?action=giohang&act=giohang_xoa&id=" + index;
			}
		}

		console.log('currentQuantity:', currentQuantity);
		console.log('soLuongTon:', soLuongTon);
		console.log('increaseButton.disabled:', increaseButton.disabled);
	}



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
			// Kiểm tra xem giá trị có "0" đầu tiên hay không và có chiều dài >= 2
			if (inputValue.length >= 1 && inputValue[0] === '0') {
				// Loại bỏ "0" đầu tiên
				target.value = inputValue.slice(1);
			}


			// Kiểm tra nút "+" cần bị ẩn hay không
			var index = target.getAttribute('data-index');
			var increaseButton = document.querySelector('[data-index="' + index + '"][data-action="increase"]');
			var currentQuantity = parseInt(inputValue);
			var soLuongTon = parseInt(increaseButton.getAttribute('data-slt'));
			if (soLuongTon !== undefined && currentQuantity >= soLuongTon) {
				increaseButton.disabled = true;
			} else {
				increaseButton.disabled = false;
			}
		}

	});

	document.addEventListener('click', function(event) {
		var target = event.target;
		// Kiểm tra nếu là nút sửa 
		if (target.classList.contains('update_soluong') && target.innerText === 'Sửa') {
			var index = target.getAttribute('data-index');
			var quantityInput = document.getElementById('quantity_' + index);
			var currentQuantity = parseInt(quantityInput.value);
			var soLuongTon = parseInt(target.getAttribute('data-slt'));

			// Kiểm tra giá trị nhập không được lớn hơn số lượng tồn kho
			if (soLuongTon !== undefined && currentQuantity > soLuongTon) {
				alert("Chỉ còn " + soLuongTon + " sản phẩm trong kho.");
				quantityInput.value = soLuongTon;
			}

			console.log(currentQuantity);

		}
	});
</script>