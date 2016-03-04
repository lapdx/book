<div class="box-content" style="margin-bottom: 30px; margin-left:10px;">
    <% if(typeof(data) !== 'undefined'){ %>
    <ul class="thumbnails gallery" id="imageModel">
        <% $.each(data, function(i){ %>
        <li  style="float: left; list-style: none; padding: 0px 5px; margin: 0px 5px; height: 100px; margin-bottom: 50px;" for="<%= i %>">
            <a style="cursor:pointer" >
                <img style="height: 100px;max-width: 500px;"  src="<%= baseImage.baseUrl %><%= this.imageId %>" class="grayscale thumbnail" title="image <%= i %>" alt="Image<%= i %>">
                <div align="center" title="Delete this image" onclick="image.deleteImage('<%= this.imageId %>', '<%= i%>')">
                    <span style="margin-top:10px; text-align:center" class="glyphicon glyphicon-trash"></span> remove
                </div>
            </a>
        </li>
        <% }); %>     
        <div class="clearfix"></div>
    </ul>  
    <% }else{ %>
    <div class="nodata" style="color: red; margin:10px 150px;">Hiện tại sản phẩm này chưa có ảnh</div>
    <% } %>
</div>
<div class="form-actions alert alert-success">
    <form id="image-add-module" class="form-horizontal" role="form">
        <input type="hidden" name="target" value="<%= targetId %>" />
        <input type="hidden" name="type" value="<%= type %>" />
        <div class="left">
            <label class="radio-inline">
                <input name="uploadType" onchange="image.changeType(this, 'uploadFile', 'uploadUrl');" checked="checked" class="uploadType" type="radio" value="1"> Upload ảnh
            </label>
            <label class="radio-inline">
                <input name="uploadType" onchange="image.changeType(this, 'uploadUrl', 'uploadFile');" class="uploadType" type="radio" value="2"> Download ảnh
            </label>                
            <div class="radio" id="uploadFile">
                <input type="file" style="display:none" id="lefileadd" name="imageFile" onchange="image.upload('file');"  />
                <div  class="input-group">
                    <input type="text" class="form-control" id="photoCoveradd">
                    <a onclick="$('#lefileadd').click();" class="btn btn-default input-group-addon">Chọn</a>                    
                </div>
            </div>   
            <div id="uploadUrl" style="display: none;"  class="radio">
                <input type="text" class="form-control" name="urladd" placeholder="Nhập địa chỉ url hình ảnh" onchange="image.upload('url');"  />               
            </div>
        </div>
    </form>            
</div>