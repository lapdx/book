<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-user-md"></i>
        Order
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#order/grid">Order grid</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#order/grid" id="search" class="form row" >
                <div class="col-sm-3">
                    <div class="form-group">
                        <input data-search="id" name="id"  type="text" class="form-control" placeholder="Order ID">
                    </div>
                    <div class="input-group">
                        <input data-search="updateTimeFrom" type="hidden" name="updateTimeFrom" type="text" class="form-control" placeholder="Update Time From">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="input-group" style="margin-top: 15px">
                        <input data-search="updateTimeTo" type="hidden" name="updateTimeTo" type="text" class="form-control" placeholder="Update Time To">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div><!-- /col -->

                <div class="col-sm-3">
                    <div class="form-group">
                        <input data-search="email" name="email" type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input data-search="name" name="name" type="text" class="form-control" placeholder="Tên">
                    </div>
                    <div class="form-group">
                        <input data-search="address" name="address" type="text" class="form-control" placeholder="Địa chỉ">
                    </div>

                </div><!-- /col -->

                <div class="col-sm-3">
                    <div class="input-group">
                        <input data-search="createTimeFrom" type="hidden" name="createTimeFrom" type="text" class="form-control" placeholder="Create Time From">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="input-group" style="margin: 15px 0 15px 0">
                        <input data-search="createTimeTo" type="hidden" name="createTimeTo" type="text" class="form-control" placeholder="Create Time To">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="paymentMethod" data-search="paymentMethod" >
                            <option value="0">Tất cả hình thức thành toán</option>
                            <option value="atm">Chuyển khoản</option>
                            <option value="cod">COD</option>
                        </select>
                    </div>

                </div><!-- /col -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <input data-search="note" name="note" type="text" class="form-control" placeholder="Ghi chú">
                    </div>
                    <div class="form-group">
                        <input data-search="phone" name="phone" type="text" class="form-control" placeholder="Số điện thoại">
                    </div>
                </div><!-- /col -->

                <div class="col-sm-3">
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
        <div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success">
                        <th class="text-center" style="vertical-align: middle;" >ID</th>
                        <th class="text-center" style="vertical-align: middle;">Thông tin liên hệ</th>
                        <th class="text-center" style="vertical-align: middle;" colspan="2">Thông tin đơn hàng</th>
                        <th class="text-center" style="vertical-align: middle;" >Chức năng</th>
                    <tr>
                </thead>
                <tbody>
                    <% if(data.data.length <= 0 ){ %>
                    <tr>
                        <td class="text-center danger" colspan="5">Chưa có đơn hàng nào!</td>
                    </tr>
                    <% }else{ %>
                    <% $.each(data.data, function(index){ %>
                    <tr data-key="<%= this.id %>" >
                        <td style="vertical-align: middle">
                            <p style="text-align: center">
                                <%= this.id %><br/>
                            </p>
                        </td>
                        <td style="text-align: center">
                            <p style="font-weight: bold;text-align: center;font-size: 15px">Thông tin khách hàng</p>
                            <p>Tên : <span style="font-weight: bold"><%= this.name %></span></p>
                            <p>Email : <span style="font-weight: bold"><%= this.email %></span></p>
                            <p>Số điện thoại : <span style="font-weight: bold"><%= this.phone %></span></p>
                            <p>Địa chỉ : <span style="font-weight: bold"><%= this.address %></span></p>
                        </td>
                        <td>
                            <% if(this.items.length > 0){ %>
                            <% $.each(this.items, function(index,order){ %>
                            <p>
                                <span style="display: inline-block;width: 220px" class="title-item">
                                    <%= this.quantity %> x <a href="<%= this.link %>" target="_blank"><%= this.name %></a>
                                </span>
                                <span style="display: inline-block; float: right; text-align: right"><%=  eval(this.sellPrice).toMoney() %> <span>đ</span> </span>
                            </p>
                            <% }) %>
                            <% } %>
                            <hr/>
                            <p>Tổng giá:
                                <span style="display: inline-block; float: right; text-align: right"><%= eval(this.totalPrice).toMoney() %> <sup>đ</sup></span>
                            </p>
                            <hr/>
                        </td>
                        <td>
                            <p style="margin-top: 10px">Hình thức thanh toán :
                                <span style="display: inline-block; float: right; text-align: right">
                                    <% if(this.paymentMethod == 'atm'){ %>
                                    <label class="label label-success">Chuyển khoản</label>
                                    <% }else{ %>
                                    <label class="label label-success">Thanh toán tại nhà</label>
                                    <% } %>
                                </span>
                            </p>
                            <p style="margin-top: 10px">Ngày tạo :
                                <span style="display: inline-block; float: right; text-align: right">
                                    <%= textUtils.formatTime(this.createTime,'hour') %>
                                </span>
                            </p>
                            <p style="margin-top: 10px">Ngày sửa :
                                <span style="display: inline-block; float: right; text-align: right">
                                    <%= textUtils.formatTime(this.updateTime,'hour') %>
                                </span>
                            </p>
                            <hr/>
                            <p style="font-weight: bold;text-align: center;">Ghi chú</p>
                            <p><%= this.note %></p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" onclick="order.remove('<%= this.id %>');" >
                                    <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
                                </button>
                            </div>
                        </td>
                    </tr>
                    <%  }); %>
                    <% } %>
                </tbody>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

