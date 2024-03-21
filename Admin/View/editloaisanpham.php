<div class="row">
  <div class="col-md-12 ">
  <form name="frmloaihang" action="" method="post">
  <div class="card-body">
    <table class="table table-striped table">
      <thead>
        <tr class="bg-info">
          <th scope="col"></th>
          <th scope="col">Mã loại</th>
          <th scope="col">Tên loại</th>
          <th scope="col">idMenu</th>
          <th scope="col"></th>
          <th></th>

        </tr>
      </thead>
      <tbody>
        <?php
        $loaihang = new loaisanpham();
        $result = $loaihang->getAllCategories();
        while ($set = $result->fetch()) {
        ?>
          <tr>
            <th scope="row"><input type="checkbox" id="chonX" name="chonX" value=""></th>
            <td><?php echo $set['id_loai'] ?></td>
            <td><?php echo $set['tenloai'] ?></td>
            <td><?php echo $set['idmenu'] ?></td>
            <td data-is-deleted="<?php echo $set['status']; ?>">
              <a href="index.php?action=quanlyloaihang&act=update_loaihang&iddm=<?php echo $set['id_loai']; ?>" class="btn btn-warning">Sửa</a>
              <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $set['id_loai']; ?>')" class="btn btn-danger">Xóa</a>
            </td>
           
          </tr>

          <!-- <input type="hidden" name="xoa" value="" /> -->
        <?php }; ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    <a href="" class="btn btn-info">Chọn tất cả</a>
    <button class="btn btn-info" onclick="">Chọn tất cả(javascript)</button>
    <a href="" class="btn btn-info">Bỏ chọn</a>
    <a href="" class="btn btn-info">Xóa danh mục đã chọn</a>
    <button class="btn btn-info" onclick="">Xóa danh mục đã chọn test</button>
    <!-- <button type="submit" class="btn btn-info">Xoá danh mục đã chọn</button> -->
    <a href="index.php?action=quanlyloaihang&act=insert_loaihang" class="btn btn-info">Thêm mới</a>
    <a href="index.php?action=quanlyloaihang&act=insert_loaihangfile" class="btn btn-info">Thêm mới theo file excel (*CSV)</a>
  </div>
  </div>
</form>
  </div>
</div>



<script>
  function confirmDelete(id) {
    if (confirm(`Bạn có chắc muốn xóa hàng hóa ${id}?`)) {
      // Gửi yêu cầu đến máy chủ để cập nhật cột is_deleted
      window.location.href = "index.php?action=quanlyloaihang&act=soft_delete_loaihang&iddm=" + id;
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