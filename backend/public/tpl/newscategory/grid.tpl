<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Danh mục tin tức
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#newscategory/grid">Danh sách danh mục tin tức</a></li>
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
                        <th class="text-center" style="vertical-align: middle" >Tên danh mục</th>
                        <th class="text-center" style="vertical-align: middle;width: 140px" >Hiển thị</th>
                        <th class="text-center" style="vertical-align: middle;width: 140px" >Menu</th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Thứ tự</th>
                        <th class="text-center" style="vertical-align: middle;width: 280px" >
                            Chức năng<i style="cursor: pointer" onclick="newscategory.add();" class="pull-right glyphicon glyphicon-plus">
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
                        <td>
                            <p class="title-item">
                                -- <%=cat.name%>
                            </p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= cat.id %>">
                                <%= '<label class="label label-' + (cat.active == 1 ? 'success' : 'danger') + '" >' + (cat.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeActive(\'' + cat.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (cat.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-menu="<%= cat.id %>">
                                <%= '<label class="label label-' + (cat.menu == 1 ? 'success' : 'danger') + '" >' + (cat.menu == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeMenu(\'' + cat.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (cat.menu == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="text" onchange="newscategory.changePosition('<%= cat.id%>')" rel-data="<%= cat.id %>" class="text-center" value="<%= cat.position %>" size="4">
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="newscategory.edit('<%= cat.id %>')" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>

                                <button type="button" class="btn btn-danger" onclick="newscategory.remove('<%= cat.id %>')" >
                                    <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
                                </button>
                                <button onclick="meta.config('newscategory', '<%= cat.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                                    <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
                                </button>
                            </div>
                        </td>
                    </tr>
                    <% $.each(data, function(index,catlv2){ %>
                    <% if(catlv2.parentId == cat.id){ %>
                    <tr rel-data="<%= catlv2.id %>">
                        <td class="text-center" style="vertical-align: middle"><%= catlv2.id %></td>
                        <td>
                            <p class="title-item">
                                -- -- <%= catlv2.name %>
                            </p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= catlv2.id %>">
                                <%= '<label class="label label-' + (catlv2.active == 1 ? 'success' : 'danger') + '" >' + (catlv2.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeActive(\'' + catlv2.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (catlv2.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-menu="<%= catlv2.id %>">
                                <%= '<label class="label label-' + (catlv2.menu == 1 ? 'success' : 'danger') + '" >' + (catlv2.menu == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeMenu(\'' + catlv2.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (catlv2.menu == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="text" onchange="newscategory.changePosition('<%= catlv2.id %>');" rel-data="<%= catlv2.id %>" class="text-center" value="<%= catlv2.position %>" size="4">
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="newscategory.edit('<%= catlv2.id %>')" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>
                                <button type="button" class="btn btn-danger" onclick="newscategory.remove('<%= catlv2.id %>')" >
                                    <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
                                </button>
                                <button onclick="meta.config('newscategory', '<%= catlv2.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
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