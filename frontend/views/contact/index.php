<?php 
$home = isset($this->context->var["home"]) ? $this->context->var["home"] : '';
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Liên hệ</li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">Thông tin liên hệ</div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contact-text">
                        <div class="maincontent">
                            <h5><b>Chi nhánh Hà Nội 1</b></h5>
                            <p>Địa chỉ: <?= $home->address1 ?></p>
                            <p>Tel: <?= $home->tel1 ?></p>
                            <p><?= $home->description1 ?></p>
                            <br />
                            <h5><b>Chi nhánh Hà Nội 2</b></h5>
                            <p>Địa chỉ: <?= $home->address2 ?></p>
                            <p>Tel : <?= $home->tel2 ?></p>
                            <p><?= $home->description2 ?></p>
                        </div><!-- maincontent -->
                    </div><!-- contact-text -->
                </div><!-- col -->
                <div class="col-sm-6">
                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7404203468463!2d105.852487!3d21.00304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac74cace94c5%3A0xa923db903f7c2163!2zMjYzIFRoYW5oIE5ow6BuLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1430127286949" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                    </div><!-- contact-map -->
                </div><!-- col -->
            </div><!-- row -->
        </div>
        <div class="box-title">
            <div class="lb-name">Liên hệ với chúng tôi</div>
        </div><!-- box-title -->
        <div class="box-content">
            <form id="form-contacts">
                <div class="contact-form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Họ và tên <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="name" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Số điện thoại <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="phone" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa chỉ <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="address" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Email <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="email" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nội dung cần liên hệ <span class="text-danger">(*)</span></label>
                        <div class="col-sm-9">
                            <textarea name="content" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" onclick="contact.save()" class="btn btn-primary">Gửi đi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->