<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cms-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="cms-navbar">
        <ul class="nav navbar-nav navbar-right">
            <% $.each(groups, function(){ var group = this; %>
            <li class="dropdown" data-nav="<%= group.name %>" style="display: none; cursor: pointer" >
                <a class="dropdown-toggle" data-toggle="dropdown"><%= group.name %><b class="caret"></b></a>
                <ul class="dropdown-menu"  >
                    <% $.each(services, function(){ var service = this; %>
                    <% if(service.groupId == group.id){ %>
                    <li data-item="<%= service.name %>" data-group="<%= group.name %>" ><a href="#<%= service.name=='function'?'func':service.name %>/grid"><%= service.alias %></a></li>
                    <% } %>
                    <% }); %>
                </ul>
            </li>
            <% }); %>
        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /container -->