<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-user-md"></i>
        List administrator rights on the system
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#func/grid">System defined rights</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div data-rel="gridGroup" ></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle" >Chức năng</th>
                        <th class="text-center" style="vertical-align: middle" >Tên quyền</th>
                        <th class="text-center" style="vertical-align: middle; max-width: 100px;" >
                <div class="form-group" style="margin-bottom: 0px;">
                    <div class="input-group" data-rel="addGroup" >
                        <input class="form-control" placeholder="Enter để thêm nhóm mới" name="cpGroupName" >
                        <div class="input-group-addon" onclick="func.addGroup();" style="cursor: pointer">+</div>
                    </div>
                </div>
                </th>
                <th></th>
                <tr>
                    </thead>
                <tbody>
                    <% var i=0; $.each(data.services, function(role, permissions){ i++;  %>
                    <tr data-rel="<%= role %>" >
                        <td class="text-left" style="vertical-align: middle" >
                            <i class="fa fa-list"></i>
                            <%= role %>
                            </tđ>
                        <td class="text-left" style="vertical-align: middle" >
                            <input type="text" data-id="<%= role %>" class="form-control" />

                            </tđ>
                        <td class="text-center" style="vertical-align: middle" >
                            <select class="form-control" data-field="group" data-id="<%= role %>" >
                                <option value="0">Chọn nhóm quyền</option>
                                <% $.each(data.groups, function(){  %>
                                <option value="<%= this.id %>"><%= this.name %></option>
                                <%  }); %>
                            </select>
                            </tđ>
                        <td class="text-center" style="vertical-align: middle" >
                            <button type="button" class="btn btn-success" onclick="func.saveItem('<%= role %>', 1)" ><i class="fa fa-save" ></i> Save</button>
                        </td>
                    </tr>
                    <% $.each(permissions, function(key, permission){  %>
                    <tr data-rel="<%= permission %>" >
                        <td class="text-left" style="vertical-align: middle; padding-left: 40px;" >
                            <i class="fa fa-tag"></i>
                            <%= permission %>
                            </tđ>
                        <td class="text-left" style="vertical-align: middle" >
                            <input type="text"  data-id="<%= permission %>" class="form-control" />
                            </tđ>
                        <td class="text-center" style="vertical-align: middle" ></tđ>
                        <td class="text-center" style="vertical-align: middle" >
                            <button type="button" class="btn btn-success" onclick="func.saveItem('<%= permission %>', 2)" ><i class="fa fa-save" ></i> Save</button>
                            </tđ>
                    </tr>
                    <%  }); %>
                    <%  }); %>
                </tbody>
            </table>
        </div><!-- /table-responsive -->

    </div><!-- /func-container -->
</div><!-- /cms-content -->