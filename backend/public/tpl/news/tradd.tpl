<tr rel-data="<%= data.id %>" class="success">
    <td class="text-center" style="vertical-align: middle">
        <p>0</p>
        <hr/>
        <i class="glyphicon glyphicon-trash icon-remove" onclick="news.remove('<%= data.id %>');"></i>
    </td>
    <td class="text-center" style="vertical-align: middle"><%= data.id %></td>
    <td class="text-center" style="vertical-align: middle">
        <img style="max-width:60px; margin:auto;" src="<%= baseUrl %>images/no_avatar.png"   class="thumbnail" />
    </td>
    <td class="text-center" style="vertical-align: middle"><%= data.name %></td>
    <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(data.createTime) %></td>
    <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(data.updateTime) %></td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-nav="<%= data.id %>">
            <%= '<label class="label label-' + (data.home == 1 ? 'success' : 'danger') + '" >' + (data.home == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeHome(\'' + data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (data.home == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= data.id %>">
            <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-footer="<%= data.id %>">
            <%= '<label class="label label-' + (data.footer == 1 ? 'success' : 'danger') + '" >' + (data.footer == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label>' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div class="btn-group">
            <button type="button" class="btn btn-warning" onclick="news.edit('<%= data.id %>');" >
                <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
            </button>
            <button onclick="image.addImage('<%= data.id %>', 'news');" type="button" class="btn btn-success" style="width: 100px;">
                <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
            </button>
            <button onclick="meta.config('news', '<%= data.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
            </button>
        </div>
    </td>
</tr>