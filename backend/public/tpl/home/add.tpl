<form class="form-horizontal" id="form-contact" style="width: 500px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">ĐT tư vấn:</label>
        <div class="col-sm-8">
            <input name="phoneconsult" type="text" value="<%= (typeof data != 'undefined' ?  data.phoneconsult: '') %>" class="form-control" placeholder="Điện thoại tư vấn"/>
        </div>
    </div>
    <input name="id" type="hidden" value="<%= (typeof data != 'undefined' ?  data.id : '') %>" class="form-control" placeholder="ID"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Điện thoại chăm sóc:</label>
        <div class="col-sm-8">
            <input name="phonecare" type="text" value="<%= (typeof data != 'undefined' ?  data.phonecare: '') %>" class="form-control" placeholder="Điện thoại chăm sóc"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Thời gian bán hàng:</label>
        <div class="col-sm-8">
            <input name="time" type="text" value="<%= (typeof data != 'undefined' ?  data.time: '') %>" class="form-control" placeholder="Thời gian bán hàng"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Địa chỉ HN1:</label>
        <div class="col-sm-8">
            <input name="address1" type="text" value="<%= (typeof data != 'undefined' ?  data.address1: '') %>" class="form-control" placeholder="Địa chỉ HN1"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Telephone HN1:</label>
        <div class="col-sm-8">
            <input name="tel1" type="text" value="<%= (typeof data != 'undefined' ?  data.tel1: '') %>" class="form-control" placeholder="Telephone HN1"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Ghi chú HN1:</label>
        <div class="col-sm-8">
            <input name="description1" type="text" value="<%= (typeof data != 'undefined' ?  data.description1: '') %>" class="form-control" placeholder="Ghi chú HN1"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Địa chỉ HN2:</label>
        <div class="col-sm-8">
            <input name="address2" type="text" value="<%= (typeof data != 'undefined' ?  data.address2: '') %>" class="form-control" placeholder="Địa chỉ HN2"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Telephone HN1:</label>
        <div class="col-sm-8">
            <input name="tel2" type="text" value="<%= (typeof data != 'undefined' ?  data.tel2: '') %>" class="form-control" placeholder="Telephone HN2"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Ghi chú HN2:</label>
        <div class="col-sm-8">
            <input name="description2" type="text" value="<%= (typeof data != 'undefined' ?  data.description2: '') %>" class="form-control" placeholder="Ghi chú HN2"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Địa chỉ TPHCM:</label>
        <div class="col-sm-8">
            <input name="address3" type="text" value="<%= (typeof data != 'undefined' ?  data.address3: '') %>" class="form-control" placeholder="Địa chỉ TPHCM"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Telephone TPHCM:</label>
        <div class="col-sm-8">
            <input name="tel3" type="text" value="<%= (typeof data != 'undefined' ?  data.tel3: '') %>" class="form-control" placeholder="Telephone TPHCM"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Ghi chú TPHCM:</label>
        <div class="col-sm-8">
            <input name="description3" type="text" value="<%= (typeof data != 'undefined' ?  data.description3: '') %>" class="form-control" placeholder="Ghi chú TPHCM"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Facebook:</label>
        <div class="col-sm-8">
            <input name="facebook" type="text" value="<%= (typeof data != 'undefined' ?  data.facebook: '') %>" class="form-control" placeholder="facebook"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Youtube:</label>
        <div class="col-sm-8">
            <input name="youtube" type="text" value="<%= (typeof data != 'undefined' ?  data.youtube: '') %>" class="form-control" placeholder="youtube"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Twitter:</label>
        <div class="col-sm-8">
            <input name="twitter" type="text" value="<%= (typeof data != 'undefined' ?  data.twitter: '') %>" class="form-control" placeholder="twitter"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Google:</label>
        <div class="col-sm-8">
            <input name="google" type="text" value="<%= (typeof data != 'undefined' ?  data.google: '') %>" class="form-control" placeholder="Google plus"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Skype:</label>
        <div class="col-sm-8">
            <input name="skype" type="text" value="<%= (typeof data != 'undefined' ?  data.skype: '') %>" class="form-control" placeholder="Tài khoản skype"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Email:</label>
        <div class="col-sm-8">
            <input name="email" type="text" value="<%= (typeof data != 'undefined' ?  data.email: '') %>" class="form-control" placeholder="Email"/>
        </div>
    </div>
</form>