<form class="form-horizontal" id="add-category" style="width: 500px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Tên danh mục:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= (typeof data != 'undefined' ?  data.name : '') %>" class="form-control" onkeydown="textUtils.drawAlias(this)" onkeypress="textUtils.drawAlias(this)" onkeyup="textUtils.drawAlias(this)" placeholder="Tên danh mục"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Alias:</label>
        <div class="col-sm-8">
            <input name="alias" data-alias=alias value="<%= (typeof data != 'undefined' ?  data.alias : '') %>" type="text" class="form-control" placeholder="Alias"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Danh mục gốc:</label>
        <div class="col-sm-8">
            <select class="form-control" name="parentId">
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
    <div class="form-group">
        <label class="control-label col-sm-4">Thứ tự:</label>
        <div class="col-sm-8">
            <input name="position" type="text" class="form-control" value="<%= typeof data != 'undefined'?data.position:0 %>"/>
            <input name="id" type="text" class="form-control" value="<%= (typeof data != 'undefined' ? data.id : '')%>" style="display: none"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea name="description" type="text"class="form-control" ><%= (typeof data != 'undefined' ?  data.description : '') %></textarea>
        </div>
    </div>
</form>