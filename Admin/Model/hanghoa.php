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
    // Phương thức ẩn sp khi xóa
    function softDeleteHangHoa($id) {
        $db=new connect();
        $query = "UPDATE tbl_hanghoa SET is_deleted = 1 WHERE mahh =$id";
        $result =$db->exec($query);
        return $result;      
    }

    function getMau()
    {
        $db=new connect();
        $select="select * from tbl_mausac";
        $result=$db->getList($select);
        return $result;
    }
    function getSize()
    {
        $db=new connect();
        $select="select * from tbl_size";
        $result=$db->getList($select);
        return $result;
    }
     // phương thức thống kê
     function getThongKe($option)
     {
          // Khởi tạo biến kết quả
        //   $result = [];

          // Xây dựng câu lệnh SQL dựa trên lựa chọn của người dùng
          switch ($option) {
              case '7ngay':
                  $query = "SELECT c.tenhh, SUM(b.soluongmua) AS soluong FROM tbl_hoadon a JOIN tbl_cthoadon b ON a.masohd = b.masohd JOIN tbl_hanghoa c ON b.mahh = c.mahh WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY c.tenhh";
                  break;
              case '28ngay':
                  $query = "SELECT c.tenhh, SUM(b.soluongmua) AS soluong FROM tbl_hoadon a JOIN tbl_cthoadon b ON a.masohd = b.masohd JOIN tbl_hanghoa c ON b.mahh = c.mahh WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 28 DAY) GROUP BY c.tenhh";
                  break;
              case '90ngay':
                  $query = "SELECT c.tenhh, SUM(b.soluongmua) AS soluong FROM tbl_hoadon a JOIN tbl_cthoadon b ON a.masohd = b.masohd JOIN tbl_hanghoa c ON b.mahh = c.mahh WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 90 DAY) GROUP BY c.tenhh";
                  break;
              case '365ngay':
                  $query = "SELECT c.tenhh, SUM(b.soluongmua) AS soluong FROM tbl_hoadon a JOIN tbl_cthoadon b ON a.masohd = b.masohd JOIN tbl_hanghoa c ON b.mahh = c.mahh WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 365 DAY) GROUP BY c.tenhh";
                  break;
          }
  
          // Thực thi câu lệnh SQL và lấy kết quả
          $db = new connect();
          $result = $db->getList($query);
        //   if ($result_set) {
        //       while ($row = $result_set->fetch(PDO::FETCH_ASSOC)) {
        //           $result[] = $row;
        //       }
        //   }
  
          // Trả về tổng số lượng sản phẩm đã bán
          return $result;
        //  $db=new connect();
        //  $select="SELECT b.tenhh,sum(a.soluongmua)as soluong FROM tbl_cthoadon a,tbl_hanghoa b WHERE a.mahh=b.mahh GROUP by b.tenhh";
        //  $result=$db->getList($select);
        //  return $result;
     }
 }
 ?>