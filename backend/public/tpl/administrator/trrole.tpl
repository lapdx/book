<% if(edit == false) { %>
<tr data-key="<%= data.sourceId %>" class="success" >
    <% } %>
    <td class="text-center" style="vertical-align: middle"><%= data.administratorId%></td>
    <td class="text-center" style="vertical-align: middle"><%= data.sourceId %></td>
    <td class="text-center" style="vertical-align: middle"><%= data.role %></td>
    <td class="text-center" style="vertical-align: middle">
        <div class="btn-group">
            <button style="margin-top: 7px;" type="button" class="btn btn-xs btn-danger" onclick="administrator.removeApi('<%= data.administratorId %>', '<%= data.sourceId %>')">Remove</button>
        </div>
    </td>
    <% if(edit == false) { %>
</tr>
<% } %>
