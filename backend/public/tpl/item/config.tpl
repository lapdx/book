<form class="form-horizontal" id="form-config" style="width: 500px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Title:</label>
        <div class="col-sm-8">
            <input name="title" type="text" value="<%= (data != null ?  data.title: '') %>" class="form-control" placeholder="Title"/>
        </div>
    </div>
    <input name="id" type="hidden" value="<%= (typeof id != 'undefined' ?  id : '') %>" class="form-control" placeholder="ID"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Keyword:</label>
        <div class="col-sm-8">
            <input name="keyword" type="text" value="<%= (data != null ?  data.keyword: '') %>" class="form-control" placeholder="Keyword"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Description:</label>
        <div class="col-sm-8">
            <textarea rows="5" name="description" type="text"class="form-control" ><%= (data != null ?  data.description: '') %></textarea>
        </div>
    </div>
</form>