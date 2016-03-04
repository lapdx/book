<form class="form-horizontal" id="add-banner" style="width: 500px; margin-top: 15px;" >
    <input name="id"  value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control" placeholder="id" style="display: none;"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên banner:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= (typeof data != 'undefined' ?  data.name : '') %>" class="form-control" placeholder="Tên banner"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Vị trí:</label>
        <div class="col-sm-8">
            <input name="position" type="text" value="<%= (typeof data != 'undefined' ?  data.position : '0') %>" class="form-control" placeholder="Vị trí hiển thị"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Liên kết:</label>
        <div class="col-sm-8">
            <input name="link" value="<%= (typeof data != 'undefined' ?  data.link : '') %>" type="text" class="form-control" placeholder="Link"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea name="description" rows="5" class="form-control" placeholder="Mô tả"><%= (typeof data != 'undefined' ?  data.description : '') %></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Kiểu banner:</label>
        <div class="col-sm-8">
            <select class="form-control" name="type" >
                <option value="">----- Chọn -----</option>
                <option value="heart" <%= (typeof data != 'undefined' && data.type == 'heart' ?  'selected' : '') %>>HeartBanner</option>
                <option value="center" <%= (typeof data != 'undefined' && data.type == 'center' ?  'selected' : '') %>>CenterBanner</option>
                <option value="right" <%= (typeof data != 'undefined' && data.type == 'right' ?  'selected' : '') %>>RightBanner</option>
                <option value="left" <%= (typeof data != 'undefined' && data.type == 'left' ?  'selected' : '') %>>LeftBanner</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-4">
            <select name="active" class="form-control">
                <option value="1" <%= (typeof data != 'undefined' && data.active == 1 ?  'selected' : '') %>>Hoạt động</option>
                <option value="0" <%= (typeof data != 'undefined' && data.active == 0 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
    </div>
</form>