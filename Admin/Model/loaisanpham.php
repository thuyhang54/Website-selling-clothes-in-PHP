<?php
class loaisanpham{
    // Phương thức lấy loại sp theo idmenu
    function getLoaiSanPham($id){
        $db =new connect();
        $select = "SELECT * FROM tb_loai WHERE idmenu=$id";
        return $db->getList($select);
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
function insertLoaiHang($tenloai, $idmenu ,$status){
    $db = new connect();
    $query = "INSERT INTO tb_loai(id_loai,tenloai,idmenu,status) VALUES (NULL,'$tenloai',$idmenu,$status)";
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
  function updateLoaiHang($maloai,$tenloai, $idmenu ,$status){
    $db=new connect();
    $query = "UPDATE tb_loai
    SET tenloai='$tenloai',idmenu=$idmenu,status = $status
     WHERE id_loai=$maloai" ;
   $result =$db->exec($query);
   return $result;    
}

}
 ?>