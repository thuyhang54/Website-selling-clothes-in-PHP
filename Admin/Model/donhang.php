<?php
class donhang
{
    function getdonhang()
    {
        $db = new Connect();
        $select = "select a.masohd, a.makh , a.ngaydat, b.tenkh, b.diachi, b.sodienthoai, SUM(c.soluongmua)as soluongmua, c.thanhtien, a.status  from tbl_hoadon a, tbl_khachhang b, tbl_cthoadon c WHERE a.masohd=c.masohd AND a.makh=b.makh GROUP BY a.masohd";
        $result = $db->getList($select);
        return $result;
    }

    function getdonhangID($id)
    {
        $db = new Connect();
        $select = "select  a.masohd, a.makh , a.ngaydat, b.tenkh, b.diachi, b.sodienthoai, c.soluongmua, c.thanhtien,a.status  from tbl_hoadon a, tbl_khachhang b, tbl_cthoadon c WHERE a.masohd=c.masohd AND a.makh=b.makh AND  a.masohd='$id'GROUP BY a.masohd";
        $result = $db->getInstance($select);
        return $result;
    }

    function updatedonhang($mahd, $ttrang)
    {
        $db = new Connect();
        $query = "update tbl_hoadon set status=$ttrang where masohd=$mahd";
        $result = $db->exec($query);
        return $result;
    }

    function gettinhtrangAll()
    {
        $db = new Connect();
        $select = "select * from tbl_tinhtrang";
        $result = $db->getList($select);
        return $result;
    }

    function gettinhtrang($ttrang)
    {
        $db = new Connect();
        $select = "select matt, tentt from tbl_tinhtrang where matt= $ttrang";
        $result = $db->getInstance($select);
        return $result;
    }


    // chưa duyệt
    // function getThongKeDonhang()
    // {
    //     $db = new Connect();
    //     $select = "SELECT c.masp, c.tensp, a.tinhtrang, b.ngaydat FROM tbl_cthoadon a, tbl_hoadon b, sanpham c WHERE a.masohd = b.masohd AND a.masp = c.masp AND a.tinhtrang = 0 GROUP BY c.tensp";
    //     $result = $db->getList($select);
    //     return $result;
    // }
}