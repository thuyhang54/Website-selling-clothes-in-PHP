<?php
class hanghoa
{
    function getHangHoaNew()
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem,a.id_loai, b.hinh, b.dongia, c.mausac FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND b.giamgia=0 GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT 6";
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaSale()
    {
        $db = new connect();
        $select = "SELECT  a.mahh, a.tenhh, a.soluotxem,a.id_loai, b.hinh, b.dongia, c.mausac, b.giamgia FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND b.giamgia!=0 GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT 6";
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaMuaNhieu()
    {
        $db = new connect();
        $select = "SELECT hh.mahh, hh.tenhh, hh.soluotxem, hh.id_loai, cthh.*, SUM(cthd.soluongmua) as soluotmua 
        FROM tbl_cthoadon cthd 
        JOIN tbl_cthanghoa cthh ON cthd.mahh = cthh.idhanghoa 
        JOIN tbl_hanghoa hh ON cthh.idhanghoa = hh.mahh GROUP BY hh.mahh ORDER BY `soluotmua` DESC LIMIT 6";
        $result = $db->getList($select);
        return $result;
    }
    function tongLuotMua($id)
    {
        $db = new connect();
        $select = "SELECT SUM(a.soluongmua) AS daban FROM tbl_cthoadon a WHERE mahh=$id";
        $result = $db->getInstance($select);
        return $result['daban'];
    }
    

    function getHangHoaAll()
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.mota,a.id_loai, b.hinh, b.dongia,b.giamgia, c.mausac FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau  GROUP BY a.mahh ORDER BY a.mahh DESC";
        $result = $db->getList($select);
        return $result;
    }
    // function getHangHoaAllSale($start, $limit){
    //     $db =new connect();
    //     $select = "SELECT  a.mahh, a.tenhh, a.soluotxem, b.hinh, b.dongia, c.mausac, b.giamgia FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
    //     WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND giamgia!=0 GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT ".$start.",".$limit;
    //     $result = $db->getList($select);
    //     return $result;
    // }
    function getHangHoaAllSalePage($start, $limit)
    {
        $db = new connect();
        $select = "SELECT  a.mahh, a.tenhh, a.soluotxem,a.id_loai, b.hinh, b.dongia, c.mausac, b.giamgia FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND giamgia!=0 GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT " . $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaAllPage($start, $limit)
    {
        $db = new connect();
        $select = "SELECT  a.mahh, a.tenhh, a.soluotxem,a.id_loai, b.hinh, b.dongia, c.mausac FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND b.giamgia=0 GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT " . $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaAllNoiBat($start, $limit)
    {
        $db = new connect();
        $select = "SELECT hh.mahh, hh.tenhh, hh.soluotxem, hh.id_loai, cthh.*, COUNT(cthd.mahh) as soluotmua 
        FROM tbl_cthoadon cthd 
        JOIN tbl_cthanghoa cthh ON cthd.mahh = cthh.idhanghoa 
        JOIN tbl_hanghoa hh ON cthh.idhanghoa = hh.mahh GROUP BY hh.mahh ORDER BY `soluotmua` DESC LIMIT " . $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    //  function getHangHoaAllPage2($start, $limit, $id_loai)
    // {
    //     $db = new connect();
    //     $select = "SELECT a.mahh, a.tenhh, a.soluotxem, b.hinh, b.dongia, c.mausac, b.giamgia
    //                FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
    //                WHERE a.mahh = b.idhanghoa AND b.idmau = c.Idmau";

    //     if (!empty($id_loai)) {
    //         $select .= " AND a.id_loai = '" . $id_loai . "'";
    //     }

    //     $select .= " ORDER BY a.mahh DESC LIMIT " . $start . "," . $limit;

    //     $result = $db->getList($select);
    //     return $result;
    // }

    function getHangHoaId($id)
    {
        $db = new connect();
        $select = "SELECT DISTINCT a.mahh, a.tenhh, a.mota, b.dongia, b.giamgia, SUM(b.soluongton) as tongsoluongton FROM tbl_hanghoa a, tbl_cthanghoa b WHERE a.mahh =b.idhanghoa AND a.mahh=$id";
        $result = $db->getInstance($select);
        return $result;
    }

    function getHangHoaMau($id)
    {
        $db = new connect();
        $select = "SELECT DISTINCT b.Idmau, b.mausac FROM tbl_cthanghoa a, tbl_mausac b WHERE a.idmau = b.Idmau AND a.idhanghoa=$id";
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaSize($id)
    {
        $db = new connect();
        $select = "SELECT DISTINCT b.Idsize, b.size FROM tbl_cthanghoa a, tbl_size b WHERE a.idsize=b.Idsize and a.idhanghoa=$id";
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaHinh($id)
    {
        $db = new connect();
        $select = "SELECT DISTINCT a.hinh FROM tbl_cthanghoa a WHERE a.idhanghoa=$id ";
        $result = $db->getList($select);
        return $result;
    }
    //lấy ra thông tin hình của hàng hóa phụ thuộc vào id,mau,size
    function getHangHoaIdMauSize($idhh, $idmau, $idsize)
    {
        $db = new connect();
        $select = "SELECT DISTINCT a.hinh, b.mausac, c.size FROM tbl_cthanghoa a, tbl_mausac b, tbl_size c
        WHERE a.idmau =b.Idmau AND a.idsize = c.Idsize AND a.idhanghoa=$idhh AND b.Idmau=$idmau AND c.Idsize=$idsize";
        $result = $db->getInstance($select);
        return $result;
    }
    //lấy tên màu khi biết id
    // function getTenMauById($idmau){
    //     $db = new connect();
    //     $select = "SELECT a.mausac FROM tbl_mausac a WHERE  a.Idmau=$idmau";
    //     $result =$db->getInstance($select);
    //     return $result;
    // }
    //lấy tên size khi biết id
    // function getTenSizeById($idsize) {
    //     $db = new connect();
    //     $select = "SELECT a.size FROM tbl_size a WHERE  a.Idsize=$idsize";
    //     $result =$db->getInstance($select);
    //     return $result;
    // }



    function getHangHoaTheoDanhMuc($id_loai, $start, $limit)
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem,a.id_loai, b.hinh, b.dongia, c.mausac, b.giamgia FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau  AND a.id_loai=$id_loai GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT " . $start . "," . $limit;
        // echo $select;
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaCungLoaiNew($id_loai, $start, $limit, $act)
    {
        $db = new connect();
        $dieukien = $act == 'sanphamkhuyenmai' ? 'AND b.giamgia=0' : '';
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.id_loai, b.hinh, b.dongia, c.mausac, b.giamgia
        FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE a.mahh = b.idhanghoa AND b.idmau = c.Idmau AND a.id_loai = $id_loai $dieukien
        GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT $start, $limit";
        $result = $db->getList($select);
        return $result;
    }
    function getHangHoaCungLoaiSale($id_loai, $start, $limit, $act)
    {
        $db = new connect();
        $dieukien = $act == 'sanphamkhuyenmai' ? 'AND b.giamgia!=0' : '';
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.id_loai, b.hinh, b.dongia, c.mausac, b.giamgia
            FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
            WHERE a.mahh = b.idhanghoa AND b.idmau = c.Idmau AND a.id_loai = $id_loai AND $dieukien
            GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT $start, $limit";
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaTuongTu($id, $iddm)
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.mota,a.id_loai, b.hinh, b.dongia,b.giamgia, c.mausac FROM  tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c,tbl_size d
         WHERE a.mahh = b.idhanghoa AND a.mahh <> $id AND b.idmau=c.Idmau  AND b.idsize = d.Idsize AND a.id_loai = $iddm GROUP BY a.mahh ORDER BY RAND() LIMIT 4;";
        $result = $db->getList($select);
        return $result;
    }
    // Phương thức tìm kiếm hàng hóa
    function searchProduct($tukhoa, $start, $limit)
    {
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.mota,a.id_loai, b.hinh, b.dongia,b.giamgia, c.mausac 
        FROM tbl_hanghoa a, tbl_cthanghoa b, tbl_mausac c
        WHERE  a.mahh = b.idhanghoa AND b.idmau=c.Idmau AND a.tenhh LIKE '%$tukhoa%'  GROUP BY a.mahh ORDER BY a.mahh DESC LIMIT " . $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }

    //Phương thức lấy số lượng tồn của hàng hóa
    function getSoLuongTon($idhh, $idmau, $idsize)
    {
        // echo $idhh, $idmau, $idsize;
        $db = new connect();
        $select = "SELECT soluongton FROM tbl_cthanghoa WHERE idhanghoa = $idhh AND idmau = $idmau AND idsize = $idsize";
        $result = $db->getInstance($select);
        // echo $result[0];
        return $result[0] ? $result[0] : 0;
    }
    //    function getTongSoLuongTon($idhh ){
    //     $db = new connect();
    //     $select = "SELECT SUM(soluongton) FROM tbl_cthanghoa WHERE idhanghoa = $idhh ";
    //     $result = $db->getInstance($select);
    //     return $result;
    //    }

   
}
