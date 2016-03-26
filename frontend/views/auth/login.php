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
                <form class="b-loginForm " name="loginForm">
                   <?=Alert::widget([
                       'options' => ['class' => 'alert-info'],
                       'body' => Yii::$app->session->getFlash('danger'),
                       ])?>
                       <div class="form-group">
                        <div class="b-input-group">
                            <input required type="text" class="form-control" placeholder="Tên đăng nhập">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="b-input-group">
                            <input required type="password" class="form-control" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="keep-me">
                        <label for="keep-me">Duy trì đăng nhập</label>
                    </div>
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