<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Sản phẩm nổi bật
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#hotdealbox/grid">Danh sách  sản phẩm nổi bật</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >Mã sản phẩm</th>
                        <th class="text-center" style="vertical-align: middle;" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle;width: 500px" >Thông tin sản phẩm</th>
                        <th class="text-center" style="vertical-align: middle;" >Trạng thái<i class="glyphicon glyphicon-edit pull-right"></i></th>
                        <th class="text-center" style="vertical-align: middle;" >Loại<i class="glyphicon glyphicon-edit pull-right"></i></th>
                        <th class="text-center" style="vertical-align: middle;width: 160px" > 
                            Chức năng<i style="cursor: pointer" onclick="hotdealbox.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <% if (data.length <= 0 ){ %>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-danger" style="text-align: center">Không tìm thấy sản phẩm nào!</td>
                    </tr>
                </tbody>
                <% }else{ %>
                <tbody rel-data='body-data'>
                    <% $.each(data, function(index){ %>
                    <tr data-key="<%= this.id %>">
                        <% if(this.item != null){ %>
                        <td class="text-center" style="vertical-align: middle"><%= this.itemId %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <% if(this.item.images.length > 0){ %>
                            <img src="<%= this.item.images[0] %>" style="width:80px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:80px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <p>Tên sản phẩm:<b> <a href="#"><%= this.item.name %></a> </b></p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="hotdealbox.changeActive(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-type="<%= this.id %>">
                                <%= '<label class="label label-' + (this.type == 'selling' ? 'success' : 'danger') + '" >' + (this.type =='selling' ? 'Bán chạy' : 'Nổi bật') + '</label><i onclick="hotdealbox.changeType(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-check"/>' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <button type="button" class="btn btn-danger" onclick="hotdealbox.remove('<%= this.id %>')">
                                <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i> Xóa
                            </button>
                        </td>
                        <% }else{ %>
                        <td class="text-center" style="vertical-align: middle"><%= this.itemId %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:80px; margin:auto;"  class="thumbnail" />
                        </td>
                        <td class="text-center" colspan="3" style="vertical-align: middle; color: red">Sản phẩm của box không tồn tại!</td>
                        <td class="text-center" style="vertical-align: middle">
                            <button type="button" class="btn btn-danger" onclick="hotdealbox.remove('<%= this.id %>')">
                                <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i> Xóa
                            </button>
                        </td>
                        <% } %>
                    </tr>
                    <% }); %>
                </tbody>
                <% } %>
            </table>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

