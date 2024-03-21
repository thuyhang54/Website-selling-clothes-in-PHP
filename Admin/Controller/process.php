
<?php
class connect
{
    private $db = null;
    // Hàm tạo
    function __construct()
    {   // Khởi tạo các biến chứa dữ liệu csdl
        $dsn = 'mysql:host=localhost;dbname=shopquanao';
        $user = 'root';
        $pass = '';
        // Thực hiện kết nối csdl = PDO
        try {
            $this->db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // Phương thức truy vấn trả về nhiều row
    function getList($select)
    {
        $result = $this->db->query($select);
        return $result; // trả về 1 table
    }

    // Câu lệnh insert, update, delete ai làm ? exec
    function exec($query)
    {
        $results = $this->db->exec($query);
        return $results;
    }
}
?>
<?php

// Xử lý yêu cầu từ AJAX
if (isset($_GET['option'])) {
    $option = $_GET['option'];

    $tk = new hanghoa(); // Đối tượng của lớp ThongKeModel cần được tạo để gọi phương thức getThongKeTheoNgay

    $result = $tk->getThongKe($option); // Gọi phương thức để lấy dữ liệu từ cơ sở dữ liệu

    // Chuyển đổi kết quả thành mảng dữ liệu JSON
    $data = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Xử lý trường hợp khác nếu cần
}
?>
<?php




class hanghoa
{
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


        // Trả về tổng số lượng sản phẩm đã bán
        return $result;
    }
}


?>


