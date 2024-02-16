
<div class="main-content">
<h3 class="title-page">
        Thêm sản phẩm
    </h3>
<form method="post" action="index.php?action=edithanghoa" enctype="multipart/form-data" >
  <table class="table table-borderless "  >

    <tr>
      <td>Mã hàng</td>
      <td> <input type="text" class="form-control" name="mahh" readonly /></td>
    </tr>
    <tr>
      <td>Tên hàng</td>
      <td><input type="text" class="form-control" name="tenhh" maxlength="100px"></td>
    </tr>
    <tr>
      <td>Đơn giá</td>
      <td><input type="text" class="form-control" name="dongia"></td>
    </tr>
    <tr>
      <td>Giảm giá</td>
      <td><input type="text" class="form-control" name="giamgia"></td>
    </tr>
    <tr>
      <td>Hình</td>
      <td>

        <label><img width="50px" height="50px" src=""></label>
        Chọn file để upload:
        <input type="file" name="image" id="fileupload">

      </td>
    </tr>
    <tr>
      <td>Nhóm</td>

      <td>
        <input type="text" class="form-control" name="nhom">
      </td>
    </tr>
    <tr>
      <td>Mã loại</td>
      <td>
            <?php
            $menu = new menu();
            $result = $menu->getMenu();
            ?>
            <select class="form-select" name="id_loai" aria-label="Default select example">
                <option selected>Chọn danh mục</option>
                <?php
                while ($menuItem = $result->fetch()) {
                    $loai = new loaisanpham();
                    $idcon = $loai->getLoaiSanPham($menuItem['idmenu']);
                    while ($subItem = $idcon->fetch()) {
                        echo '<option value="' . $subItem['id_loai'] . '" >' . $subItem['tenloai'] . '</option>';
                    };
                };
                ?>

            </select>
      </td>
    </tr>
    <tr>
      <td>Đặc biệt</td>
      <td><input type="text" class="form-control" name="dacbiet">
      </td>
    </tr>
    <tr>
      <td>Số lượt xem</td>
      <td><input type="text" class="form-control" name="slx">
      </td>
    </tr>
    <tr>
      <td>Ngày lập</td>
      <td><input type="text" class="form-control" name="ngaylap">
      </td>
    </tr>
    <tr>
      <td>Mô tả</td>
      <td><input type="text" class="form-control" name="mota">
      </td>
    </tr>
    <tr>
      <td>Số lượng tồn</td>
      <td><input type="text" class="form-control" name="slt">
      </td>
    </tr>
    <tr>
      <td>Màu sắc</td>
      <td><input type="text" class="form-control" name="mausac">
      </td>
    </tr>
    <tr>
      <td>Size</td>
      <td><input type="text" class="form-control" name="size">
      </td>
    </tr>

    <tr>
      <td colspan="2">
      <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
      </td>
    </tr>

  </table>
  </form>
</div>