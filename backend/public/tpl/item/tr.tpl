<% if(edit == false) { %>                    
<tr data-key="<%= data.id%>" class="success">
    <% } %>
    <td class="text-center" style="vertical-align: middle"><p><%= data.id %></p><hr/>
        <i class="glyphicon glyphicon-trash icon-remove" onclick="item.remove('<%= data.id %>');"></i></td>
    <td class="text-center" style="vertical-align: middle">
        <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"   class="thumbnail" />
    </td>
    <td class="text-center" style="vertical-align: middle"><%= data.name %></td>
    <td class="text-center" style="vertical-align: middle"><%= eval(data.sellPrice).toMoney() %> đ</td>
    <td class="text-center" style="vertical-align: middle"><%= eval(data.startPrice).toMoney() %> đ</td>
    <td>
        <div data-key="<%= data.id %>">
            <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="item.changeActive(\'' + data.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td>
        <div class="btn-group" style="margin-top: 5px">
            <button onclick="item.edit('<%=data.id%>')" type="button" class="btn btn-success" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
            <button onclick="item.content('<%=data.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-list-alt pull-left" style="line-height: 18px"></span> Nội dung</button>
        </div>
        <div class="btn-group" style="margin-top: 5px">
            <button onclick="image.addImage('<%= data.id %>', 'item');" type="button" class="btn btn-info" style="width: 100px;">
                <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
            </button>
            <button onclick="meta.config('item', '<%= data.id %>');" type="button" class="btn btn-success" style="width: 100px;">
                <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
            </button>
        </div>
    </td>
    <% if(edit == false) { %>
</tr>
<% } %>