<?php
class user
{
    // Kiểm tra KH = user or email bất kì đã tồn tại chưa?(database)
    function checkKhachHangUser($user)
    {
        $db = new connect();
        $select = "SELECT a.username FROM tbl_khachhang a WHERE a.username='$user'";
        $result = $db->getList($select);
        return $result;
    }
    function checkKhachHangEmail($email)
    {
        $db = new connect();
        $select = "SELECT a.email FROM tbl_khachhang a WHERE  a.email='$email'";
        $result = $db->getList($select);
        return $result;
    }
    // Insert vào db nếu KH chưa tồn tại trong db
    function insertKhachHang($tenkh, $username, $matkhau, $email, $diachi, $sodienthoai)
    {
        $db = new connect();
        $query = "INSERT INTO tbl_khachhang (makh,tenkh,username,matkhau,email,diachi,sodienthoai)
        VALUES (NULL,'$tenkh','$username','$matkhau','$email','$diachi','$sodienthoai')";
        $result = $db->exec($query);
        return $result;
    }
    // Kiểm tra người dùng có tồn tại không
    function checkUser($username, $pass)
    {
        $db = new connect();
        $select = "SELECT  a.makh, a.tenkh, a.username FROM tbl_khachhang a WHERE a.username = '$username' AND a.matkhau = '$pass'";
        $result = $db->getInstance($select);
        return $result;
    }
    // Kiểm tra email người dùng có tồn tại không
    function checkEmail($email)
    {
        $db = new connect();
        $select = "select * from tbl_khachhang a
             WHERE a.email='$email'";
        $result = $db->getList($select);
        return $result;
    }
    // update khi biết được email
    function updatePassEmail($email, $pass)
    {
        $db = new connect();
        $query = "UPDATE tbl_khachhang SET matkhau='$pass' WHERE email = '$email'";
        $db->exec($query);
    }

    //phương thức hiển thị thông tin khách hàng dựa vào idkh
    function getThongTinUser($idkh)
    {
        $db = new connect();
        $select = "SELECT tenkh,diachi, email ,sodienthoai FROM tbl_khachhang WHERE makh=$idkh";
        $result = $db->getInstance($select);
        return $result;
    }
  //Phương thức cập nhật địa chỉ mới vào tbl_khachhang
function updateDiaChiMoi($idkh, $diachimoi){
    $db = new connect();

    // Lấy địa chỉ ban đầu từ cơ sở dữ liệu
    $query = "SELECT diachi FROM tbl_khachhang WHERE makh = $idkh";
    $result = $db->getInstance($query);

    if ($result && $result['diachi'] != $diachimoi){
        // Cập nhật địa chỉ mới chỉ khi khác với địa chỉ ban đầu
        $query = "UPDATE tbl_khachhang SET dc_coquan = '$diachimoi' WHERE makh = $idkh";
        echo $query;
        $db->exec($query);  

    }

    return true;
}

    // Phương thức lấy địa chỉ mới
    // function getDiaChiMoi($idkh){
    //     $db = new connect();
    //     $select = "SELECT dc_coquan FROM tbl_khachhang WHERE makh =$idkh";
    //     $result = $db->getInstance( $select );
    //     return $result['dc_coquan'];
    // }

    //  // Phương thức lấy thông tin hàng hóa theo idKH
    //  function getThongTinCTHH($idkh)
    //  {
    //      $db = new connect();
    //      $select = "SELECT a.tenhh,  c.idmau ,  c.idsize, b.hinh, b.dongia, b.giamgia, c.soluongmua, c.thanhtien 
    //      FROM tbl_hanghoa a JOIN tbl_cthanghoa b ON a.mahh = b.idhanghoa JOIN
    //       tbl_cthoadon c ON a.mahh = c.mahh 
    //       WHERE c.masohd = $masohd
    //        GROUP BY a.mahh;";
    //      $result = $db->getList($select);
    //      return $result;
    //  }
    


}
