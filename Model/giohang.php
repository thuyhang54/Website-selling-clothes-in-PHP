<?php
class giohang
{
    // thêm thông tin một sản phẩm vào giỏ hàng
    function addCart($mahh, $Idmausac, $Idsize, $soluong)
    {
        // còn thiếu hình, tên ,đơn giá, thành tiền
        $sanpham = new hanghoa();
        $sp = $sanpham->getHangHoaId($mahh);
        //   // Kiểm tra số lượng tồn
        $soLuongTon = $sanpham->getSoLuongTon($mahh, $Idmausac, $Idsize);
        //   if ($soLuongTon < $soluong){
        //     echo "<script>alert('Không đủ số lượng tồn hàng');</script>";
        //     return;
        //   }

        $tenhh = $sp['tenhh'];
        $dongia = $sp['dongia'];
        $giamgia = $sp['giamgia'];
        //lấy tên màu dựa vào mã màu
        // $mau =$sanpham->getTenMauById($Idmausac);// mau sac la id khong phai la ten
        // $tenmau = $mau['mausac'];

        // lấy tên size dựa trên idsize
        // $size = $sanpham->getTenSizeById($Idsize);
        // $tensize = $size['size'];

        // lấy hình
        $hinhmausize = $sanpham->getHangHoaIdMauSize($mahh, $Idmausac, $Idsize);
        $img = $hinhmausize['hinh'];
        // $tenmau = $hinhmausize['mausac'];
        // $tensize=$hinhmausize['size'];
        // Kiểm tra xem có giảm giá không
        $dongia = $giamgia ? $giamgia : $dongia;
        // Tính toán tổng thành tiền mới
        $total = $soluong * $dongia;
        $flag = false;
        // trước khi đưa 1 Object vào giỏ hàng thì cần kiểm tra hàng đó có tồn tại trong giỏ hàng chưa
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['mahh'] == $mahh && $item['mausac'] == $Idmausac && $item['size'] == $Idsize) {
                $flag = true;

                $soLuongTonConLai = $soLuongTon - $item['soluong'];
                if ($soLuongTonConLai <= $soluong) {
                    echo "<script>alert('Không đủ số lượng tồn hàng');</script>";
                    return;
                } else {
                    // $soluongToAdd = min($soluong, $soLuongTonConLai);
                    $soluong += $item['soluong'];
                    $this->updateHH($key, $soluong);
                    $this->updateHHMau($key, $item['mausac']);
                    $this->updateHHSize($key, $item['size']);
                    echo "<script>alert('Thêm vào giỏ hàng thành công!');</script>";
                }
            }
        }
        if (!$flag) {
            // giỏ hàng chứa một món hàng = 1 Object
            $item = array(
                'mahh' => $mahh, //thuộc tính -> giá trị tên thuôc tính tự đặt
                'tenhh' => $tenhh,
                'hinh' => $img,
                'mausac' => $Idmausac,
                'size' => $Idsize,
                'soluong' => $soluong,
                'dongia' => $dongia,
                'giamgia' => $giamgia,
                'thanhtien' => $total
            );
            // đem  đối tượng add vào giỏ hàng $_SESSION['cart'] là tên mảng; [] gia trị của mảng
            $_SESSION['cart'][] = $item;
            echo "<script>alert('Thêm vào giỏ hàng thành công!');</script>";
        } elseif (!$flag) {
            echo "<script>alert('Không đủ số lượng tồn hàng');</script>";
        }
    }
    //Phương thức tính tổng thành tiền trên giỏ hàng
    function getSubTotal()
    {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $key => $item) {
            $subtotal += $item['thanhtien'];
        }
        $subtotal = number_format($subtotal);
        return $subtotal;
    }
    //Phương thức Update
    function updateHH($index, $soluong)
    {
        if ($soluong <= 0) {
            unset($_SESSION['cart'][$index]);
        } else {
            // cập nhật là phép gán
            $_SESSION['cart'][$index]['soluong'] = $soluong;
            //kiểm tra có giảm giá không
            $giamgia =  $_SESSION['cart'][$index]['giamgia'];
            $dongia = $giamgia > 0 ? $giamgia :  $_SESSION['cart'][$index]['dongia'];
            // tính toán giá mới và cập nhật
            $_SESSION['cart'][$index]['dongia'] = $dongia;
            $tiennew = $soluong * $dongia;
            $_SESSION['cart'][$index]['thanhtien'] = $tiennew;
        }
    }
    // Trong class giohang
    function updateHHMau($index, $mausac)
    {
        if (isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['mausac'] = $mausac;
        }
    }
    function updateHHSize($index, $size)
    {
        if (isset($_SESSION['cart'][$index])) {

            $_SESSION['cart'][$index]['size'] = $size;
        }
    }
}
