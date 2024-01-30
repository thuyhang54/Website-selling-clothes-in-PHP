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
														Màu: <?php
														 echo $item['mausac']
														  ?>
														<select name="newmausac[<?php echo $key; ?>]" id="">
															<?php
															// $availableColors = $hh->getHangHoaMau($item['mahh']);
															// foreach ($availableColors as $color) {
															// 	$selected = ($item['mausac'] == $color['mausac']) ? "selected" : "";
															// 	echo "<option value=\"$color[mausac]\" $selected>$color[mausac]</option>";
															// }
															?>
														</select>
														<br>
														Size: <?php 
														echo $item['size'];
														 ?>
														<select name="newsize[<?php echo $key; ?>]">
															<?php
															// $availableSizes = $hh->getHangHoaSize($item['mahh']);
															// foreach ($availableSizes as $size) {
															// 	$selected = ($item['size'] == $size['size']) ? "selected" : "";
															// 	echo "<option value=\"$size[size]\" $selected>$size[size]</option>";
															// }
															?>
														</select>
													</td>
													<td class=""><?php echo number_format($item['giamgia'] ? $item['giamgia'] : $item['dongia']); ?></td>
													<td>
														<div class="quantity">
															<button class="quantity-btn" type="button" onclick="updateQuantity(<?php echo $key; ?>, 'decrease')">-</button>
															<input type="text" name="newqty[<?php echo $key; ?>]" id="quantity_<?php echo $key; ?>" value="<?php echo $item['soluong']; ?>" class="quantity-input">
															<button class="quantity-btn" type="button" onclick="updateQuantity(<?php echo $key; ?>, 'increase')">+</button>
														</div>
														<!-- <input type="text" name="newqty[<?php echo $key; ?>]" id="" value="<?php echo $item['soluong']; ?>"> -->
													</td>
													<td><?php echo number_format($item['thanhtien']); ?> <sup><u>đ</u></sup></td>
													<td class=""><a class="product-remove" href="index.php?action=giohang&act=giohang_xoa&id=<?php echo $key; ?>"><button type="button" class="badge ">Xóa</button></a>
														<button type="submit" class=" badge ">Sửa</button>
													</td>
												</tr>
											<?php endforeach; ?>
											<tr>
												<td colspan="6">
													<strong style="float:right">Tổng Tiền:</strong>
												</td>
												<td>
													<strong>
														<?php
														$gh = new giohang();
														$total = $gh->getSubTotal();
														echo "$total <sup><u>đ</u></sup>";
														?>
													</strong>
												</td>
											</tr>
										</tbody>
									</table>
									<a href="index.php?action=thanhtoan" class="btn btn-main pull-right">Thanh toán</a>
									<!-- <a href="index.php?action=checkout" class="btn btn-main pull-right">Thanh toán</a> -->
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
    color: #777;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
	transition: ease-in 0.2s ;
}
.quantity-btn:hover{
	background-color: #928b8b;
}
.quantity-input {
    width: 30px;
    text-align: center;
    margin: 0 5px;
    border: 1px solid #ddd;
    padding: 5px;
}

</style>
<script>
    // Đoạn mã JavaScript để xử lý thay đổi số lượng
    function updateQuantity(index, action) {
        var quantityInput = document.getElementById('quantity_' + index);
        var currentQuantity = parseInt(quantityInput.value);

        if (action === 'increase') {
            quantityInput.value = currentQuantity + 1;
        } else if (action === 'decrease' && currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        }
    }
</script>