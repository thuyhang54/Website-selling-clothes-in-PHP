<div class="row ">
  <div class="col-md-6 offset-md-3">
    <h3><b>DANH SÁCH ĐƠN HÀNG</b></h3>
    <table class="table table-bordered">
      <thead>
        <tr class="table-primary">
          <th>Mã hóa đơn</th>
          <th>Tên khách hàng</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Ngày đặt</th>
          <th>Số lượng </th>
          <th>Thành tiền</th>
          <th>Tình trạng</th>
          <th>Cập nhật tình trạng</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $hh = new donhang();
        $result = $hh->getdonhang();
        while ($set = $result->fetch()) :
        ?>
          <tr>
            <td>
              <?php echo $set['masohd'] ?>
            </td>
            <td>
              <?php echo $set['tenkh'] ?>
            </td>
            <td>
              <?php echo $set['diachi'] ?>
            </td>
            <td>
              <?php echo $set['sodienthoai'] ?>
            </td>
            <td>
              <?php echo $set['ngaydat'] ?>
            </td>
            <td class="text-center">
              <?php echo $set['soluongmua'] ?>
            </td>
            <td>
              <?php echo $set['thanhtien'] ?>
            </td>
            <td>
              <?php
              if ($set['status'] == 0) {
                echo 'Đang chờ xử lí';
              } else if ($set['status'] == 1) {
                echo 'Đã xác nhận đơn hàng';
              } elseif ($set['status'] == 2) {
                echo 'Đang vận chuyển';
              } elseif ($set['status'] == 3) {
                echo 'Đã giao hàng';
              } elseif ($set['status'] == 4) {
                echo 'Đã hủy';
              }
              ?>
            </td>

            <td><a href="index.php?action=donhang&act=update_donhang&id=<?php echo $set['masohd']; ?>">
                <button class="btn btn-warning">
                 cập nhật
                </button>
              </a>
            </td>
          </tr>
        <?php
        endwhile;
        ?>
      </tbody>
    </table>
  </div>
</div>