<!-- PHÂN TRANG -->
<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$hh = new binhluan();
$count = $hh->CountAllComment($id);
$limit = 3;
$page = new page();
$totalPages = $page->findPage($count, $limit);
$startPage = $page->findStart($limit);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<!-- /PHÂN TRANG -->
<section class="single-product">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li><a href="index.php?action=home">Trang chủ</a></li>
                    <li><a href="index.php?action=shop">Nữ</a></li>
                    <li class="active">Chi tiết</li>
                </ol>
            </div>
            <div class="col-md-6">
                <ol class="product-pagination text-right">
                    <li><a href="blog-left-sidebar.html"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
                    <li><a href="blog-left-sidebar.html">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
                </ol>
            </div>
        </div>
        <!-- Product-detail-Form -->
        <form id="form1" action="index.php?action=giohang&act=giohang_action" method="post"
            onsubmit="return validateForm()">
            <div class="row mt-20">

                <div class="col-md-5">
                    <div class="single-product-slider">
                        <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                            <div class='carousel-outer'>
                                <!-- me art lab slider -->

                                <div class='carousel-inner '>
                                    <?php
                                    $id = isset($_GET['id']) ? $_GET['id'] : 0;
                                    $hh = new hanghoa();
                                    $sp = $hh->getHangHoaId($id);
                                    $tenhh = $sp['tenhh'];
                                    $mota = $sp['mota'];
                                    $dongia = $sp['dongia'];
                                    $giamgia = $sp['giamgia'];
                                    $soluongton = $sp['tongsoluongton'];
                                    // echo $soluongton;
                                    ?>
                                    <?php
                                    $hinh = $hh->getHangHoaHinh($id);
                                    $active = true; // Đánh dấu hình đầu tiên là active
                                    while ($img = $hinh->fetch()) :
                                    ?>
                                    <div class='item <?php echo $active ? 'active' : ''; ?>'>
                                        <img src='Content/images/shop/products/<?php echo $img['hinh']; ?>' alt=''
                                            data-zoom-image='Content/images/shop/products/<?php echo $img['hinh']; ?>' />
                                    </div>
                                    <?php
                                        $active = false; // Đánh dấu các hình sau là không active
                                    endwhile;
                                    ?>
                                </div>

                                <!-- sag sol -->
                                <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                                    <i class="tf-ion-ios-arrow-left"></i>
                                </a>
                                <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                                    <i class="tf-ion-ios-arrow-right"></i>
                                </a>

                            </div>

                            <!-- thumb -->
                            <ol class='carousel-indicators mCustomScrollbar meartlab' data-target='#carousel-custom'>
                                <?php
                                $hinh = $hh->getHangHoaHinh($id);
                                $countImg = $hinh->rowCount();
                                for ($i = 0; $i < $countImg; $i++) :
                                    $img = $hinh->fetch();
                                ?>
                                <li data-target='#carousel-custom' data-slide-to='<?php echo $i; ?>'
                                    <?php echo $i == 0 ? 'class="active"' : ''; ?>>
                                    <img src='Content/images/shop/products/<?php echo $img['hinh']; ?>' alt='' />
                                </li>
                                <?php endfor; ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <!-- hidden để hiển thị star -->
                    <form id="ninForm_2" method="post" target="_self">
                        <input type="text" name="pid" id="ninPdt">
                        <input type="text" name="stars" id="ninStar">
                    </form>
                    <input type="text" name="mahh" id="mahh" value="<?php echo $id; ?>">
                    <div class="single-product-details">
                        <h2><?php echo $tenhh; ?></h2>

                        <div class="" style="display:inline-flex;">
                            <!-- Hiển thị số sao -->
                            <div class="rating">
                                <?php
                                $stars = new binhluan();
                                $starRating = $stars->AvgRatingStar();
                                echo $starRating;
                                for ($i = 1; $i <= $starRating; $i++) {
                                    echo '<span class="starrating' . ($i <= $starRating ? ' active' : '') . '">★</span>';
                                }
                                ?>
                            </div>

                            <?php
                            $bl = new binhluan();
                            $countComment = $bl->CountAllComment($id);
                            echo '<p style="border-left: 1px solid #dedede; margin-left:12px; padding:0 12px; height:100%;><a data-toggle="tab" href="#reviews" aria-expanded="false">' . $countComment . '</a> Đánh giá</p>';
                            ?>
                            <?php
                            $sum = new hanghoa();
                            $sumSold = $sum->tongLuotMua($id);
                            echo '<p style="border-left: 1px solid #dedede; margin-left:12px; padding:0 12px; height:100%; "><a data-toggle="tab" href="#reviews" aria-expanded="false">' . $sumSold . '</a> Đã Bán</p>';
                            ?>
                        </div>

                        <?php
                        if ($giamgia) {
                            echo '  <h5 class="my-4 font-weight-bold" style="color: red;">
							<font color="red">' . number_format($giamgia) . '<sup><u>đ</u></sup></font>
							<strike>' . number_format($dongia) . '<sup><u>đ</u></sup></strike>
							</h5>';
                        } else {
                            echo '<h3 class="price">' . number_format($dongia) . ' <u><sup>đ</sup></u></h3>';
                        }
                        ?>
                        <!-- Hiển thị số lượng tồn -->
                        <p>Kho: <?php echo isset($soluongton) ? $soluongton : 0 ?></p>
                        <p class="product-description mt-20">
                            <?php echo $mota; ?>
                        </p>
                        <div class="product-category">
                            <span>Vận chuyển:</span>
                            <ul>
                                <li><a href="product-single.html">Products</a></li>
                                <li><a href="product-single.html">Soap</a></li>
                            </ul>
                        </div>
                        <div id="check-form">
                            <div class="color-swatches">
                                <span>Màu sắc:</span>
                                <input type="text" name="mymausac" id="mymausac" value="" />
                                <small class="error-message" id="colorEmpty"></small>

                                <?php
                                $mau = $hh->getHangHoaMau($id);
                                while ($set = $mau->fetch()) :
                                ?>
                                <button type="button" name="" class="btn" style="margin-left: 12px;"
                                    value="<?php echo $set['Idmau']; ?>"
                                    onclick="chonMau(<?php echo $set['Idmau']; ?>)">
                                    <?php echo $set['mausac']; ?>
                                </button>
                                <?php endwhile; ?>
                            </div>
                            <div class="product-size">
                                <input type="text" name="mysize" id="mysize" value="" />
                                <small class="error-message" id="sizeEmpty"></small>

                                <span>Size:</span>
                                <?php
                                $size = $hh->getHangHoaSize($id);
                                while ($set = $size->fetch()) :
                                ?>
                                <button type="button" id="btnSize" onclick="chonSize(<?php echo $set['Idsize']; ?>)"
                                    name="" class="btn" style="margin-left: 12px;"
                                    value="<?php echo $set['Idsize']; ?>"> <?php echo $set['size']; ?></button>
                                <?php endwhile; ?>
                                <p id="soluongton" style="margin-left:12px;"></p>

                            </div>
                            <div class="product-quantity">
                                <span>Số lượng:</span>
                                <div class="product-quantity-slider">
                                    <input type="text" value="1" data-bts-min="1"
                                        data-bts-max="<?php echo $soluongton; ?>" id="product-quantity"
                                        class="quantity-input" name="product-quantity">
                                </div>
                            </div>
                            <div id="error-message" style="color: red; display:none;"></div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-main mt-20" id="addToCartBtn">Thêm vào giỏ hàng</button>
            </div>
        </form> <!-- End product-detail-Form -->

    </div>
    <div class="container">
        <div class="row ">
            <div class="col-xs-12">
                <div class="tabCommon mt-20">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
                        <?php
                        // if (isset($_SESSION['makh'])) {
                        $bl = new binhluan();
                        $countComment = $bl->CountAllComment($id);
                        echo '<li class="" ><a data-toggle="tab" href="#reviews" aria-expanded="false" style ="color:red">Reviews (' . $countComment . ')</a></li>';
                        // }

                        ?>
                    </ul>
                    <div class="tab-content patternbg">
                        <div id="details" class="tab-pane fade active in">
                            <?php echo $mota; ?>
                        </div>
                        <div id="reviews" class="tab-pane fade">
                            <div class="post-comments">
                                <?php
                                if (isset($_SESSION['makh'])) :
                                ?>
                                <form action="index.php?action=binhluan" method="post">
                                    <!-- <div class="row">
											<input type="hidden" name="txtmahh" value="<?php echo $id; ?>" />
											<img src="./Content/imagetourdien/people.png" width="100px" height="100px" />
											<textarea class="input-field" type="text" name="comment" rows="2" cols="70" id="comment" placeholder="Thêm bình luận"></textarea>
											<input type="submit" name="submit" class="btn " id="submitButton" value="Bình Luận" />
										</div> -->
                                    <!-- <div class="row g-2">
											<div class="form-floating col-md-6">
												<label for="">Họ và tên:</label>
												<input type="text" class="form-control name_comment" id="floatingPassword" placeholder="Họ tên">
											</div>
											<div class="form-floating col-md-6">
												<label for="floatingInput">Địa chỉ email:</label>
												<input type="email" class="form-control email_comment" id="floatingInput" placeholder="name@example.com">
											</div>
										</div> -->
                                    <input type="hidden" name="txtmahh" value="<?php echo $id; ?>" />

                                    <div class="card">
                                        <br />
                                        <span onclick="gfg(1)" class="star">★
                                        </span>
                                        <span onclick="gfg(2)" class="star">★
                                        </span>
                                        <span onclick="gfg(3)" class="star">★
                                        </span>
                                        <span onclick="gfg(4)" class="star">★
                                        </span>
                                        <span onclick="gfg(5)" class="star">★
                                        </span>
                                        <input type="text" class="star_rating_value" name="star_rating_value" />
                                        <h3 id="output">
                                            Rating is: 0/5
                                        </h3>
                                    </div>
                                    <div class="form-floating">
                                        <label for="floatingTextarea2">Bình luận:</label>
                                        <textarea type="text" class="form-control content_comment" name="comment"
                                            placeholder="Viết đánh giá của bạn ở đây" id="floatingTextarea2"
                                            style="height: 100px"></textarea>
                                    </div>
                                    <div class="" style="margin-top: 10px;">
                                        <button type="submit" name="submit" class="btn btn-warning send-comment">Gửi
                                            bình luận</button>
                                    </div>
                                </form>
                                <?php endif; ?>
                                <ul class="media-list comments-list m-bot-50 clearlist">
                                    <!-- Comment Item start-->
                                    <?php
                                    $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
                                    $bl = new binhluan();
                                    $noidung = $bl->showAllComment($id, $startPage, $limit);
                                    while ($set = $noidung->fetch()) :
                                    ?>
                                    <li class="media">

                                        <a class="pull-left" href="#!">
                                            <img class="media-object comment-avatar" src="Content/images/blog/OIP.jpg"
                                                alt="" width="50" height="50" />
                                        </a>

                                        <div class="media-body">
                                            <div class="comment-info">
                                                <h4 class="comment-author">
                                                    <a href="#!"> <?php echo '<b>' . $set['username'] . '</b>'; ?></a>
                                                    <!-- Hiển thị số sao -->
                                                    <div class="rating">
                                                        <?php
                                                            $starRating = $set['star'];
                                                            echo $starRating;
                                                            for ($i = 1; $i <= $starRating; $i++) {
                                                                echo '<span class="starrating' . ($i <= $starRating ? ' active' : '') . '">★</span>';
                                                            }
                                                            ?>
                                                    </div>


                                                </h4>
                                                <time datetime="<?php echo $set['ngay']; ?>">
                                                    <?php echo date('d-m-Y, \v\à\o\ \l\ú\c H:i', strtotime($set['ngay'])); ?>
                                                </time>

                                                <a class="comment-button" href="#!"><i
                                                        class="tf-ion-chatbubbles"></i>Reply</a>
                                            </div>

                                            <p>
                                                <?php echo  $set['content']; ?>
                                            </p>
                                        </div>

                                    </li>
                                    <?php endwhile; ?>
                                    <!-- End Comment Item -->
                                    <!-- HIỂN THỊ SỐ TRANG (Pagination) -->
                                    <div class="text-center">
                                        <ul class="pagination post-pagination">
                                            <?php
                                            $baseUrl = "index.php?action=sanpham&act=sanphamchitiet&iddm=$iddm&id=$id";
                                            if ($current_page > 1 && $totalPages > 1) {
                                                echo '<li style="font-size: 18px;"><a href="' . $baseUrl . '&page=' . ($current_page - 1) . '"><i class="tf-ion-ios-arrow-left"></i></a></li>';
                                            }
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<li style="font-size: 18px;" ' . ($i == $current_page ? 'class="active"' : '') . '><a href="' . $baseUrl . '&page=' . $i . '">' . $i . '</a></li>';
                                            }
                                            if ($current_page < $totalPages && $totalPages > 1) {
                                                echo '<li style="font-size: 18px;"><a href="' . $baseUrl . '&page=' . ($current_page + 1) . '"><i class="tf-ion-ios-arrow-right"></i></a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="products related-products section">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>Sản phẩm tương tự</h2>
            </div>
        </div>
        <div class="row">
            <?php
            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $sptt = $hh->getHangHoaTuongTu($id, $iddm);
            while ($set = $sptt->fetch()) {
            ?>
            <div class="col-md-3">
                <div class="product-item">
                    <div class="product-thumb">
                        <?php if ($set['giamgia']) {
                                echo '<span class="bage">Sale</span>';
                            } ?>
                        <img class="img-responsive" src="Content/images/shop/products/<?php echo $set['hinh'] ?>"
                            alt="product-img" />
                        <div class="preview-meta">
                            <ul>
                                <li>
                                    <span data-toggle="modal" data-target="#product-modal-<?php echo $set['mahh']; ?>">
                                        <i class="tf-ion-ios-search"></i>
                                    </span>
                                </li>
                                <li>
                                    <a href="#"><i class="tf-ion-ios-heart"></i></a>
                                </li>
                                <li>
                                    <a
                                        href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><i
                                            class="tf-ion-android-cart"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a
                                href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><?php echo $set['tenhh']; ?></a>
                        </h4>
                        <?php
                            if ($set['giamgia'] > 0) {
                                echo '	<h5 class="my-4 font-weight-bold" style="color: red;">
								<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
								<strike> ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
							</h5>';
                            } else {
                                echo '<p class="product-price">' . number_format($set['dongia']) . '<u><sup>đ</sup></u>';
                            }
                            ?>
                    </div>
                </div>
            </div>
            <?php
            };
            ?>


        </div>
    </div>
</section>
<section class="products related-products section">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>Sản phẩm tương tự</h2>
            </div>
        </div>
        <div class="row">
            <?php
            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $sptt = $hh->getHangHoaTuongTu($id, $iddm);
            while ($set = $sptt->fetch()) {
            ?>
            <div class="col-md-3">
                <div class="product-item">
                    <div class="product-thumb">
                        <?php if ($set['giamgia']) {
                                echo '<span class="bage">Sale</span>';
                            } ?>
                        <img class="img-responsive" src="Content/images/shop/products/<?php echo $set['hinh'] ?>"
                            alt="product-img" />
                        <div class="preview-meta">
                            <ul>
                                <li>
                                    <span data-toggle="modal" data-target="#product-modal-<?php echo $set['mahh']; ?>">
                                        <i class="tf-ion-ios-search"></i>
                                    </span>
                                </li>
                                <li>
                                    <a href="#"><i class="tf-ion-ios-heart"></i></a>
                                </li>
                                <li>
                                    <a
                                        href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><i
                                            class="tf-ion-android-cart"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a
                                href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"><?php echo $set['tenhh']; ?></a>
                        </h4>
                        <?php
                            if ($set['giamgia'] > 0) {
                                echo '	<h5 class="my-4 font-weight-bold" style="color: red;">
								<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
								<strike> ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
							</h5>';
                            } else {
                                echo '<p class="product-price">' . number_format($set['dongia']) . '<u><sup>đ</sup></u>';
                            }
                            ?>
                    </div>
                </div>
            </div>
            <?php
            };
            ?>


        </div>
    </div>
</section>



<!-- Modal -->
<?php

$hh = new hanghoa();
$result = $hh->getHangHoaAll();
while ($set = $result->fetch()) {

?>
<div class="modal product-modal fade" id="product-modal-<?php echo $set['mahh']; ?>">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="tf-ion-close"></i>
    </button>
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="modal-image">
                            <img class="img-responsive"
                                src="<?php echo 'Content/images/shop/products/' . $set['hinh']; ?>" alt="product-img" />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="product-short-details">
                            <h2 class="product-title"><?php echo $set['tenhh']; ?></h2>
                            <?php
                                if ($set['giamgia'] > 0) {
                                    echo '	<h5 class="my-4 font-weight-bold" style="color: red;">
										<font color="red">' . number_format($set['giamgia']) . '<sup><u>đ</u></sup></font>
										<strike> ' . number_format($set['dongia']) . '<sup><u>đ</u></sup></strike>
									</h5>';
                                } else {
                                    echo '<p class="product-price">' . number_format($set['dongia']) . '<u><sup>đ</sup></u>';
                                }
                                ?>
                            <p class="product-short-description">
                                <?php echo $set['mota']; ?>
                            </p>
                            <a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>"
                                class="btn btn-main">Xem chi tiết</a>
                            <!-- <a href="index.php?action=sanpham&act=sanphamchitiet&iddm=<?php echo $set['id_loai']; ?>&id=<?php echo $set['mahh']; ?>" class="btn btn-transparent">View Product Details</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }; ?>
<!-- /.modal -->
<style>
.selected {
    border: 2px solid #000;
}
</style>
<script type="text/javascript">
//  function showSuccessAlert(){
// 	var successAlert = document.getElementById('successAlert');
// 	successAlert.style.display = "block";
// 	setTimeout(function () {
// 		successAlert.style.display = "none";
// 	},3000);
//  }

// 	var stars = {
// 		init: function() {
// 			for (let docket of document.getElementsByClassName("pstar")){// lấy được thẻ div bên ngoài
// 				for(let star of docket.getElementsByTagName("img")){ // 5 ngôi sao
// 					star.addEventListener("click", stars.click)
// 				}
// 			} 

// 		},
// 		click: function() {
// 			// lấy ra 5 ngôi sao
// 			console.log('Star clicked!');
// 			let all = this.parentElement.getElementsByTagName("img"),
// 			 set = this.dataset.set, // dataset.set lấy giá trị của data -(set) 3
// 			i =1;
// 			for(let star of all){
// 				star.src = i <= set ?"star.png": "star-blank.png";
// 				i++;
// 		}
// 		  // Đẩy dữ liệu lên form
// 	// 	  let form = this.closest('ninForm_2'); // Tìm form chứa ngôi sao được click
//     // form.querySelector("input[name='pid']").value = form.querySelector(".pstar").dataset.pid; 
//     // form.querySelector("input[name='stars']").value = form.dataset.set;
//     // form.submit();
// 		document.getElementById("ninPdt").value = this.parentElement.dataset.pid; // 24
// 		document.getElementById("ninStar").value = this.dataset.set;
// 		document.getElementById("ninForm_2").submit();
// 	}

// 	};

// window.addEventListener('DOMContentLoaded',stars.init);
// document.addEventListener("DOMContentLoaded", function() {
// 	checkSoluong();
// });

// Khai báo biến toàn cục để lưu số lượng tồn
var soLuongTon = 0;



function chonSize(a) {
    document.getElementById("mysize").value = a;
    // Thêm đường viền cho nút được nhấp
    var selectedButton = document.querySelector('.product-size .btn[value="' + a + '"]');
    selectedButton.classList.add('selected');
    if (document.getElementById("mymausac").value !== "") {
        updateStock();
    }

    document.querySelectorAll('.product-size .btn').forEach((button) => {
        if (button !== selectedButton) {
            button.classList.remove('selected');
        }
    });
    // Gọi validateForm() chỉ khi cả màu sắc và size đều đã được chọn
    if (document.getElementById("mymausac").value !== "") {
        validateForm();
    }

}

function chonMau(a) {
    document.getElementById("mymausac").value = a;
    var selectedButton = document.querySelector('.color-swatches .btn[value="' + a + '"]');
    selectedButton.classList.add('selected');

    // Gửi yêu cầu AJAX để lấy số lượng tồn kho dựa trên màu sắc và kích cỡ
    if (document.getElementById("mysize").value !== "") {
        updateStock();
    }
    // Xóa viền từ tất cả các nút (ngoại trừ nút đã chọn)
    document.querySelectorAll('.color-swatches .btn').forEach((button) => {
        if (button !== selectedButton) {
            button.classList.remove('selected');
        }
    });

    // Gọi validateForm() chỉ khi cả màu sắc và size đều đã được chọn
    if (document.getElementById("mysize").value !== "") {
        validateForm();
    }
}
// lấy ra số lượng tồn của sp có cùng idhh màu và size
function updateStock() {
    var id_hang_hoa = <?php echo $id; ?>; // Truyền id hàng hóa từ PHP vào JavaScript
    console.log(id_hang_hoa);
    var mausac = document.getElementById("mymausac").value;
    console.log(mausac);
    var size = document.getElementById("mysize").value;
    console.log(size);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        var addToCartBtn = document.getElementById("addToCartBtn");
        var chonmau = document.getElementById("mymausac");

        var quantity = document.querySelector(" .quantity-input");
        if (xhr.readyState == 4 && xhr.status == 200) {
            var soluongton = parseInt(xhr.responseText);
            soLuongTon = soluongton; // Cập nhật giá trị toàn cục
            if (soluongton === 0) {
                addToCartBtn.disabled = true;
                quantity.disabled = true;

                document.getElementById("soluongton").innerHTML = 'Hết hàng';
            } else {
                quantity.value = 1;
                addToCartBtn.disabled = false;
                quantity.disabled = false;

                document.getElementById("soluongton").innerHTML = `${soluongton} sản phẩm có sẵn`;
                checkSoluong();
            }


        }
    };
    //http://localhost:8080/PHP2/MyProject-update/index.php?action=sanpham&act=sanphamchitiet&iddm=4&id=28
    xhr.open("GET", "Controller/soluongton.php?idhh=" + id_hang_hoa + "&idmau=" + mausac + "&idsize=" + size, true);
    xhr.send();
}


