
<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
            <img src="Content/images/logo.png" alt="">
          </a>
          <h2 class="text-center">Tạo tài khoản của bạn</h2>
          <form  method="post" class="text-left clearfix" action="index.php?action=dangky&act=dangky_action">
            <div class="form-group">
              <input type="text" class="form-control" name="txttenkh"  placeholder="Nhập vào họ tên">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="txtusername" placeholder="Nhập vào tên người dùng">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="txtemail"  placeholder=" Nhập vào Email">
            </div>
            <div class="form-group">
            <input class="form-control" name="txtdiachi" placeholder="Địa chỉ khách hàng" required="" autofocus="" type="text"> 
            </div>
            <div class="form-group">
            <input class="form-control" name="txtsodt" placeholder="Số điện thoại khách hàng" required="" autofocus="" type="text">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="txtpass"  placeholder="Nhập vào mật khẩu">
            </div>
            <div class="form-group">
               <input class="form-control" name="retypepassword" placeholder="Nhập lại mật khẩu" type="password"> 
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center" name="submit" value="submit">Đăng ký</button>
            </div>
          </form>
          <p class="mt-20">Bạn đã có tài khoản ?<a href="login.html"> Đăng nhập</a></p>
          <p><a href="forget-password.html"> Quên mật khẩu?</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
