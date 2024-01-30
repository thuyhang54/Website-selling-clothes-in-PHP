
<div  class="col-md-4 col-md-offset-4"><h3 ><b>DANH SÁCH HÀNG HÓA</b></h3></div>
<div class="row col-12">
<a href="index.php?action=edithanghoa"><h4>Thêm sản phẩm</h4></a>
</div>
<div class="row">
<table class="table">
    <thead>
      <tr class="table-primary">
        <th>Mã hàng</th>
        <th>Tên hàng</th>
        <th>Đơn giá</th>
        <th>Giảm giá</th>
        <th>Hình</th>
        <th>Nhóm</th>
        <th>Mã loại</th>
        <th>Đặc biệt</th>
        <th>Số lượt xem</th>
        <th>Ngày lập</th>
        <th>Mô tả</th>
        <th>Số lượng tồn</th>
        <th>Màu sắc</th>
        <th>Size</th>
        <th>Cập Nhật</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
    <?php $hh = new hanghoa();
		$result = $hh->getHangHoaAll();
		while ($set = $result->fetch()) {
		?>
      <tr>
        <td><?php echo $set['mahh']; ?></td>
        <td><?php echo $set['tenhh']; ?></td>
        <td><?php echo $set['dongia']; ?></td>
        <td><?php echo $set['giamgia']; ?></td>
        <td><img width="50px" height="50px" src="Content/images/shop/products/<?php echo $set['hinh']; ?>"/></td>
        <td></td>
        <td><?php echo $set['id_loai']; ?></td>
        <td></td>
        <td><?php echo $set['soluotxem']; ?></td>
        <td></td>
        <td><?php echo $set['mota']; ?></td>
        <td><?php echo $set['soluongton']; ?></td>
        <td><?php echo implode(', ',explode(',',$set['mausac'])); ?></td>
        <td><?php echo implode(', ',explode(',',$set['sizes'])); ?></td>
        <td><a href="">Cập nhật</a></td>
        <td><a href="">Xóa</a></td>
      </tr>
      <?php }; ?>
    </tbody>
  </table>
</div>