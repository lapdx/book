<!-- <div class="container">
    <div class="dashboard">
        <div class="box-login">
            <div class="login-circle"><span class="icon-user"></span><span class="shadow2"></span></div>
            <div class="shadow1"></div>
            <div class="bl-title">Hoa Lửa</div>
            <div class="gmail-login">
                <a style="cursor: pointer" data-click="signin">
                    <span class="icon-gmail"></span> 
                    Đăng nhập hệ thống Hoa Lửa
                </a>
            </div>
            <div class="shadow"></div>
        </div>
        <div data-rel="message" ></div>
    </div>
</div>
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
-->
<style type="text/css">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
  }

  .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
  }
  .form-signin .form-signin-heading,
  .form-signin .checkbox {
      margin-bottom: 10px;
  }
  .form-signin .checkbox {
      font-weight: normal;
  }
  .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
  }
  .form-signin .form-control:focus {
      z-index: 2;
  }
  .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
  }
  .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
  }
  .btn {
    font-size: 18px;
    padding: 10px 16px;
}
</style>

<div class="container">

  <form class="form-signin">
    <h2 class="form-signin-heading">Đăng nhập hệ thống</h2>
    <label for="inputEmail" class="sr-only">Tên đăng nhập</label>
    <input name="username" type="text" id="username" class="form-control" placeholder="User name">
    <label for="inputPassword" class="sr-only">Mật khẩu</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Password">
    <p class="text-danger" id="error"></p>
    <button data-click="signin" class="btn btn-lg btn-primary btn-block" type="button">Đăng nhập</button>
</form>

</div> <!-- /container -->
