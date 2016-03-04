<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Đăng nhập hệ thống</li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">Đăng nhập</div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="login-other">
                <div data-rel="message" class="text-center"></div>
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <a class="other-button btn-facebook" style="cursor: pointer;" data-click="signinface"  onclick="auth.login()"><i class="fa fa-facebook"></i>Facebook</a>
                    </div><!-- col -->
                    <div class="col-sm-6 text-center">
                        <a class="other-button btn-google" style="cursor: pointer;" data-click="signin" onclick="auth.login()"><i class="fa fa-google"></i>Google</a>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- login-other -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>