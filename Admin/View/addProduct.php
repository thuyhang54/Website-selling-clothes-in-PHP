<div class="main-content">
    <h3 class="title-page">
        Thêm sản phẩm
    </h3>

    <form class="addPro" action="index.php?action=addproduct" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
            </div>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
            <?php
            $menu = new menu();
            $result = $menu->getMenu();
            ?>
            <label for="categories">Danh mục:</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Chọn danh mục</option>
                <?php
                while ($menuItem = $result->fetch()) {
                    $loai = new loaisanpham();
                    $idcon = $loai->getLoaiSanPham($menuItem['idmenu']);
                    while ($subItem = $idcon->fetch()) {
                        echo '<option value="' . $subItem['id_loai'] . '" >' . $subItem['tenloai'] . '</option>';
                    };
                };
                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá gốc:</label>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá gốc">
            </div>
        </div>
        <div class="form-group">
            <label for="price_sale">Giá khuyến mãi:</label>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" name="price_sale" id="price_sale" class="form-control" placeholder="Giá khuyến mãi">
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả ngắn</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Nhập 1 đoạn mô tả ngắn về sản phẩm" style="height: 78px;"></textarea>
        </div>
        <div class="form-group">
            <label>Mô tả chi tiết</label>
            <textarea class="form-control" name="detail" rows="3" placeholder="Nhập 1 đoạn mô tả ngắn về sản phẩm" style="height: 78px;"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    new DataTable('#example');
</script>