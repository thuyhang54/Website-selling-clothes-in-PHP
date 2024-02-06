<?php

class soluongton {
   //Phương thức lấy số lượng tồn của hàng hóa
   public function getSoLuongTon($idhh, $idmau, $idsize) {
      $db = new connect();
      $select = "SELECT soluongton FROM tbl_cthanghoa WHERE idhanghoa = $idhh AND idmau = $idmau AND idsize = $idsize";
      $result = $db->getInstance($select);
      return $result ? $result[0] : 0;
   }
}
?>
