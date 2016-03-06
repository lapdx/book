<form class="form-horizontal" id="form-edit" style="margin: 20px;" >
    <div class="form-group">
        <input  name="id" type="hidden" value="<%= data.id %>" class="form-control"  placeholder="Mã item"/>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Tên item</label>
        <div class="col-sm-8">
            <input  name="name" type="text" value="<%= data.name %>" class="form-control"  placeholder="Tên item"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Tác giả</label>
        <div class="col-sm-8">
            <input  name="author" type="text" value="<%= data.author %>" class="form-control"  placeholder="Tác giả"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Giá bán</label>
        <div class="col-sm-8">
            <input  name="sellPrice" type="text" value="<%= data.sellPrice %>" class="form-control"  placeholder="Giá bán"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Giá gốc</label>
        <div class="col-sm-8">
            <input  name="startPrice" type="text" value="<%= data.startPrice %>" class="form-control"  placeholder="Giá gốc"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Danh mục</label>
        <div class="col-sm-8">
            <select class="form-control" name="categoryId"  >
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Trạng thái</label>
        <div class="col-sm-8">
            <select class="form-control" name="active"  >
                <option <%= data.active == 1?'selected':'' %> value="1">Hoạt động</option>
                <option <%= data.active != 1?'selected':'' %> value="2">Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Mô tả:</label>
        <div class="col-sm-8">
            <textarea id="description" name="description" cols="20" rows="5" class="form-control"><%= data.description %></textarea>
        </div>
    </div>
</form>