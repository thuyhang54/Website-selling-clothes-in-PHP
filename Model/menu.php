<?php
class menu{
    function getMenu(){
        $db = new connect();
        $select = "SELECT idmenu,tenmenu FROM tbl_menu";
        return $db->getList($select);
    }
}
 ?>