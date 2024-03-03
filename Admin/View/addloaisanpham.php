<?php
if (isset($_GET['iddm'])) {
  $iddm = $_GET['iddm'];
  $loaihang = new loaisanpham();
  $loaihang = $loaihang->getLoaiHangID($iddm);
  $tenloai = $loaihang['tenloai'];
  $idmenu = $loaihang['idmenu'];
  $status = $loaihang['status'];
}
?>
<?php
if (isset($_GET['action'])) {
  if (isset($_GET['act']) && $_GET['act'] == 'insert_action') {
    $ac = 1;
  } else {
    $ac = 2;
  }
}
?>
<div class="card mt-3">
  <div class="card-header info">
    <?php
    echo $ac == 1 ? ' THÊM LOẠI HÀNG HÓA' : 'CẬP NHẬT LOẠI HÀNG HÓA';
    ?>
  </div>
  <div class="card-body">
    <?php
    if ($ac == 1) {
      echo '<form action="index.php?action=quanlyloaihang&act=insert_action" method="POST">';
    } else {
      echo '<form action="index.php?action=quanlyloaihang&act=update_action" method="POST">';
    }
    ?>
    <div class="form-group">
      <label for="">Mã danh mục</label>
      <input type="text" readonly name="id" class="form-control" value="<?php echo isset($iddm) ? $iddm : ''; ?>">
    </div>
    <div class="form-group">
      <label for="">Tên danh mục</label>
      <input type="text" name="namecata" class="form-control" value="<?php echo isset($tenloai) ? $tenloai : ''; ?>">

    </div>
    <div class="form-group">
      <label for="">Menu số:</label>
      <input type="text" name="menu" class="form-control" value="<?php echo isset($idmenu) ? $idmenu : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="">Status:</label>
      <?php
      $selectedStatus = -1;
      if (isset($status) && $status != -1) $selectedStatus = $status;
      ?>
      <select class="form-select form-select-lg" name="status" id="">
        <?php
        $statusOptions = [
          ['value' => 1, 'label' => 'Hiện'],
          ['value' => 0, 'label' => 'Ẩn'],
        ];
        foreach ($statusOptions as $option) {
          $isSelected = ($selectedStatus == $option['value']) ? 'selected' : '';
          echo "<option value='{$option['value']}' {$isSelected}>{$option['label']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <?php
      if ($ac == 1) {
        echo '<button type="submit" name="submit" class="btn btn-primary">Thêm</button>';
      } else {
        echo '<button type="submit" name="submit" class="btn btn-primary">Lưu</button>';
      }
      ?>
      <a href="index.php?action=quanlyloaihang" class="btn btn-danger">Danh sách</a>
    </div>
    </form>
  </div>
</div>