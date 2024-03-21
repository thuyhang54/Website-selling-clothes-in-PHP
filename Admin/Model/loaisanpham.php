<?php
class loaisanpham{
    // Phương thức lấy loại sp theo idmenu
    function getLoaiSanPham($id){
        $db =new connect();
        $select = "SELECT id_loai,tenloai,idmenu,status FROM tb_loai WHERE idmenu=$id";
        $result = $db->getList($select);
        return $result;
    }
    // Phương thức lấy loại sp
    function getAllCategories()
    {
        $db = new connect();
        $select = "SELECT * FROM tb_loai";
        $result = $db->getList($select);
        return $result;
    }
    // Phương thức insert loại sp
function insertLoaiHang($tenloai, $idmenu ){
    $db = new connect();
    $query = "INSERT INTO tb_loai(id_loai,tenloai,idmenu,status) VALUES (NULL,'$tenloai',$idmenu,0)";
    $result = $db->exec($query);
    $result;
}
// Phương thức lấy thông tin một loại hàng
function getLoaiHangID($maloai){
    $db = new connect();
    $select = "SELECT * FROM tb_loai WHERE id_loai=$maloai";
    $result = $db->getInstance($select);
    return $result;
 }
  // Phương thức update loại hàng 
  function updateLoaiHang($maloai,$tenloai, $idmenu ){
    $db=new connect();
    $query = "UPDATE tb_loai
    SET tenloai='$tenloai',idmenu=$idmenu
     WHERE id_loai=$maloai" ;
   $result =$db->exec($query);
   return $result;    
}
// Phương thức ẩn loại danh mục khi xóa
function softDeleteLoai($iddm) {
    $db=new connect();
    $query = "UPDATE tb_loai SET status = 1 WHERE id_loai =$iddm";
    $result =$db->exec($query);
    return $result;      
}

}
 ?>