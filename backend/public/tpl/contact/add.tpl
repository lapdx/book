<form class="form-horizontal" id="form-contact" style="width: 500px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Tên:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= (typeof data != 'undefined' ?  data.name: '') %>" class="form-control" placeholder="Tên"/>
        </div>
    </div>
    <input name="id" type="hidden" value="<%= (typeof data != 'undefined' ?  data.id : '') %>" class="form-control" placeholder="ID"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Email:</label>
        <div class="col-sm-8">
            <input name="email" type="text" value="<%= (typeof data != 'undefined' ?  data.email: '') %>" class="form-control" placeholder="Email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">SĐT:</label>
        <div class="col-sm-8">
            <input name="phone" type="text" value="<%= (typeof data != 'undefined' ?  data.phone: '') %>" class="form-control" placeholder="Số điện thoại"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Địa chỉ:</label>
        <div class="col-sm-8">
            <input name="address" type="text" value="<%= (typeof data != 'undefined' ?  data.address: '') %>" class="form-control" placeholder="Địa chỉ"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Thông điệp:</label>
        <div class="col-sm-8">
            <textarea rows="5" name="content" type="text"class="form-control" ><%= (typeof data != 'undefined' ?  data.content: '') %></textarea>
        </div>
    </div>
</form>