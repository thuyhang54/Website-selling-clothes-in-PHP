<?php
 class nhanvien{
    function getAdmin($user,$pass){
        $db = new connect();
        $select = "SELECT username,matkhau FROM tbl_nhanvien WHERE username='$user' AND matkhau ='$pass'";
        $result = $db->getInstance($select);
        return $result;
    }
 }
 ?>