<?php
 $db = new connect();
$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->views) && isset($data->id)) {
    $newViews = $data->views;
    echo $newViews;
   
    $productId = $data->id; 
    $query = "UPDATE tbl_hanghoa SET soluotxem = $newViews WHERE mahh = $productId";
    $db->exec($query);
    // Phản hồi về client
    http_response_code(200); // Trạng thái thành công
    echo json_encode(array("message" => "Cập nhật số lượt xem thành công"));
} else {
    // Phản hồi về client nếu dữ liệu không hợp lệ
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Dữ liệu không hợp lệ"));
}
?>
