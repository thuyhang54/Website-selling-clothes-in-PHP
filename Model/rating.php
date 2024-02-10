<?php 
class rating{
    function getRating() {
        $db = new connect();
        $select = "SELECT rating FROM tbl_starrating";
        $result = $db->getInstance($select);
      // Kiểm tra xem $result có phải là mảng và không trống trước khi truy cập phần tử đầu tiên
      return is_array($result) && !empty($result) ? $result[0]: 0;
    }
}
?>