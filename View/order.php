<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Dashboard</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">my account</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a href="dashboard.html">Dashboard</a></li>
					<li><a class="active" href="order.html">Orders</a></li>
					<li><a href="address.html">Address</a></li>
					<li><a href="profile-details.html">Profile Details</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Mã hóa đơn</th>
									<th>Ngày đặt</th>
									<th>Số lượng</th>
									<th>Tổng tiền</th>
									<th>Trạng thái</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_SESSION['makh'])) {
									$makh = $_SESSION['makh'];
									$hd = new hoadon();
									$sp = $hd->getDonHangByKhachHang($makh);
									while ($setsp = $sp->fetch()) :
										$trangThaiDonHang = array(
											-1 => "Đã hủy đơn hàng",
											0 => "Chuẩn bị hàng",
											1 => "Đang giao hàng",
											2 => "Đã giao thành công"
										);
										$ttdhClassCSS = array(
											-1 => "label label-danger",
											0 => "label label-warning",
											1 => "label label-primary",
											2 => "label label-success"
										);
								?>
										<tr>
											<td><?php echo $setsp['masohd']; ?></td>
											<td><?php echo $setsp['ngaydat']; ?></td>
											<td><?php echo $setsp['soluong']; ?></td>
											<td><?php echo $setsp['tongtien']; ?><sup><u>đ</u></sup></td>
											<td><span class="<?php echo $ttdhClassCSS[$setsp['tinhtrang']]; ?>"><?php echo $trangThaiDonHang[$setsp['tinhtrang']]; ?></span></td>
											<td><a href="index.php?action=view_order&masohd=<?php echo $setsp['masohd']; ?>" class="btn btn-default">View</a></td>
										</tr>
								<?php endwhile;
								}
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>