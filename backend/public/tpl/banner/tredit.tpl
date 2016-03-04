<td class="text-center" style="vertical-align: middle">
    <p><%= data.index %></p>
    <hr/>
    <i class="glyphicon glyphicon-trash icon-remove" onclick="banner.remove('<%= data.id %>');"></i>
</td>
<td class="text-center" style="vertical-align: middle;width: 80px" ><%= data.id %></td>
<td class="text-center" style="vertical-align: middle;width: 80px" >
    <img src="<%= baseUrl %>images/no_avatar.png"  style="max-width:60px; margin:auto;"  class="thumbnail" />
</td>
<td class="text-center" style="vertical-align: middle; text-align: justify;">
    Tên Banner : <%= data.name %><br/>
    <% 
    var type = '';
    switch(data.type){
    case 'left' :
    type = 'LeftBanner';
    break;
    case 'right' :
    type = 'RightBanner';
    break;
    case 'heart' :
    type = 'HeartBanner';
    break;
    case 'center' :
    type = 'CenterBanner';
    break;
    } 
    %>
    Kiểu Banner : <%= type %><br/>
    Link Banner : <a href="<%= data.link %>" target="_blank"><%= data.link %></a><br/>
    Mô tả : <%= data.description %><br/>
</td>
<td class="text-center" style="vertical-align: middle;" >
    <div data-key-active="<%= data.id %>">
        <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="banner.changeActive(\'' + data.id + '\')" style="cursor: pointer; margin-left: 5px;" class="glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
    </div>
</td>
<td>
    <div class="btn-group" style=" margin-left: 23px;">
        <button onclick="banner.edit('<%=data.id%>')" type="button" class="btn btn-primary" style="width: 80px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
        <button onclick="image.addImage('<%= data.id %>', 'banner');" type="button" class="btn btn-success" style="width: 80px;"><span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh</button>
    </div>
</td>