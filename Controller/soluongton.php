<?php
// Kiểm tra xem yêu cầu có phải là GET không
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
    // Kiểm tra xem các tham số cần thiết đã được cung cấp hay chưa
    if (isset($_GET['idhh']) && isset($_GET['idmau']) && isset($_GET['idsize'])) {
        // Lấy các tham số từ yêu cầu
        $id_hang_hoa = $_GET['idhh'];
        $id_mau = $_GET['idmau'];
        $id_size = $_GET['idsize'];

        echo  "mahh: $id_hang_hoa + mamau: $id_mau + masize: $id_size";

        // Tạo một đối tượng 
        $slt = new soluongton();
    
        // Gọi phương thức getSoLuongTon từ lớp soluongton
        $soLuongTon = $slt->getSoLuongTon($id_hang_hoa, $id_mau, $id_size);
        echo "soLuongTon from server: " . $soLuongTon;
        
        // Trả kết quả về cho trình duyệt
        echo $soLuongTon;
    } 
    // else {
    //     // Nếu thiếu tham số, trả về lỗi hoặc giá trị mặc định
    //     echo "Thiếu tham số";
    // }
} else {
    // Nếu không phải là yêu cầu GET, trả về lỗi hoặc giá trị mặc định
    echo "Yêu cầu không hợp lệ";
}
?>





