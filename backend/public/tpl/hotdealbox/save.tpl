<form class="form-horizontal" id="form-save" style="width: 500px; margin-top: 15px;" >
    <input name="id" type="hidden" value="<%= typeof data != 'undefined'?data.id:'' %>" />
    <div class="form-group">
        <label class="control-label col-sm-4">Mã sản phẩm:</label>
        <div class="col-sm-8">
            <input name="itemId" type="text" value="<%= typeof data != 'undefined'?data.itemId:'' %>" class="form-control" placeholder="Mã sản phẩm"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Loại</label>
        <div class="col-sm-8">
            <select class="form-control" name="type"  >
                <option <%= typeof data != 'undefined'&&data.type == 'selling'?'selected':'' %> value="selling">Bán chạy</option>
                <option <%= typeof data != 'undefined' && data.type != 'selling'?'selected':'' %> value="hot">Nổi bật</option>
            </select>
        </div>
    </div>
</form>