// Validate form
function validateForm() {

    var chonmau = document.getElementById("mymausac");
    var chonsize = document.getElementById("mysize");
    // var addToCartBtn = document.getElementById("addToCartBtn");
    var checkForm = document.getElementById("check-form");
    var errorMessage = document.getElementById("error-message");
    var currentQuantity = document.querySelector(" .quantity-input");
    // autoload lại 1 nếu product-quantity = rỗng
    if (currentQuantity.value == "") {
        currentQuantity.value = 1;
    }

    if (chonmau.value === "" || chonsize.value === "") {
        // if(chonmau.value !== "" && chonsize !=="" && soLuongTon < 0){
        // addToCartBtn.disabled = true;
        // document.querySelector(" .quantity-input").disabled = true;
        // }
        checkForm.style.backgroundColor = "#ff00001f";
        // checkForm.style.padding = "12px";
        document.querySelector(" .quantity-input").disabled = true;
        errorMessage.textContent = "Vui lòng chọn Phân loại hàng";
        errorMessage.style.display = "block";
        return false;
    }
    checkForm.style.backgroundColor = "initial";
    document.querySelector(" .quantity-input").disabled = false;
    errorMessage.textContent = "";
    errorMessage.style.display = "none";
    return true;

}
document.getElementById("addToCartBtn").onclick = function() {
    validateForm();
}

