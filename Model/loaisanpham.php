<?php
class loaisanpham{
    function getLoaiSanPham($id){
        $db =new connect();
        $select = "SELECT id_loai, tenloai FROM tb_loai WHERE idmenu=$id";
        return $db->getList($select);
    }
    function getAllCategories()
    {
        $db = new connect();
        $select = "SELECT id_loai, tenloai FROM tb_loai";
        $result = $db->getList($select);
        return $result;
    }
}
 ?>