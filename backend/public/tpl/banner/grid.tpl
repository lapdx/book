<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Banner
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#banner/grid">Danh sách banner</a></li>
                <li style="float: right;"><div class="btn-group">
            </div></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#banner/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <div style="margin-top: 5px;">
                        <input data-search="name" name="name" type="text" class="form-control" placeholder="Tìm kiếm theo tên">
                    </div>
                </div>
                <div class="col-sm-3 padding-right-5">
                    <div style="margin-top: 5px;">
                        <select class="form-control" name="active">
                            <option value="0" >Trạng thái</option>
                            <option value="1" >Hoạt động</option>
                            <option value="2" >Tạm khóa</option>
                        </select>
                    </div><!-- /col -->
                </div>
                <div class="col-sm-3 padding-right-5">
                    <div style="margin-top: 5px;">
                        <select class="form-control" name="type">
                            <option value="" >Kiểu Banner</option>
                            <option value="center" >Center Banner</option>
                            <option value="heart" >Heart Banner</option>
                            <option value="right" >Right Banner</option>
                            <option value="left" >Left Banner</option>
                        </select>
                    </div><!-- /col -->
                </div>
                <div class="col-sm-3 padding-right-5">
                    <div style="margin-top: 5px;">
                        <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                            <span class="glyphicon glyphicon-search"></span>Tìm kiếm
                        </button>
                        <button onclick="viewUtils.btnReset('search');" type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-refresh"></span>Làm lại
                        </button>
                    </div>
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
                        <th class="text-center" style="vertical-align: middle;width: 50px" >Mã</th>
                        <th class="text-center" style="vertical-align: middle; width: 200px ">Ảnh</th>
                        <th class="text-center" style="vertical-align: middle; width: 400px;">Thông tin banner</th>
                        <th class="text-center" style="vertical-align: middle;" >Trạng thái</th>
                        <th class="text-center" style="vertical-align: middle;width: 215px" > 
                            Chức năng<i style="cursor: pointer" onclick="banner.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody rel-data="bodydata">
                    <% $.each(data.data, function(index){ %>
                    <tr rel-data="<%= this.id %>">
                        <td class="text-center" style="vertical-align: middle">
                            <p><%= eval(index+1) %></p>
                            <hr/>
                            <i class="glyphicon glyphicon-trash icon-remove" onclick="banner.remove('<%= this.id %>');"></i>
                        </td>
                        <td class="text-center" style="vertical-align: middle;width: 80px" ><%= this.id %></td>
                        <td class="text-center" style="vertical-align: middle;width: 80px" >
                            <% if(this.images.length > 0){ %>
                            <img src="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <td class="text-center" style="vertical-align: middle; text-align: justify;">
                            Tên Banner : <%= this.name %><br/>
                            <% 
                            var type = '';
                            switch(this.type){
                            case 'left' :
                            type = 'LeftBanner';
                            break;
                            case 'right' :
                            type = 'RightBanner';
                            break;
                            case 'heart' :
                            type = 'HeartBanner';
                            break;
                            case 'center' :
                            type = 'CenterBanner';
                            break;
                            } 
                            %>
                            Kiểu Banner : <%= type %><br/>
                            Link Banner : <a href="<%= this.link %>" target="_blank"><%= this.link %></a><br/>
                            Mô tả : <%= this.description%><br/>
                        </td>
                        <td class="text-center" style="vertical-align: middle;" >
                            <div data-key-active="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="banner.changeActive(\'' + this.id + '\')" style="cursor: pointer; margin-left: 5px;" class="glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" style=" margin-left: 23px;">
                                <button onclick="banner.edit('<%=this.id%>')" type="button" class="btn btn-primary" style="width: 80px;"><span class="glyphicon glyphicon-edit pull-left" style="line-height: 18px"></span> Sửa</button>
                                <button onclick="image.addImage('<%= this.id %>', 'banner');" type="button" class="btn btn-success" style="width: 80px;"><span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh</button>
                            </div>
                        </td>
                    <tr>
                        <% }); %>
                </tbody>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

