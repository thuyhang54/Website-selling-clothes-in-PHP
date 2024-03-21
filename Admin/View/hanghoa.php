<div class="container">

<div class="row ">
  
  <div class="col-md-6 pt-5"><a href="index.php?action=hanghoa&act=insert_hanghoa" class="btn btn-primary">Thêm sản phẩm</a></div>
  <!-- <div class="col-md-6">
  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

  </div> -->

</div>
<div class="row">

<table class="table table-bordered table-hover">
<h3><b>DANH SÁCH HÀNG HÓA</b></h3>
    <thead>
      <tr class="table-primary ">
        <th>Mã hàng</th>
        <th>Tên hàng</th>
        <!-- <th>Đơn giá</th>
        <th>Giảm giá</th> -->
        <!-- <th>Hình</th> -->
        <!-- <th>Nhóm</th> -->
        <th>Mã danh mục</th>
        <th>Đặc biệt</th>
        <th>Số lượt xem</th>
        <th>Ngày lập</th>
        <th>Mô tả</th>
        <!-- <th>Tổng kho</th> -->
        <!-- <th>Màu sắc</th>
        <th>Size</th> -->
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
        <td ><?php echo $set['mahh']; ?></td>
        <td><?php echo $set['tenhh']; ?></td>
        <!-- <td><?php echo $set['dongia']; ?></td> -->
        <!-- <td><?php echo $set['giamgia']; ?></td> -->
        <!-- <td><img width="50px" height="50px" src="Content/images/shop/products/<?php echo $set['hinh']; ?>"/></td> -->
        <td><?php echo $set['id_loai']; ?></td>
        <td><?php echo $set['dacbiet']; ?></td>
        <td><?php echo $set['soluotxem']; ?></td>
        <td><?php echo $set['ngaylap']; ?></td>
        <td><?php echo $set['mota']; ?></td>
        <!-- <td><?php echo $set['tongkho']; ?></td> -->
        <!-- <td><?php echo implode(', ',explode(',',$set['mausac'])); ?></td>
        <td><?php echo implode(', ',explode(',',$set['sizes'])); ?></td> -->
        <td><a href="index.php?action=hanghoa&act=update_hanghoa&id=<?php echo $set['mahh']; ?>">Cập nhật</a></td>
        <td data-is-deleted="<?php echo $set['is_deleted']; ?>">
        <!-- <a href="index.php?action=hanghoa&act=soft_delete_hanghoa&id=<?php echo $set['mahh']; ?>">Xóa</a> -->
        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $set['mahh']; ?>)">Xóa</a>
      </td>
      </tr>
      <?php }; ?>
    </tbody>
  </table>
</div>
</div>
<script>
  function confirmDelete(id) {
        if(confirm(`Bạn có chắc muốn xóa hàng hóa ${id}?`)) {
            // Gửi yêu cầu đến máy chủ để cập nhật cột is_deleted
            window.location.href = "index.php?action=hanghoa&act=soft_delete_hanghoa&id=" + id;
        }
    }

 document.addEventListener('DOMContentLoaded', () => {
    // Lấy danh sách tất cả các ô có thuộc tính data-is-deleted="1"
    var deleteButtons = document.querySelectorAll('td[data-is-deleted="1"]');
    // Duyệt qua từng ô và ẩn đi hàng chứa ô đó
    deleteButtons.forEach(deleteButton => {
        deleteButton.parentElement.style.display = 'none';
    });
});

</script>

