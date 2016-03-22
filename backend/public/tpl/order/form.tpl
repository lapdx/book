<form class="form-horizontal" id="add-news" style="margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-4">
            <select id="status" name="status" class="form-control">
                <option value="unpaid" <%= (typeof data != 'undefined' && data.status == 'unpaid' ?  'selected' : '') %>>Chưa thanh toán</option>
                <option value="paid" <%= (typeof data != 'undefined' && data.status == 'paid' ?  'selected' : '') %>>Đã thanh toán</option>
                <option value="cancel" <%= (typeof data != 'undefined' && data.status == 'cancel' ?  'selected' : '') %>>Hủy đơn hàng</option>
            </select>
        </div>
    </div>
</form>