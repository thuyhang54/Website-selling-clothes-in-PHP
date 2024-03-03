<form name="frmloaihang" action="index.php?action=editloaisanpham" method="post">
  <div class="card mt-3">
    <div class="card-header">
      QUẢN LÝ LOẠI HÀNG
    </div>
    <div class="card-body">
      <table class="table table-striped table">
        <thead>
          <tr class="bg-info">
            <th scope="col"></th>
            <th scope="col">Mã loại</th>
            <th scope="col">Tên loại</th>
            <th scope="col">idMenu</th>
            <th scope="col"></th>

          </tr>
        </thead>
        <tbody>
                <?php 
                $loaihang = new loaisanpham();
                $result = $loaihang->getAllCategories();
                while($set = $result->fetch()){
                ?>
                    <tr>
                      <th scope="row"><input type="checkbox" id="chonX" name="chonX" value="" ></th>
                      <td><?php echo $set['id_loai'] ?></td>
                      <td><?php echo $set['tenloai'] ?></td>
                      <td><?php echo $set['idmenu'] ?></td>
                      <td>
                        <a href="index.php?action=quanlyloaihang&act=update_loaihang&iddm=<?php echo $set['id_loai']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="" class="btn btn-danger">Xoá</a>
                      </td>
                    </tr>
					
          <input type="hidden" name="xoa" value="" />
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
    </div>
  </div>
</form>
