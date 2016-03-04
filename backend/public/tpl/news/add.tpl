<form class="form-horizontal" id="add-news" style="width: 800px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Tên tin tức:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= (typeof data != 'undefined' ?  data.name : '') %>" class="form-control" onkeydown="textUtils.drawAlias(this)" onkeypress="textUtils.drawAlias(this)" onkeyup="textUtils.drawAlias(this)" placeholder="Tên tin tức"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Alias:</label>
        <div class="col-sm-8">
            <input name="alias" data-alias=alias value="<%= (typeof data != 'undefined' ?  data.alias : '') %>" type="text" class="form-control" placeholder="Alias"/>
        </div>
    </div>
    <input name="id"  value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control" placeholder="id" style="display: none;"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Danh sách danh mục:</label>
        <div class="col-sm-8">
            <select class="form-control" name="categoryId">
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
    <div class="form-group">
        <label class="control-label col-sm-4">Hiển thị trang chủ:</label>
        <div class="col-sm-4">
            <select name="home" class="form-control">
                <option value="1" <%= (typeof data != 'undefined' && data.home == 1 ?  'selected' : '') %>>Hiển thị</option>
                <option value="0" <%= (typeof data != 'undefined' && data.home != 1 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Hiển thị footer:</label>
        <div class="col-sm-4">
            <select name="footer" class="form-control">
                <option value="1" <%= (typeof data != 'undefined' && data.footer == 1 ?  'selected' : '') %>>Hiển thị</option>
                <option value="0" <%= (typeof data != 'undefined' && data.footer != 1 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-4">
            <textarea name="description" class="form-control" style="height: 50px; margin: auto" ><%= typeof data != 'undefined'?data.description:'' %></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Nội dung:</label>

    </div>
    <div class="form-group">
        <div style="margin-left: 125px;">
            <textarea name="detail" id="detail" class="form-control" style="height: 50px; margin: auto" ><%= typeof data != 'undefined'?data.detail:'' %></textarea>
        </div>
    </div>
</form>