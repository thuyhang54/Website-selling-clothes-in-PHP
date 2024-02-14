<div class="main-content">
        <h3 class="title-page">Sản phẩm</h3>
        <div class="d-flex justify-content-end">
          <a href="index.php?action=addproduct" class="btn btn-primary mb-2">Thêm sản phẩm</a>
        </div>
        <table id="example" class="table table-striped" style="width: 100%">
          <thead>
            <tr>
              <th>STT</th>
              <th>Ảnh sản phẩm</th>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Loại sản phẩm</th>
              <th>Giá Gốc</th>
              <th>Giá khuyến mại</th>
              <th>Màu sắc</th>
              <th>Kích cỡ</th>
              <th>Kho</th>
              <th>Lượt xem</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $j=0;
           $hh = new hanghoa();
			$result = $hh->getHangHoaAll();
			while ($set = $result->fetch()) :
                $j++;
			?>
            <tr>
            <td><?=$j?></td>
            <td><img width="50px" alt="<?= $set['tenhh']; ?>" height="50px" src="Content/images/shop/products/<?=$set['hinh']; ?>"/></td>
            <td><?=$set['mahh']; ?></td>
            <td><?= $set['tenhh']; ?></td>
            <td><?php echo $set['tenloai']; ?></td>
            <td><?=$set['dongia']; ?></td>
            <td><?= $set['giamgia']; ?></td>
            <td><?= implode(', ',explode(',',$set['mausac'])); ?></td>
            <td><?= implode(', ',explode(',',$set['sizes'])); ?></td>
            <td><?= $set['tongkho']; ?></td>
            <td><?= $set['soluotxem']; ?></td>
            <td>
                <a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
          <tfoot>
          <tr>
              <th>STT</th>
              <th>Hình</th>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Loại sản phẩm</th>
              <th>Giá </th>
              <th>Giá khuyến mại</th>
              <th>Màu sắc</th>
              <th>Kích cỡ</th>
              <th>Kho</th>
              <th>Lượt xem</th>
              <th>Thao tác</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <script src="assets/js/main.js"></script>
  <script>
    new DataTable("#example");
  </script>