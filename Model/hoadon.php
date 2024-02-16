<?php
class hoadon
{
    // phương thức insert vào bảng hóa đơn
    function insertHoaDon($makh)
    {
        $date = new DateTime('now');
        $ngay = $date->format('Y-m-d');
        $db = new connect();
        $query = "INSERT INTO tbl_hoadon(masohd,makh,ngaydat,tongtien) VALUES(Null, $makh,'$ngay',0)";
        // echo $query;
        $db->exec($query);
        $select = "SELECT masohd FROM tbl_hoadon ORDER BY masohd DESC LIMIT 1";
        $mahd = $db->getInstance($select); // mang
        return $mahd[0];
    }
    //phương thức insert vào bảng chi tiết hóa đơn
    function insertCTHoaDon($masohd, $mahh, $soluongmua, $idmau, $idsize, $thanhtien)
    {
        $db = new connect();
        $query = "INSERT INTO tbl_cthoadon(masohd,mahh,soluongmua,idmau,idsize,thanhtien,tinhtrang) VALUES ($masohd,$mahh,$soluongmua,$idmau,$idsize,$thanhtien,0)";
        $db->exec($query);
    }
    // phương thức update tong tien vao bang hoadon
    function updateHoaDonTongTien($masohd, $makh, $tongtien)
    {
        $db = new connect();
        $query = "UPDATE tbl_hoadon SET tongtien = $tongtien WHERE masohd=$masohd AND makh=$makh";
        $db->exec($query);
    }
    //phương thức hiển thị thông tin khách hàng dựa vào mshd
    function getThongTinKhachHang($masohd)
    {
        $db = new connect();
        $select = "SELECT b.masohd, b.ngaydat,a.tenkh,a.diachi,a.sodienthoai FROM tbl_khachhang a INNER JOIN  tbl_hoadon b ON a.makh =b.makh WHERE masohd=$masohd";
        $result = $db->getInstance($select);
        return $result;
    }
    // Phương thức lấy thông tin hàng hóa theo mã số hóa đơn
    function getThongTinHHID($masohd)
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, c.idmau, c.idsize, b.hinh, b.dongia, b.giamgia, c.soluongmua, c.thanhtien, c.tinhtrang, d.ngaydat, d.tongtien
        FROM tbl_hanghoa a 
        JOIN tbl_cthanghoa b ON a.mahh = b.idhanghoa 
        JOIN tbl_cthoadon c ON a.mahh = c.mahh 
        JOIN tbl_hoadon d ON c.masohd = d.masohd 
        WHERE c.masohd = $masohd GROUP BY a.mahh";
        $result = $db->getList($select);
        return $result;
    }


    // Phương thức Update soluongton
    function updatesoluongton($mahh, $idmausac, $idsize, $soluongmua)
    {
        $db = new connect();
        // update soluongton khi co don mua trong cthanghoa
        $query = "UPDATE tbl_cthanghoa
        SET soluongton = soluongton - $soluongmua
        WHERE idhanghoa=$mahh AND idmau =$idmausac AND idsize=$idsize";
        $db->exec($query);
    }
    // // Phương thức update trạng thái đơn hàng admi
    // function updateTinhTrang($masohd,$tinhtrang){
    //     $db = new connect();
    //     $query = "UPDATE tbl_cthoadon SET tinhtrang = $tinhtrang WHERE masohd = $masohd";
    //     $db->exec($query);
    // }
    function getDonHangByKhachHang($makh) {
        $db = new connect();
        $select = "SELECT a.masohd, a.ngaydat, b.soluongmua,b.thanhtien, b.tinhtrang  FROM tbl_hoadon a, tbl_cthoadon b WHERE a.makh = $makh GROUP BY a.masohd";
        $result = $db->getList($select);
        return $result;
    }
}
