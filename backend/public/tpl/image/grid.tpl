<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Image
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#image/grid">Image grid</a></li>
            </ul>
        </div>
        <button type="button" onclick="image.addImage('0', '_DEFAULT');" class="btn btn-success" style="margin: 10px;" >
            <i class="glyphicon glyphicon-plus" ></i> Add image
        </button>
    </div>
    <!-- /panel -->

    <div class="func-container">

        <%= viewUtils.dataPage(data, [])  %>
        <div class="clearfix" ></div>
        <div class="row">
            <% $.each(data.data, function(index){  %>
            <div class="col-md-2" forGridImagetpl="<%= index + 1%>" >
                <div class="thumbnail">
                    <i class="icon-remove icon-position-absolute  glyphicon glyphicon-trash" onclick="image.deleteImage('<%= this.imageId %>', '<%= index +1 %>');"></i>
                    <span>
                        <img src="<%= baseImage.baseUrl %><%= this.imageId %>" style="height: auto; max-height: 100px;" alt="No Image" />
                    </span>
                    <div class="caption">
                        <p><%= this.type.toLowerCase() %>: <%= this.targetId %></p>
                    </div>
                </div>
            </div>
            <%  }); %>
        </div>
        <%= viewUtils.dataPage(data, [])  %>
        <div class="clearfix"></div>
    </div><!-- /func-container -->
</div><!-- /cms-content -->



