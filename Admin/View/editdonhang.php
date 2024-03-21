<?php
if (isset ($_GET['id'])) {
    $mahd = $_GET['id'];
    // truy vấn thông tin của id
    $hh = new donhang();
    $kq = $hh->getdonhangID($mahd);
    $tenkh = $kq['tenkh'];
    $ttrang = $kq['status'];
}
?>

<div class="card mt-3 mx-auto ">
    <div class="card-header info">
        ĐƠN HÀNG
    </div>

    <form action="index.php?action=donhang&act=update_action" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="">Mã hóa đơn</label>
                <input type="text" readonly name="id" value="<?php if (isset ($mahd))
                    echo $mahd; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Tên khách hàng</label>
                <input type="text" name="tenkh" value="<?php if (isset ($tenkh))
                    echo $tenkh; ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Tình trạng</label>
                <select name="tinhtrang" class="form-control" style="width:150px;">
                    <?php
                    $selecttrang = -1;
                    if (isset ($ttrang) && $ttrang != -1) {
                        $selecttrang = $ttrang; //6
                    }
                    $dh = new donhang();
                    $result = $dh->gettinhtrangAll();
                    while ($set = $result->fetch()):
                        ?>
                        <option value="<?php echo $set['matt']; ?>" <?php if ($selecttrang == $set['matt'])
                               echo 'selected'; ?>>
                            <?php echo $set['tentt']; ?>
                        </option>
                        <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>