<tr data-key="<%= this.id %>">
    <td class="text-center" style="vertical-align: middle"><%= this.itemId %></td>
    <td class="text-center" style="vertical-align: middle">
        <img src="<%= baseUrl %>images/no_avatar.png"  style="max-width:80px; margin:auto;"  class="thumbnail" />
    </td>
    <td class="text-center" style="vertical-align: middle">
         <p>Thông tin sản phẩm đang đc cập nhật,nhấn f5 lại để xem!</p>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= this.id %>">
            <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="hotdealbox.changeActive(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= this.id %>">
            <%= '<label class="label label-' + (this.type == 'selling' ? 'success' : 'danger') + '" >' + (this.type =='selling' ? 'Bán chạy' : 'Nổi bật') + '</label><i onclick="hotdealbox.changeType(\'' + this.id + '\')" style="cursor: pointer"/>' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <button type="button" class="btn btn-danger" onclick="hotdealbox.remove('<%= this.id %>')">
            <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i> Xóa
        </button>
    </td>
</tr>