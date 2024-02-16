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
     function getList($select){
        $result =$this->db->query($select); 
        return $result;// trả về 1 table
    }
       // Phương thức truy vấn trả về một row
       function getInstance($select){
        $results =$this->db->query($select);
        $result = $results->fetch();
        return $result;
    }
    // Câu lệnh insert, update, delete ai làm ? exec
    function exec($query){
        $results =$this->db->exec($query);
        return $results;
    }
    // Dùng prepare
    function execp($query){
        $statement =$this->db->prepare($query);
        return  $statement;
    }
}
?>
