<?php 
class binhluan{
    // Phương thức insert vào database
    function insertBinhLuan($idkh,$idhanghoa,$content,$ngaygio){
        $db = new connect();
        $query = "INSERT INTO tbl_comment(idcomment,idkh,idhanghoa,content,ngay,luotthich) VALUES (NULL, $idkh,$idhanghoa,'$content','$ngaygio',0)";
        // echo $query;
        $db->exec($query);
    }
    // Phương thức hiển thị tất cả bình luận
    function showAllComment($idhanghoa,$start, $limit) {
        $db = new connect();
        $select = "SELECT a.username, b.content, b.ngay FROM tbl_khachhang a, tbl_comment b WHERE a.makh = b.idkh AND b.idhanghoa=$idhanghoa LIMIT ".$start.",".$limit;
        $result = $db->getList($select);
        return $result;
    }
    // Phương thức đếm số lượng comment
    function CountAllComment($idhanghoa) {
        $db = new connect();
        $select = "SELECT COUNT(b.idcomment) AS total_comments 
        FROM tbl_khachhang a, tbl_comment b 
        WHERE a.makh = b.idkh AND b.idhanghoa=$idhanghoa";
        $result = $db->getInstance($select);
        return $result ? $result['total_comments'] : 0;
    }
}
?>