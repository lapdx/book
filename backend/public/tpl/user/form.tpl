<form class="form-horizontal" id="add-user" style="width: 500px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Tài khoản:</label>
        <div class="col-sm-8">
            <input name="username" type="text" value="<%= (typeof data != 'undefined' ?  data.username : '') %>" class="form-control" placeholder="Tài khoản"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mật khẩu:</label>
        <div class="col-sm-8">
            <input name="password"  value="" type="password" class="form-control" placeholder="Mật khẩu"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Nhập lại mật khẩu:</label>
        <div class="col-sm-8">
            <input name="repassword"  value="" type="password" class="form-control" placeholder="Nhập lại mật khẩu"/>
        </div>
    </div>
    <input name="id"  value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control" placeholder="id" style="display: none;"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên:</label>
        <div class="col-sm-8">
            <input name="fullname" type="text" value="<%= (typeof data != 'undefined' ?  data.fullname : '') %>" class="form-control" placeholder="Họ tên"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Email:</label>
        <div class="col-sm-8">
            <input name="email" type="text" value="<%= (typeof data != 'undefined' ?  data.email : '') %>" class="form-control" placeholder="Email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">SĐT:</label>
        <div class="col-sm-8">
            <input name="phone" type="text" value="<%= (typeof data != 'undefined' ?  data.phone : '') %>" class="form-control" placeholder="SĐT"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Loại:</label>
        <div class="col-sm-4">
            <select name="type" class="form-control">
                <option value="admin" <%= (typeof data != 'undefined' && data.type == 'admin' ?  'selected' : '') %>>Admin</option>
                <option value="customer" <%= (typeof data != 'undefined' && data.type == 'customer' ?  'selected' : '') %>>Customer</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-4">
            <select name="active" class="form-control">
                <option value="1" <%= (typeof data != 'undefined' && data.active == 1 ?  'selected' : '') %>>Hiển thị</option>
                <option value="0" <%= (typeof data != 'undefined' && data.active == 0 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
    </div>
</form>