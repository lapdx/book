<tr data-key="<%= data.id %>" class="success" >
    <td class="text-center stt" >0</td>
    <td class="text-center" ><%= data.username %></td>
    <td class="text-center" ><%= data.fullname %></td>
    <td class="text-center" ><%= data.phone %></td>
    <td class="text-center" ><%= data.type %></td>
    <td class="text-center" data-id='<%= data.id %>' >
        <label class="label label-<%= data.active==1?'success':'danger' %>" >
            <%= data.active==1?'Hoạt động':'Tạm khóa' %>
        </label>
        <i onclick="user.changeActive('<%= data.id %>');" style="cursor: pointer" class="pull-right glyphicon glyphicon-<%= data.active==1?'check':'unchecked' %>" />
    </td>
    <td>
        <div class="btn-group" style="margin-top: 5px">
            <button onclick="user.edit('<%=data.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
            <button type="button" class="btn btn-success" onclick="user.setRole('<%= data.id %>')" >
                <i class="fa fa-tag"></i>
                Phân quyền
            </button>
            <button onclick="user.remove('<%= data.id %>');" type="button" class="btn btn-danger" style="width: 100px;">
                <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Xóa
            </button>
        </div>
    </td>
</tr>