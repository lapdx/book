<div style="padding: 10px;" >
    <%  $.each(data.services, function(){  %>
    <%  var action = this; %>
    <div class="panel panel-success">
        <div class="panel-heading">
            <label>
                <input data-id="<%= action.name %>" data-rel="check_all" type="checkbox" />  <%= action.alias %>
            </label>
        </div>
        <div class="panel-body" >
            <% $.each(action.child, function(){  %>
            <div class="row">
                <div class="col-md-6">
                    <input data-group="<%= action.name %>" data-rel="function" data-id="<%= this.name %>" type="checkbox" /> 
                    <%= this.alias %> 
                </div>
                <div class="col-md-6">
                    <span class="help-block pull-right" ><%= this.name %></span>
                </div>
            </div>
            <% }); %>
        </div>
    </div>
    <% }); %>
</div>