<table class="table table-bordered">
    <thead>
        <tr>
            <th width="35%">Tên sản phẩm</th>
            <th width="10%" class="text-center">Xoá</th>
            <th width="15%" class="text-center">Số lượng</th>
            <th width="20%" class="text-right">Đơn giá</th>
            <th width="20%" class="text-right">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <% var total = 0; %>
        <% if ((data.items&&data)) { %>
        <% $.each(data.items, function(index){ %>
        <tr>
            <td>
                <div class="grid">
                    <div class="img"><a href="<%= baseUrl %><%= urlsUtils.item(this.name,this.sku) %>"><img src="<%= (this.image!=null)?this.image:baseUrl + 'images/no_avatar.png' %>" alt="<%= this.name %>" /></a></div>
                    <div class="g-content">
                        <div class="g-row">
                            <a class="g-title" href="<%= baseUrl %><%= urlsUtils.item(this.name,this.sku) %>"><%= this.name %></a>
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-center"><span class="fa fa-times cursor-pointer" onclick="order.removeItem('<%= this.sku %>')"></span></td>
            <td class="text-center">
                <input name="" type="text" data-key="<%= this.sku %>" onchange="order.updateItem('<%= this.sku %>')" class="form-control text-inlineblock" value="<%= this.quantity %>" />
                <span class="fa fa-refresh cursor-pointer"></span>
            </td>
            <td class="text-right"><%= textUtils.sellPrice(this.sellPrice) %> VNĐ</td>
            <td class="text-right"><%= textUtils.sellPrice(this.sellPrice * this.quantity) %> VNĐ</td>
        </tr>
        <% total += (this.sellPrice * this.quantity)%>
        <% }); %>
        <% } else { %>
    <td colspan="5" class="text-center">Không có sản phầm nào trong đơn hàng</td>
    <% } %>
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="4"><b>Tổng:</b></td>
            <td class="text-right"><b class="text-danger"><%= textUtils.sellPrice(total) %> VNĐ</b></td>
        </tr>
    </tfoot>
</table>