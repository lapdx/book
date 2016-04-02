<?php
use yii\bootstrap\Alert;
?>

<div class="product_content">
    <div class="container">
        <nav class="b-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="#!" class="breadcrumb">Trang chủ</a>
                    <a href="#!" class="breadcrumb">Đăng nhập</a>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="login-b-content col s6 m6 l6">
                <h3 class="b-login-title text-center">Đăng nhập tài khoản BookStore</h3>
                <form class="b-loginForm " name="loginForm" method="POST">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <?php
                    if(Yii::$app->session->hasFlash('danger'))
                        echo Alert::widget([
                            'options' => ['class' => 'alert-danger'],
                            'body' => Yii::$app->session->getFlash('danger'),
                            ])
                            ?>
                            <div class="form-group">
                                <div class="b-input-group">
                                    <input name="username" id="no-space" pattern=".{6,}" required title="Tên đăng nhập phải có ít nhất 6 ký tự" type="text" class="form-control" placeholder="Tên đăng nhập" value="<?=$username?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="b-input-group">
                                    <input name="pwd" id="no-space" pattern=".{6,}" required title="Mật khẩu phải có ít nhất 6 ký tự" type="password" class="form-control" placeholder="Mật khẩu">
                                </div>
                            </div>
                    <!-- <div class="checkbox">
                        <input type="checkbox" id="keep-me">
                        <label for="keep-me">Duy trì đăng nhập</label>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn-login b-btn-login waves-effect waves-light">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('input#no-space').keyup(function() {
            str = $(this).val();
            str = str.replace(/\s/g,'');
            $(this).val(str);
        });
    })

</script>