<?php 
// unset($_SESSION['cart']);
// kiểm tra người dùng đã có giỏ hàng chưa, nếu chưa thì tạo giỏ hàng

if (!isset($_SESSION['cart'])){
    //tạo giỏ hàng
    $_SESSION['cart'] = array(); // chứa nhiều món hàng  
}
$act = "giohang";
if(isset($_GET['act'])){
    $act =$_GET['act'];
}
switch($act){
    case 'giohang':
        include_once "./View/cart.php";
        break;
    case 'giohang_action':
        // Truyền qua id, màu, size, soluong
        $id =0;
        $mausac ='';
        $size= '';
        $soluong =0;
        if(isset($_POST['mahh'])){
            $id =$_POST['mahh'];
            $mausac= $_POST['mymausac'];
            // echo $_POST['mymausac'];
            $size= $_POST['mysize'];
          
            $soluong = $_POST['product-quantity'];
          
        // controller yêu cầu add thông tin này vao trong giỏ hàng modelWork
        $gh = new giohang();
        $gh->addCart($id, $mausac,$size,$soluong);
        echo '<meta http-equiv="refresh" content="0;url=index.php?action=giohang"/>';
        }


        break;
    case 'giohang_xoa':
        //nhận key
        if(isset($_GET['id'])){
            $id =$_GET['id'];
            unset($_SESSION['cart'][$id]);
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?action=giohang"/>';
        break;
    case 'update_gh':
        //nhận giá trị
        if(isset($_POST['newqty'])){
            $newqty = $_POST['newqty']; // [0:2,1:4]
        // duyệt qua giỏ hàng, hàng nào mà có số lượng khác với newqty (lúc đầu) thì tiến hành update
        foreach($newqty as $key =>$value){
            if($_SESSION['cart'][$key]['soluong']!=$value){
                $gh =new giohang();
                $gh-> updateHH($key,$value);
            }
        }
    }
    // Trong case 'update_gh':
// if (isset($_POST['newmausac'])) {
//     $newmausac = $_POST['newmausac'];
 

//     foreach ($newmausac as $key => $color) {
//         $color = $newmausac[$key];
//         $gh =new giohang();
//         $gh->updateHHMau($key, $color);
//     }
// }
// if (isset($_POST['newsize'])) {

//     $newsize = $_POST['newsize'];

//     foreach ($newsize as $key => $size) {
//         $size = $newsize[$key];
//         $gh =new giohang();
//         $gh->updateHHSize($key, $size);
//     }
// }

    echo '<meta http-equiv="refresh" content="0;url=index.php?action=giohang"/>';
    break;
}       

?>
