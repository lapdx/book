<% if(edit == false) { %>                    
<tr data-key="<%= data.id%>">
    <% } %>
    <td class="text-center" style="vertical-align: middle"><%= eval(next) %></td>
    <td class="text-center" style="vertical-align: middle"><%= data.name %></td>
    <td class="text-center" style="vertical-align: middle"><%= data.email %></td>
    <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(data.createTime) %></td>
    <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(data.updateTime) %></td>
    <td>
        <div class="btn-group" style="margin-top: 5px">
            <button onclick="contact.edit('<%=data.id%>')" type="button" class="btn btn-success" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
            <button onclick="contact.detail('<%=data.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Chi tiết</button>
            <button onclick="contact.remove('<%=data.id%>')" type="button" class="btn btn-danger" style="width: 100px;"><span class="glyphicon glyphicon-trash pull-left" style="line-height: 18px"></span> Xóa</button>
        </div>
    </td>
    <% if(edit == false) { %>
</tr>
<% } %>