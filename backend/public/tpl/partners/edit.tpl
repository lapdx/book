<form class="form-horizontal" id="form-edit" style="margin: 20px;" >
    <div class="form-group">
        <input  name="id" type="hidden" value="<%= data.id %>" class="form-control"  placeholder="Mã "/>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Tên đối tác</label>
        <div class="col-sm-5">
            <input  name="name" type="text" value="<%= data.name %>" class="form-control"  placeholder="Tên đối tác"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Website</label>
        <div class="col-sm-5">
            <input  name="website" type="text" value="<%= data.website %>" class="form-control"  placeholder="Website"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Email</label>
        <div class="col-sm-5">
            <input  name="email" type="text" value="<%= data.email %>" class="form-control"  placeholder="Email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">SĐT</label>
        <div class="col-sm-5">
            <input  name="phone" type="text" value="<%= data.phone %>" class="form-control"  placeholder="SĐT"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Thứ tự</label>
        <div class="col-sm-5">
            <input name="position" type="text" class="form-control" value="<%= data.position %>"  placeholder="Vị trí hiển thị"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Trạng thái</label>
        <div class="col-sm-5">
            <select class="form-control" name="active"  >
                <option <%= data.active == 1?'selected':'' %> value="1">Hoạt động</option>
                <option <%= data.active != 1?'selected':'' %> value="2">Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5">Trạng chủ</label>
        <div class="col-sm-5">
            <select class="form-control" name="home"  >
                <option <%= data.home == 1?'selected':'' %> value="1">Hiển thị</option>
                <option <%= data.home != 1?'selected':'' %> value="2">Tạm khóa</option>
            </select>
        </div>
    </div>
</form>