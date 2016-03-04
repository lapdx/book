<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Liên hệ
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#contact/grid">Danh sách liên hệ</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#contact/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <div class="input-group">
                        <input data-search="createTimeFrom" name="createTimeFrom" type="hidden" class="form-control" placeholder="CreateTimeFrom" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <div class="input-group">
                        <input data-search="createTimeTo" name="createTimeTo" type="hidden" class="form-control" placeholder="CreateTimeTo" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <div class="input-group">
                        <input data-search="updateTimeFrom" name="updateTimeFrom" type="hidden" class="form-control" placeholder="updateTimeFrom" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <div class="input-group">
                        <input data-search="updateTimeTo" name="updateTimeTo" type="hidden" class="form-control" placeholder="updateTimeTo" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <input data-search="keyword" name="keyword" type="text" class="form-control" placeholder="Từ khóa">
                </div><!-- /col -->
                <div class="col-sm-4">
                    <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span>Tìm kiếm
                    </button>
                    <button onclick="viewUtils.btnReset('search');" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-refresh"></span>Làm lại
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
                        <th class="text-center" style="vertical-align: middle" >Tên</th>
                        <th class="text-center" style="vertical-align: middle;" >Email</th>
                        <th class="text-center" style="vertical-align: middle;" >Ngày tạo</th>
                        <th class="text-center" style="vertical-align: middle;" >Ngày sửa</th>
                        <th class="text-center" style="vertical-align: middle;width: 310px" > 
                            Chức năng<i style="cursor: pointer" onclick="contact.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody>
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="8" class="text-danger" style="text-align: center">Không tồn tại liên hệ nào trong cơ sở dữ liệu!</td>
                    </tr>
                    <% }else{ %>
                    <tr data-key=""></tr>
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id%>">
                        <td class="text-center" style="vertical-align: middle"><%= eval(index+1) %></td>
                        <td class="text-center" style="vertical-align: middle"><%= this.name %></td>
                        <td class="text-center" style="vertical-align: middle"><%= this.email %></td>
                        <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(this.createTime) %></td>
                        <td class="text-center" style="vertical-align: middle"><%= textUtils.formatTime(this.updateTime) %></td>
                        <td>
                            <div class="btn-group" style="margin-top: 5px">
                                <button onclick="contact.edit('<%=this.id%>')" type="button" class="btn btn-success" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
                                <button onclick="contact.detail('<%=this.id%>')" type="button" class="btn btn-info" style="width: 100px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Chi tiết</button>
                                <button onclick="contact.remove('<%=this.id%>')" type="button" class="btn btn-danger" style="width: 100px;"><span class="glyphicon glyphicon-trash pull-left" style="line-height: 18px"></span> Xóa</button>
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

