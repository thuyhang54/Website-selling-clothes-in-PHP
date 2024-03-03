<?php 
if(isset($_GET['id'])){
  $idhh = $_GET['id'];
  // truy vấn thôn tin của idhh
  $hh =new hanghoa();
  $kq = $hh->getHangHoaID($idhh);
  $tenhh =$kq['tenhh'];
  $maloai =$kq['id_loai'];
  $dacbiet =$kq['dacbiet'];
  $slx =$kq['soluotxem'];
  $ngaylap =$kq['ngaylap'];
  $mota =$kq['mota'];
}
?>
<?php 
if(isset($_GET['action'])){
  if(isset($_GET['act']) && $_GET['act'] == 'insert_action'){
    $ac = 1;
  }else{
    $ac = 2;
  }
}
?>
<div class=" row main-content">
 <?php echo $ac==1 ? ' <h3 class="title-page"> Thêm sản phẩm </h3>': '<h3 class="title-page">Cập nhật sản phẩm</h3>' ; ?>
 
  <?php
  if($ac == 1){
    echo '<form method="post" action="index.php?action=hanghoa&act=insert_action" enctype="multipart/form-data"> ';
  }else{
    echo ' <form method="post" action="index.php?action=hanghoa&act=update_action" enctype="multipart/form-data">';
  }
   ?>
    <table class="table table-borderless ">
      <tr>
        <td>Mã hàng</td>
        <td> <input type="text" class="form-control" name="mahh" readonly  value="<?php echo isset($idhh) ? $idhh : '';?>"/></td>
      </tr>
      <tr>
        <td>Tên hàng</td>
        <td><input type="text" class="form-control" name="tenhh" maxlength="100px" value="<?php echo isset($tenhh)? $tenhh : '' ;?>"></td>
      </tr>
      <!-- <tr>
      <td>Đơn giá</td>
      <td><input type="text" class="form-control" name="dongia"></td>
    </tr> -->
      <!-- <tr>
      <td>Giảm giá</td>
      <td><input type="text" class="form-control" name="giamgia"></td>
    </tr> -->
      <!-- <tr>
        <td>Hình</td>
        <td>
        Chọn file để upload:
          <label><img width="50px" height="50px" id="previewImage"></label>
          <input type="file" name="image" id="fileupload">
        </td>
      </tr> -->
      <!-- <tr>
      <td>Nhóm</td>
      <td>
        <input type="text" class="form-control" name="nhom">
      </td>
    </tr> -->
      <tr>
        <td>Mã loại</td>
        <td>
          <?php
          $selectloai = -1;
          if(isset($maloai) && $maloai != -1){
            $selectloai =$maloai;
          }
          $menu = new menu();
          $result = $menu->getMenu();
          ?>
          <select class="form-select" name="id_loai" aria-label="Default select example">
            <?php
            while ($menuItem = $result->fetch()) {
              $loai = new loaisanpham();
              $idcon = $loai->getLoaiSanPham($menuItem['idmenu']);
              while ($subItem = $idcon->fetch()) {
            ?>
            <option value="<?php echo $subItem['id_loai'];?>" <?php echo $selectloai == $subItem['id_loai'] ? 'selected': '' ?> ><?php echo $subItem['tenloai']; ?></option>
            <?php
              };
            };
             ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Đặc biệt</td>
        <td><input type="number" class="form-control" name="dacbiet" value="<?php echo isset($dacbiet)? $dacbiet : '' ;?>">
        </td>
      </tr>
      <tr>
        <td>Số lượt xem</td>
        <td><input type="text" class="form-control" name="slx" value="<?php echo isset($slx) ? $slx : '' ;?>">
        </td>
      </tr>
      <tr>
        <td>Ngày lập</td>
        <td><input type="date" class="form-control" name="ngaylap" value="<?php echo isset($ngaylap)? $ngaylap : '' ;?>">
        </td>
      </tr>
      <tr>
        <td>Mô tả</td>
        <td><input type="text" class="form-control" name="mota" value="<?php echo isset($mota) ? $mota : '' ;?>">
        </td>
      </tr>
      <!-- <tr>
      <td>Số lượng tồn</td>
      <td><input type="text" class="form-control" name="slt">
      </td>
    </tr> -->
      <!-- <tr>
      <td>Màu sắc</td>
      <td><input type="text" class="form-control" name="mausac">
      </td>
    </tr> -->
      <!-- <tr>
      <td>Size</td>
      <td><input type="text" class="form-control" name="size">
      </td>
    </tr> -->

      <tr>
        <td colspan="2">
          <?php
          if($ac==1){
            echo ' <button type="submit" name="submit" class="btn btn-primary">Thêm</button>';
          }else{
            echo ' <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>';
          }
           ?>
         
        </td>
      </tr>

    </table>
  </form>
</div>

<script>
  // read file image
 document.getElementById('fileupload').addEventListener('change',()=> previewImage(this))
  function previewImage(input){
    var input =document.getElementById('fileupload');
    var preview = document.getElementById('previewImage');
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = (e)=>{
        preview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>