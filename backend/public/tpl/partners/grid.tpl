<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Partners
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#partners/grid">Danh sách đối tác</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#partners/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="name" name="name" type="text" class="form-control" placeholder="Tên đối tác">
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="active" data-search="active"  >
                        <option value="0" >Trạng thái</option>
                        <option value="1" >Hoạt động</option>
                        <option value="2" >Tạm khóa</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="home" data-search="home"  >
                        <option value="0" >Trang chủ</option>
                        <option value="1" >Hoạt động</option>
                        <option value="2" >Tạm khóa</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-3">
                    <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span>Tìm kiếm
                    </button>
                    <button onclick="viewUtils.btnReset('search');" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-refresh"></span>Làm lại
                    </button>
                </div><!-- /col -->
            </form><!-- /form -->
        </div>
        <%= viewUtils.dataPage(data, [])  %>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >STT</th>
                        <th class="text-center" style="vertical-align: middle" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle" >Tên</th>
                        <th class="text-center" style="vertical-align: middle" >Website</th>
                        <th class="text-center" style="vertical-align: middle" >Email</th>
                        <th class="text-center" style="vertical-align: middle" >Phone</th>
                        <th class="text-center" style="vertical-align: middle;width: 100px;" >Trạng thái<i class="glyphicon glyphicon-edit pull-right"></i></th>
                        <th class="text-center" style="vertical-align: middle;width: 100px;" >Trang chủ<i class="glyphicon glyphicon-edit pull-right"></i></th>
                        <th class="text-center" style="vertical-align: middle;width: 100px;" >Thứ tự</th>
                        <th class="text-center" style="vertical-align: middle;width: 215px" > 
                            Chức năng<i style="cursor: pointer" onclick="partners.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody>
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="8" class="text-danger" style="text-align: center">Không tồn tại đối tác nào trong cơ sở dữ liệu!</td>
                    </tr>
                    <% }else{ %>
                    <tr data-key=""></tr>
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id%>">
                        <td class="text-center" style="vertical-align: middle">
                            <p><%= eval(index+1) %></p>
                            <hr/>
                            <i class="glyphicon glyphicon-trash icon-remove" onclick="partners.remove('<%= this.id %>');"></i>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <% if(this.images.length > 0){ %>
                            <img src="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td class="text-center" style="vertical-align: middle"><%= this.name %></td>
                        <td class="text-center" style="vertical-align: middle"><%= this.website %></td>
                        <td class="text-center" style="vertical-align: middle"><%= this.email %></td>
                        <td class="text-center" style="vertical-align: middle"><%= this.phone %></td>
                        <td>
                            <div data-key="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="partners.changeActive(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td>
                            <div data-key-home="<%= this.id %>">
                                <%= '<label class=" label label-' + (this.home == 1 ? 'success' : 'danger') + '" >' + (this.home == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="partners.changeHome(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.home == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle"> <input type="text" onchange="partners.changePosition('<%= this.id %>');" rel-data="<%= this.id %>" class="text-center" value="<%= this.position %>" size="4"></td>
                        <td>
                            <div class="btn-group" style="margin-top: 5px">
                                <button onclick="partners.edit('<%=this.id%>')" type="button" class="btn btn-success" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
                                <button onclick="image.addImage('<%= this.id %>', 'partners');" type="button" class="btn btn-info" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                            </div>
                        </td>
                    </tr>
                    <% }); %>
                    <% } %>
                </tbody>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

