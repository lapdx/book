<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Danh mục sản phẩm
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#category/grid">Danh sách danh mục sản phẩm</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >ID</th>
                        <th class="text-center" style="vertical-align: middle" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle" >Tên danh mục</th>
                        <th class="text-center" style="vertical-align: middle;width: 140px" >Hiển thị</th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Thứ tự</th>
                        <th class="text-center" style="vertical-align: middle;width: 280px" >
                            Chức năng<i style="cursor: pointer" onclick="category.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody rel-data="bodydata">
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="8" class="text-danger" style="text-align: center">Hiện tại không có bản ghi nào !</td>
                    </tr>
                    <% }else{ %>
                    <% $.each(data, function(index,cat){ %>
                    <% if(cat.parentId == 0){ %>
                    <tr rel-data="<%= cat.id %>">
                        <td class="text-center" style="vertical-align: middle"><%= cat.id %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <% if(cat.images.length > 0){ %>
                            <img src="<%= cat.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td>
                            <p class="title-item">
                                -- <%=cat.name%>
                            </p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= cat.id %>">
                                <%= '<label class="label label-' + (cat.active == 1 ? 'success' : 'danger') + '" >' + (cat.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="category.changeActive(\'' + cat.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (cat.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="text" onchange="category.changePosition('<%= cat.id%>')" rel-data="<%= cat.id %>" class="text-center" value="<%= cat.position %>" size="4">
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="category.edit('<%= cat.id %>')" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>
                                <button onclick="image.addImage('<%= cat.id %>', 'category');" type="button" class="btn btn-success" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" onclick="category.remove('<%= cat.id %>')" >
                                    <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
                                </button>
                                <button onclick="meta.config('category', '<%= cat.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                                    <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
                                </button>
                            </div>
                        </td>
                    </tr>
                    <% $.each(data, function(index,catlv2){ %>
                    <% if(catlv2.parentId == cat.id){ %>
                    <tr rel-data="<%= catlv2.id %>">
                        <td class="text-center" style="vertical-align: middle"><%= catlv2.id %></td>
                        <td class="text-center" style="vertical-align: middle"><img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" /></td>
                        <td>
                            <p class="title-item">
                                -- -- <%= catlv2.name %>
                            </p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= catlv2.id %>">
                                <%= '<label class="label label-' + (catlv2.active == 1 ? 'success' : 'danger') + '" >' + (catlv2.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="category.changeActive(\'' + catlv2.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (catlv2.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="text" onchange="category.changePosition('<%= catlv2.id %>');" rel-data="<%= catlv2.id %>" class="text-center" value="<%= catlv2.position %>" size="4">
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="category.edit('<%= catlv2.id %>')" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>
                                <button disabled onclick="" type="button" class="btn btn-success" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" onclick="category.remove('<%= catlv2.id %>')" >
                                    <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
                                </button>
                                <button onclick="meta.config('category', '<%= catlv2.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                                    <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
                                </button>
                            </div>
                        </td>
                    </tr>
                    <% } %>
                    <%  }); %>
                    <% } %>
                    <%  }); %>
                    <% } %>
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->