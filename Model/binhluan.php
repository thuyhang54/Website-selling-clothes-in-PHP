<?php 
class binhluan{
    // Phương thức insert vào database
    function insertBinhLuan($idkh,$idhanghoa,$content){
        $db = new connect();
        $query = "INSERT INTO tbl_comment(idcomment,idkh,idhanghoa,content,luotthich) VALUES (NULL, $idkh,$idhanghoa,'$content',0)";
        // echo $query;
        $db->exec($query);
    }
    // Phương thức hiển thị tất cả bình luận
    function showAllComment($idhanghoa) {
        $db = new connect();
        $select = "SELECT a.username, b.content FROM tbl_khachhang a, tbl_comment b WHERE a.makh = b.idkh AND b.idhanghoa=$idhanghoa";
        $result = $db->getList($select);
        return $result;
    }
}
?>