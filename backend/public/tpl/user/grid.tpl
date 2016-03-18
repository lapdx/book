<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-user-md"></i>
        Danh sách người dùng
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#user/grid">Danh sách người dùng</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#user/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="keyword" name="keyword" type="text" class="form-control" placeholder="Tài khoản hoặc tên">
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="active" data-search="active"  >
                        <option value="0" >Trạng thái</option>
                        <option value="1" >Hoạt động</option>
                        <option value="2" >Tạm khóa</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="type" data-search="type"  >
                        <option value="" >Loại</option>
                        <option value="admin" >Admin</option>
                        <option value="customer" >Customer</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-12">
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
        <p class="clearfix" ></p>
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover text-center">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >STT</th>
                        <th class="text-center" style="vertical-align: middle" >Tài khoản</th>
                        <th class="text-center" style="vertical-align: middle" >Tên</th>
                        <th class="text-center" style="vertical-align: middle" >Số điện thoại</th>
                        <th class="text-center" style="vertical-align: middle" >Loại</th>
                        <th class="text-center" style="vertical-align: middle;" >Trạng thái</th>
                        <th class="text-center" style="vertical-align: middle; width: 350px">
                            <i style="cursor: pointer" onclick="user.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody rel-data="bodydata">
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id %>" >
                        <td class="text-center stt" ><%= eval(index+1) %></td>
                        <td class="text-center" ><%= this.username %></td>
                        <td class="text-center" ><%= this.fullname %></td>
                        <td class="text-center" ><%= this.phone %></td>
                        <td class="text-center" ><%= this.type %></td>
                        <td class="text-center" data-id='<%= this.id %>' >
                            <label class="label label-<%= this.active==1?'success':'danger' %>" >
                                <%= this.active==1?'Hoạt động':'Tạm khóa' %>
                            </label>
                            <i onclick="user.changeActive('<%= this.id %>');" style="cursor: pointer" class="pull-right glyphicon glyphicon-<%= this.active==1?'check':'unchecked' %>" />
                        </td>
                        <td>
                            <div class="btn-group" style="margin-top: 5px">
                                <button onclick="user.edit('<%=this.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
                                 <button type="button" class="btn btn-success" onclick="user.setRole('<%= this.id %>')" >
                                <i class="fa fa-tag"></i>
                                Phân quyền
                            </button>
                                <button onclick="user.remove('<%= this.id %>');" type="button" class="btn btn-danger" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Xóa
                                </button>
                            </div>
                        </td>
                    </tr>
                    <%  }); %>
                </tbody>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

