<?php 
$act = 'loai';
if(isset($_GET['act'])){
    $act = $_GET['act'];
}

switch ($act) {
    case 'loai':
        include_once "./View/addloaisanpham.php";
        break;
        
    case 'loai_action':
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $db = new connect();
            $file = $_FILES['file']['tmp_name'];
            file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
            $file_open = fopen($file, "r");

            while(($csv = fgetcsv($file_open, 1000, ";")) !== false) {
                if(isset($csv[0]) && isset($csv[1]) && isset($csv[2])) {
                    $id_loai = $csv[0];
                    $tenloai = $csv[1];
                    $idmenu = $csv[2];
                    $status = $csv[3];
                    // $db = new connect();
                    $query = "INSERT INTO tb_loai(id_loai, tenloai, idmenu, status) VALUES ($id_loai, '$tenloai', $idmenu, $status)";
                    $db->exec($query);
                } else {
                    echo "Dữ liệu CSV không đúng định dạng";
                }
            }
            fclose($file_open);
            echo '<script>alert("Import thành công");</script>';
            echo '<meta http-equiv=refresh content="0;url=index.php?action=loai"/>';
        }
        break;
}
?>
