<?php 
class binhluan{
    // Phương thức insert vào database
    function insertBinhLuan($idkh,$idhanghoa,$content,$ngaygio,$luotthich,$star_rating){
        $db = new connect();
        $query = "INSERT INTO tbl_comment(idcomment,idkh,idhanghoa,content,ngay,luotthich,star) VALUES (NULL, $idkh,$idhanghoa,'$content','$ngaygio',0, $star_rating)";
        // echo $query;
        $db->exec($query);
    }
    // Phương thức hiển thị tất cả bình luận
    function showAllComment($idhanghoa,$start, $limit) {
        $db = new connect();
        $select = "SELECT a.username, b.content, b.ngay, b.star FROM tbl_khachhang a, tbl_comment b WHERE a.makh = b.idkh AND b.idhanghoa=$idhanghoa LIMIT ".$start.",".$limit;
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
    //Phương thức lấy trung bình đánh giá sao
    function AvgRatingStar ($idhanghoa){
        $db = new connect();
        $select = "SELECT SUM(b.star) AS total_star ,COUNT(b.idkh)  AS total_KH
        FROM tbl_khachhang a, tbl_comment b
        WHERE  a.makh = b.idkh AND b.idhanghoa=$idhanghoa";
        $result = $db->getInstance($select);
        return $result && $result["total_KH"] > 0 ? number_format($result["total_star"] / $result["total_KH"], 1) :number_format(0,1);
    }
}
?>