function checkSoluong() {

    // Sự kiện input để ngăn nhập giá trị không hợp lệ
    document.addEventListener('input', function(event) {
        var target = event.target;
        var currentQuantity = parseInt(target.value);
        var increaseButton = document.querySelector('.bootstrap-touchspin-up');

        // Kiểm tra nếu là input số lượng
        if (target.classList.contains('quantity-input')) {
            var inputValue = target.value.trim();

            // Kiểm tra xem giá trị nhập liệu có phải là số và là số dương
            if (/[^0-9]/.test(inputValue)) {
                // Nếu có ký tự đặc biệt, loại bỏ chúng
                target.value = inputValue.replace(/[^0-9]/g, '');
            }
            // Kiểm tra xem giá trị có "0" đầu tiên hay không và có chiều dài >= 1
            if (inputValue[0] === '0' && inputValue.length >= 1) {
                // Loại bỏ "0" đầu tiên
                target.value = inputValue.slice(1);
            }

            if (currentQuantity >= soLuongTon) {
                target.value = soLuongTon
                increaseButton.disabled = true;

            } else {
                increaseButton.disabled = false;

            }

            console.log("Số lượng hiện tại:", currentQuantity);
            console.log("Số lượng tồn:", slt);
        }
    });
    // Ẩn button (+) nếu input số lượng  lớn hoặc bằng số lượng tồn
    document.addEventListener('click', function(event) {
        var increaseButton = document.querySelector('.bootstrap-touchspin-up');
        var currentQuantity = document.querySelector(" .quantity-input").value;
        if (parseInt(currentQuantity) >= soLuongTon) {
            increaseButton.disabled = true;
        } else {
            increaseButton.disabled = false;
        }
    });


}
</script>