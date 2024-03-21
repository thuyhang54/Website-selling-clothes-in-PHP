<?php
// ThongKeModel.php
class ThongKeModel {
    public function getThongKeTheoNgay($option) {
        // Kết nối đến cơ sở dữ liệu và các hàm liên quan
        include 'connect.php';

        // Khởi tạo biến kết quả
        $result = [];

        // Xây dựng câu lệnh SQL dựa trên lựa chọn của người dùng
        switch ($option) {
            case '7ngay':
                $query = "SELECT b.tenhh, SUM(a.soluongmua) AS soluong FROM tbl_hoadon a, tbl_cthoadon b WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND a.mahd = b.mahd GROUP BY b.tenhh";
                break;
            case '28ngay':
                $query = "SELECT b.tenhh, SUM(a.soluongmua) AS soluong FROM tbl_hoadon a, tbl_cthoadon b WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 28 DAY) AND a.mahd = b.mahd GROUP BY b.tenhh";
                break;
            case '90ngay':
                $query = "SELECT b.tenhh, SUM(a.soluongmua) AS soluong FROM tbl_hoadon a, tbl_cthoadon b WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 90 DAY) AND a.mahd = b.mahd GROUP BY b.tenhh";
                break;
            case '365ngay':
                $query = "SELECT b.tenhh, SUM(a.soluongmua) AS soluong FROM tbl_hoadon a, tbl_cthoadon b WHERE a.ngaydat >= DATE_SUB(NOW(), INTERVAL 365 DAY) AND a.mahd = b.mahd GROUP BY b.tenhh";
                break;
        }

        // Thực thi câu lệnh SQL và lấy kết quả
        $db = new connect();
        $result_set = $db->getList($query);
        if ($result_set) {
            while ($row = $result_set->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        }

        // Trả về tổng số lượng sản phẩm đã bán
        return $result;
    }
}
?>
