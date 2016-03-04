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
    </div> <div class="form-group">
        <label class="control-label col-sm-2">Quà tặng</label>
        <div class="col-sm-8">
            <input  name="gift" type="text" value="<%= data.gift %>" class="form-control"  placeholder="Quà tặng"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Kiểu bếp</label>
        <div class="col-sm-8">
            <input  name="type" type="text" class="form-control"  value="<%= data.type %>" placeholder="Kiểu bếp, đôi, hai, ba"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Độ ồn</label>
        <div class="col-sm-8">
            <input  name="noise" type="text" class="form-control"  value="<%= data.noise %>" placeholder="Độ ồn là số"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Công xuất</label>
        <div class="col-sm-8">
            <input  name="power" type="text" class="form-control" value="<%= data.power %>"  placeholder="Công xuất"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Xuất xứ</label>
        <div class="col-sm-8">
            <input  name="origin" type="text" class="form-control" value="<%= data.origin %>" placeholder="Xuất xứ"/>
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
        <label class="control-label col-sm-2">Hãng sản xuất</label>
        <div class="col-sm-8">
            <select class="form-control" name="partnersId"  >
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