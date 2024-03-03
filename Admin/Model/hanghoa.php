<?php
 class hanghoa{
    // Phương thức lấy tất cả hàng hóa
//   function getHangHoaAll(){
//         $db = new connect();
//         $select = "SELECT a.mahh, a.tenhh,a.dacbiet, a.soluotxem, a.mota,a.ngaylap, a.id_loai, e.tenloai, b.hinh, b.dongia, b.giamgia, SUM(b.soluongton) as tongkho, GROUP_CONCAT( DISTINCT c.mausac) AS mausac, GROUP_CONCAT(DISTINCT d.size) AS sizes
//                     FROM
//                         tbl_hanghoa a
//                         INNER JOIN tbl_cthanghoa b ON a.mahh = b.idhanghoa
//                         INNER JOIN tbl_mausac c ON b.idmau = c.Idmau
//                         INNER JOIN tbl_size d ON b.idsize = d.Idsize
//                         INNER JOIN tb_loai e ON a.id_loai = e.id_loai
//                     GROUP BY a.mahh
//                     ORDER BY  a.mahh ";
//         $result = $db->getList($select);
//         return $result;
//     }
function getHangHoaAll(){
    $db = new connect();
    $select = "SELECT * FROM tbl_hanghoa";
    $result = $db->getList($select);
    return $result;
} 
// Phương thức lấy thông tin của một sản phẩm
function getHangHoaID($id){
    $db = new connect();
    $select = "SELECT * FROM tbl_hanghoa WHERE mahh=$id";
    $result = $db->getInstance($select);
    return $result;
}
    // Phương thức insert hàng hóa
    function insertHangHoa($tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota){
        $db=new connect();
        $query = "INSERT INTO tbl_hanghoa (mahh, tenhh, id_loai, dacbiet, soluotxem, ngaylap, mota) VALUES (NULL, '$tenhh', $maloai, $dacbiet, $slx, '$ngaylap', '$mota')";
       $result =$db->exec($query);
       return $result;    
    }
    // Phương thức update hàng hóa
    function updateHangHoa($mahh,$tenhh,$maloai,$dacbiet,$slx,$ngaylap,$mota){
        $db=new connect();
        $query = "UPDATE tbl_hanghoa 
        SET tenhh='$tenhh',id_loai=$maloai,dacbiet=$dacbiet,soluotxem = $slx,ngaylap= '$ngaylap', mota ='$mota'
         WHERE mahh=$mahh" ;
       $result =$db->exec($query);
       return $result;    
    }
 }
 ?>