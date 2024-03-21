<?php
    class cthanghoa{
        function insertCTHangHoa($mahh,$mamau,$masize,$dongia,$slt,$hinh,$giamgia)
        {
            $db=new connect();
            $query="INSERT INTO tbl_cthanghoa(idhanghoa,idmau,idsize,dongia,soluongton,hinh,giamgia) VALUES ($mahh,$mamau,$masize,$dongia,$slt,'$hinh',$giamgia)";
            $result=$db->exec($query);
            return $result;
        }
    }
?>