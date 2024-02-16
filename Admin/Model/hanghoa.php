<?php
 class hanghoa{
    function insert_hanghoa($tenhh, $dongia,$soluongton, $giamgia, $hinh, $mausac, $size, $maloai) {
        $db = new connect();
    
        // Chèn vào tbl_hanghoa
        $queryHangHoa = "INSERT INTO tbl_hanghoa(tenhh, id_loai) VALUES ('$tenhh', $maloai)";
        $db->exec($queryHangHoa);
    
        // Lấy ID vừa chèn vào từ tbl_hanghoa
        $lastInsertedId = $db->lastInsertId();
    
        // Chèn vào tbl_cthanghoa
        $queryCTHangHoa = "INSERT INTO tbl_cthanghoa(idhanghoa, idmau, idsize, dongia, soluongton, hinh, giamgia) VALUES ($lastInsertedId, ?, ?, ?, ?, ?)";
        $db->exec($queryCTHangHoa);
    
        // Chèn vào tbl_mausac
        $queryMauSac = "INSERT INTO tbl_mausac(tenmau) VALUES ('$mausac')";
        $db->exec($queryMauSac);
    
        // Lấy ID vừa chèn vào từ tbl_mausac
        $lastInsertedMauId = $db->lastInsertId();
    
        // Chèn vào tbl_ctmausac
        $queryCTMauSac = "INSERT INTO tbl_cthanghoa(idhanghoa, idmausac) VALUES ($lastInsertedId, $lastInsertedMauId)";
        $db->exec($queryCTMauSac);
    
        // Chèn vào tbl_size
        $querySize = "INSERT INTO tbl_size(tensize) VALUES ('$size')";
        $db->exec($querySize);
    
        // Lấy ID vừa chèn vào từ tbl_size
        $lastInsertedSizeId = $db->lastInsertId();
    
        // Chèn vào tbl_ctsize
        $queryCTSize = "INSERT INTO tbl_cthanghoa(idhanghoa, idsize) VALUES ($lastInsertedId, $lastInsertedSizeId)";
        $db->exec($queryCTSize);
    
        // Chèn vào tbl_loaihanghoa
        $queryLoaiHangHoa = "INSERT INTO tb_loai(tenloai) VALUES ('$maloai')";
        $db->exec($queryLoaiHangHoa);
    
        // Lấy ID vừa chèn vào từ tbl_loaihanghoa
        $lastInsertedLoaiHangHoaId = $db->lastInsertId();
    
        // Cập nhật id_loai trong tbl_hanghoa với ID vừa chèn vào từ tbl_loaihanghoa
        $updateHangHoaLoai = "UPDATE tbl_hanghoa SET id_loai = $lastInsertedLoaiHangHoaId WHERE idhanghoa = $lastInsertedId";
        $db->exec($updateHangHoaLoai);
    }
    
    
    function getHangHoaAll(){
        $db = new connect();
        $select = "SELECT a.mahh, a.tenhh, a.soluotxem, a.mota, a.id_loai, e.tenloai, b.hinh, b.dongia, b.giamgia, SUM(b.soluongton) as tongkho, GROUP_CONCAT( DISTINCT c.mausac) AS mausac, GROUP_CONCAT(DISTINCT d.size) AS sizes
                    FROM
                        tbl_hanghoa a
                        INNER JOIN tbl_cthanghoa b ON a.mahh = b.idhanghoa
                        INNER JOIN tbl_mausac c ON b.idmau = c.Idmau
                        INNER JOIN tbl_size d ON b.idsize = d.Idsize
                        INNER JOIN tb_loai e ON a.id_loai = e.id_loai
                    GROUP BY a.mahh
                    ORDER BY  a.mahh DESC";
        $result = $db->getList($select);
        return $result;
    }
 }
 ?>