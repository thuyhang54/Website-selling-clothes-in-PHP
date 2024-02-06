<?php
class connect
{
    var $db = null;
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
       // Phương thức truy vấn trả về một row
       function getInstance($select){
        $results =$this->db->query($select);
        $result = $results->fetch();
        return $result;
    }
    
}
// Kiểm tra xem yêu cầu có phải là GET không
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
    if (isset($_GET['idhh']) && isset($_GET['idmau']) && isset($_GET['idsize'])) {
        // Lấy các tham số từ yêu cầu
        $id_hang_hoa = $_GET['idhh'];
        $id_mau = $_GET['idmau'];
        $id_size = $_GET['idsize'];
        // echo  "mahh: $id_hang_hoa + mamau: $id_mau + masize: $id_size";
        $slt =new soluongton();
        $soLuongTon = $slt->getSoLuongTon($id_hang_hoa, $id_mau, $id_size);
        // Trả kết quả về cho trình duyệt
        echo $soLuongTon;
    } 
    else {
        echo "Thiếu tham số";
    }
} else {
    echo "Yêu cầu không hợp lệ";
}
?>
<?php
  class soluongton {
    //Phương thức lấy số lượng tồn của hàng hóa
    public function getSoLuongTon($idhh, $idmau, $idsize) {
       $db = new connect();
       $select = "SELECT soluongton FROM tbl_cthanghoa WHERE idhanghoa = $idhh AND idmau = $idmau AND idsize = $idsize";
    //    echo $select;
       $result = $db->getInstance($select);
       return $result[0];
    }
 }
 ?>





