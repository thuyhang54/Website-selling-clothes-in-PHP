<?php
 class user{
    // Kiểm tra KH = user or email bất kì đã tồn tại chưa?(database)
    function checkKhachHangUser($user){
        $db = new connect();
        $select ="SELECT a.username FROM tbl_khachhang a WHERE a.username='$user'";
        $result = $db->getList($select);
        return $result;
    }
    function checkKhachHangEmail($email){
        $db = new connect();
        $select ="SELECT a.email FROM tbl_khachhang a WHERE  a.email='$email'";
        $result = $db->getList($select);
        return $result;
    }
    // Insert vào db nếu KH chưa tồn tại trong db
    function insertKhachHang($tenkh,$username,$matkhau,$email,$diachi,$sodienthoai) {
        $db = new connect();
        $query = "INSERT INTO tbl_khachhang (makh,tenkh,username,matkhau,email,diachi,sodienthoai)
        VALUES (NULL,'$tenkh','$username','$matkhau','$email','$diachi','$sodienthoai')";
        $result =$db->exec($query);
        return $result;
    }
    // Kiểm tra người dùng có tồn tại không
function checkUser($username, $pass) {
    $db = new connect();
    $select = "SELECT  a.makh, a.tenkh, a.username FROM tbl_khachhang a WHERE a.username = '$username' AND a.matkhau = '$pass'";
    $result =$db->getInstance($select);
    return $result; 
}
// Kiểm tra email người dùng có tồn tại không
function checkEmail($email)
        {
            $db=new connect();
            $select="select * from tbl_khachhang a
             WHERE a.email='$email'";
            $result=$db->getList($select);
            return $result;
        }
        // update khi biết được email
        function updatePassEmail($email,$pass) {
            $db=new connect();
            $query = "UPDATE tbl_khachhang SET matkhau='$pass' WHERE email = '$email'";
            $db->exec($query);
        }




 } 
?>