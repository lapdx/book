<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Item
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#item/grid">Danh sách item</a></li>
                 <li style="float: right;"><div class="btn-group">
            </div></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#item/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="keyword" name="keyword" type="text" class="form-control" placeholder="Từ khóa">
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="active" data-search="active"  >
                        <option value="0" >Trạng thái</option>
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
                        <th class="text-center" style="vertical-align: middle" >ID</th>
                        <th class="text-center" style="vertical-align: middle" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle" >Tên</th>
                        <th class="text-center" style="vertical-align: middle" >Giá bán</th>
                        <th class="text-center" style="vertical-align: middle" >Giá gốc</th>
                        <th class="text-center" style="vertical-align: middle;width: 100px;" >Trạng thái<i class="glyphicon glyphicon-edit pull-right"></i></th>
                        <th class="text-center" style="vertical-align: middle;width: 220px" > 
                            Chức năng<i style="cursor: pointer" onclick="item.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody>
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="8" class="text-danger" style="text-align: center">Không tồn tại item nào trong cơ sở dữ liệu!</td>
                    </tr>
                    <% }else{ %>
                    <tr data-key=""></tr>
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id%>">
                        <td class="text-center" style="vertical-align: middle"><p><%= this.id %></p><hr/>
                            <i class="glyphicon glyphicon-trash icon-remove" onclick="item.remove('<%= this.id %>');"></i></td>
                        <td class="text-center" style="vertical-align: middle">
                            <% if(this.images.length > 0){ %>
                            <img src="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td class="text-center" style="vertical-align: middle"><%= this.name %></td>
                        <td class="text-center" style="vertical-align: middle"><%= eval(this.sellPrice).toMoney() %> đ</td>
                        <td class="text-center" style="vertical-align: middle"><%= eval(this.startPrice).toMoney() %> đ</td>
                        <td>
                            <div data-key="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="item.changeActive(\'' + this.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group" style="margin-top: 5px">
                                <button onclick="item.edit('<%=this.id%>')" type="button" class="btn btn-success" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
                                <button onclick="item.content('<%=this.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-list-alt pull-left" style="line-height: 18px"></span> Nội dung</button>
                            </div>
                            <div class="btn-group" style="margin-top: 5px">
                                <button onclick="image.addImage('<%= this.id %>', 'item');" type="button" class="btn btn-info" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                                <button onclick="meta.config('item','<%= this.id %>');" type="button" class="btn btn-success" style="width: 100px;">
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

