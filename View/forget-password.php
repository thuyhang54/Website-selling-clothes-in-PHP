

<section class="forget-password-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
            <img src="images/logo.png" alt="">
          </a>
          <h2 class="text-center">Chào mừng trở lại</h2>
          <form method="post" action ="index.php?action=forget&act=forget_action" class="text-left clearfix">
            <p>Vui lòng nhập địa chỉ email cho tài khoản của bạn. Một mã xác minh sẽ được gửi đến bạn. Khi bạn đã nhận được mã xác minh, bạn sẽ có thể chọn mật khẩu mới cho tài khoản của mình.</p>
            <div class="form-group">
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ email của bạn">
            </div>
            <div class="text-center">
              <button type="submit" name="submit_email" class="btn btn-main text-center">Gửi yêu cầu đặt lại mật khẩu</button>
            </div>
          </form>
          <p class="mt-20">	<a href="index.php?action=dangnhap" >Quay về trang đăng nhập</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
