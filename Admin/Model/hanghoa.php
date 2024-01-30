<?php
 class hanghoa{
    function insert_hanghoa($mahh, $tenhh, $dongia, $giamgia, $hinh, $mausac, $size, $maloai) {
        $db = new connect();
        
        // Chèn vào tbl_hanghoa
        $query = "INSERT INTO tbl_hanghoa(mahh, tenhh, id_loai) VALUES (?, ?, ?)";
        $stmt = $db->execp($query);
        $stmt->execute([$mahh, $tenhh, $maloai]);

        // Lấy ID cuối cùng được chèn vào tbl_hanghoa
        $idhanghoa = $db->lastInsertId();

        // Chèn vào tbl_cthanghoa
        $queryCTHangHoa = "INSERT INTO tbl_cthanghoa(idhanghoa, idmau, idsize, dongia, hinh, giamgia) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtCTHangHoa = $db->execp($queryCTHangHoa);
        
        // Sử dụng $idhanghoa khi chèn dữ liệu vào tbl_cthanghoa
        foreach ($mausac as $mau) {
            foreach ($size as $s) {
                $stmtCTHangHoa->execute([$idhanghoa, $mau, $s, $dongia, $hinh, $giamgia]);
            }
        }
    }
    function getHangHoaAll(){
        $db = new connect();
        $select = "SELECT 
                        a.mahh,
                        a.tenhh,
                        a.soluotxem,
                        a.mota,
                        a.id_loai,
                        b.hinh,
                        b.dongia,
                        b.giamgia,
                        b.soluongton,
                        GROUP_CONCAT( DISTINCT c.mausac) AS mausac,
                        GROUP_CONCAT(DISTINCT d.size) AS sizes
                    FROM
                        tbl_hanghoa a
                        INNER JOIN tbl_cthanghoa b ON a.mahh = b.idhanghoa
                        INNER JOIN tbl_mausac c ON b.idmau = c.Idmau
                        INNER JOIN tbl_size d ON b.idsize = d.Idsize
                    GROUP BY
                        a.mahh
                    ORDER BY
                        a.mahh DESC";
        $result = $db->getList($select);
        return $result;
    }
 }
 ?>