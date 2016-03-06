<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Tin tức
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#news/grid">Danh sách tin tức</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#news/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="keyword" name="keyword" type="text" class="form-control" placeholder="Từ Khóa">
                    <div style="margin-top: 5px;">
                        <select class="form-control" name="active" data-search="active"  >
                            <option value="0" >Trạng thái</option>
                            <option value="1" >Hoạt động</option>
                            <option value="2" >Tạm khóa</option>
                        </select>
                    </div><!-- /col -->
                </div><!-- /col -->
                <div class="col-sm-3 padding-all-5">
                    <div class="input-group">
                        <input type="hidden" name="createTimeFrom" data-search="createTime" class="form-control" placeholder="CreateTime">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="input-group" style="margin-top:5px;">
                        <input type="hidden" name="createTimeTo" data-search="createTimeTo"  class="form-control" placeholder="CreateTimeTo">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-all-5">
                    <div class="input-group">
                        <input type="hidden" name="updateTimeFrom" data-search="updateTime"  class="form-control" placeholder="UpdateTime">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="input-group" style="margin-top:5px;">
                        <input type="hidden" name="updateTimeTo" data-search="updateTimeTo"  class="form-control" placeholder="UpdateTimeTo">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
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
                        <th class="text-center" style="vertical-align: middle"></th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Mã tin tức</th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle" >Tên tin tức</th>
                        <th class="text-center" style="vertical-align: middle" >Ngày tạo</th>
                        <th class="text-center" style="vertical-align: middle" >Ngày sửa</th>
                        <th class="text-center" style="vertical-align: middle;" >Trạng thái</th>
                        <th class="text-center" style="vertical-align: middle;" >
                            Chức năng<i style="cursor: pointer" onclick="news.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody rel-data="bodydata">
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="5" class="text-danger" style="text-align: center">Không tồn tại tin tức nào trong cơ sở dữ liệu!</td>
                    </tr>
                    <% }else{ %>
                    <% $.each(data.data, function(index){ %>
                    <tr rel-data="<%= this.id %>">
                        <td class="text-center" style="vertical-align: middle">
                            <p><%= eval(index+1) %></p>
                            <hr/>
                            <i class="glyphicon glyphicon-trash icon-remove" onclick="news.remove('<%= this.id %>');"></i>
                        </td>
                        <td class="text-center" style="vertical-align: middle"><%= this.id %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <% if(this.images.length > 0){ %>
                            <img src="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td class="text-center" style="vertical-align: middle" data-name="<%= this.id %>"><%= this.name %></td>
                        <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(this.createTime) %></td>
                        <td class="text-center" style="vertical-align: middle" data-updateTime="<%= this.id %>"><%= textUtils.formatTime(this.updateTime) %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + this.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="news.edit('<%= this.id %>');" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>
                                <button onclick="image.addImage('<%= this.id %>', 'news');" type="button" class="btn btn-success" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                                <button onclick="meta.config('news', '<%= this.id %>');" type="button" class="btn btn-primary" style="width: 100px;">
                                    <span class="fa fa-wrench pull-left" style="line-height: 18px" ></span> Cấu hình
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

