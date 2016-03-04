<table class="table table-bordered" style="margin: 15px;width: 97%">
    <tr>
        <td><b>Tên</b></td>
        <td colspan="3"><%= data.name %></td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td colspan="3"><%= data.email %></td>
    </tr>
    <tr>
        <td><b>SĐT</b></td>
        <td colspan="3"><%= data.phone %></td>
    </tr>
    <tr>
        <td><b>Địa chỉ</b></td>
        <td colspan="3"><%= data.address %></td>
    </tr>
    <tr>
        <td><b>Thông điệp</b></td>
        <td colspan="3"><textarea disabled="" style="width: 100%; height: 150px;"><%= data.content %></textarea></td>
    </tr>
</table>