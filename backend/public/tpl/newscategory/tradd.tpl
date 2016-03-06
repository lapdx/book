<tr rel-data="<%= data.id %>" class="success">
    <td class="text-center" style="vertical-align: middle"><%= data.id %></td>
    <td>
        <p class="title-item">
            <%= data.parentId == 0 ? '-- ' + data.name :'-- -- ' + data.name %>
        </p>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= data.id %>">
            <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeActive(\'' + data.id + '\')" style="cursor: pointer; margin-left: 5px;" class="glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <input type="text" onchange="newscategory.changePosition('<%= data.id %>');" rel-data="<%= data.id %>" class="text-center" value="<%= data.position %>" size="4">
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div class="btn-group">
            <button type="button" class="btn btn-warning" onclick="newscategory.edit('<%= data.id %>')" >
                <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
            </button>
            <button type="button" class="btn btn-danger" onclick="newscategory.remove('<%= data.id %>')" >
                <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
            </button>
            <button onclick="meta.config('newscategory', '<%= data.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
            </button>
        </div>
    </td>
</tr>