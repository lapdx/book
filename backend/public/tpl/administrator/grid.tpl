<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-user-md"></i>
        Danh sách administrator
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#administrator/grid">Danh sách administrator</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#administrator/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="email" name="email" type="text" class="form-control" placeholder="Địa chỉ email">
                </div><!-- /col -->
                <div class="col-sm-3 padding-all-5">
                    <div class="input-group">
                        <input type="hidden" name="startTime" data-search="startTime" class="form-control" placeholder="Ngày tạo từ ngày">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-all-5">
                    <div class="input-group">
                        <input type="hidden" name="endTime" data-search="endTime"  class="form-control" placeholder="Tới ngày">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-5">
                    <select class="form-control" name="active" data-search="active"  >
                        <option value="0" >Status</option>
                        <option value="1" >Active</option>
                        <option value="2" >Temporary lock</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-12">
                    <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span>Search
                    </button>
                    <button onclick="viewUtils.btnReset('search');" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-refresh"></span>Redo
                    </button>
                </div><!-- /col -->
            </form><!-- /form -->
        </div>
        <%= viewUtils.dataPage(data, [])  %>
        <p class="clearfix" ></p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >STT</th>
                        <th class="text-center" style="vertical-align: middle" >Infomartion</th>
                        <th class="text-center" style="vertical-align: middle" >Description</th>
                        <th class="text-center" style="vertical-align: middle" >Join Time</th>
                        <th class="text-center" style="vertical-align: middle" >LastTime</th>
                        <th class="text-center" style="vertical-align: middle;" >Status</th>
                        <th class="text-center" style="vertical-align: middle;" >Functionality</th>
                    <tr>
                </thead>
                <tbody>
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id %>" >
                        <td class="text-center" ><%= eval(index+1) %></td>
                        <td class="text-center" ><%= this.id %></td>
                        <td class="text-center" ><%= this.description %></td>
                        <td class="text-center" ><%= textUtils.formatTime(this.joinTime) %></td>
                        <td class="text-center" ><%= textUtils.formatTime(this.lastTime) %></td>
                        <td class="text-center" data-id='<%= this.id %>' >
                            <label class="label label-<%= this.active==1?'success':'danger' %>" >
                                <%= this.active==1?'Active':'Temporary lock' %>
                            </label>
                            <i onclick="administrator.changeActive('<%= this.id %>');" style="cursor: pointer" class="pull-right glyphicon glyphicon-<%= this.active==1?'check':'unchecked' %>" />
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" onclick="administrator.setRole('<%= this.id %>')" >
                                <i class="fa fa-tag"></i>
                                Permission
                            </button>
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

