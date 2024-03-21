
<div class="row ">

  <div class="col-md-6 col-md-offset-3">
  <h3 ><b>CHI TIẾT HÀNG HÓA</b></h3>
  <form action="index.php?action=cthanghoa&act=cthanghoa_action" method="post" enctype="multipart/form-data">
    <table class="table" style="border: 0px;">

      <tr>
        <td>Hàng hóa</td>
        <td> <select name="mahh" class="form-control" style="width:150px;">
            <?php
              $hh=new hanghoa();
              $hang=$hh->getHangHoaAll();
              while($set=$hang->fetch()):
            ?>
            <option value="<?php echo $set['mahh'];?>"><?php echo $set['tenhh'];?></option>
            <?php
              endwhile;
            ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Màu sắc</td>
        <td> <select name="mamau" class="form-control" style="width:150px;">
        <?php
              $hh=new hanghoa();
              $hang=$hh->getMau();
              while($set=$hang->fetch()):
            ?>
            <option value="<?php echo $set['Idmau'];?>"><?php echo $set['mausac'];?></option>
            <?php
              endwhile;
            ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Size</td>
        <td> <select name="masize" class="form-control" style="width:150px;">
        <?php
              $hh=new hanghoa();
              $hang=$hh->getSize();
              while($set=$hang->fetch()):
            ?>
            <option value="<?php echo $set['Idsize'];?>"><?php echo $set['size'];?></option>
            <?php
              endwhile;
            ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Đơn giá</td>
        <td><input type="text" class="form-control" name="dongia" ></td>
      </tr>
     
      <tr>
        <td>Số lượng tồn</td>
        <td><input type="text" class="form-control" name="slt" >
        </td>
      </tr>
      <tr>
        <td>Hình</td>
        <td>
        Chọn file để upload:
          <label><img width="50px" height="50px" id="previewImage"></label>
          <input type="file" name="image" id="fileupload">
        </td>
      </tr>
      <tr>
        <td>Giảm giá</td>
        <td><input type="text" class="form-control" name="giamgia" ></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
        </td>
      </tr>
    </table>
  </form>
</div>
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