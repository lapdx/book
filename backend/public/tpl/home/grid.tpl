<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Thông tin cơ bản
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#index/grid">Thông tin cơ bản</a></li>
                <li style="float: right;"><div class="btn-group">
                        <button type="button" class="btn btn-success btn-right" onclick="index.edit('1')">
                            <i class="fa fa-edit"></i>
                            Thay đổi
                        </button>
                    </div></li>
                <li style="float: right;"><div class="btn-group">
                        <button type="button" class="btn btn-success btn-right" onclick="image.addImage(1, 'logo')">
                            <i class="fa fa-edit"></i>
                            Logo
                        </button>
                    </div></li>
                <li style="float: right;"><div class="btn-group">
                        <button type="button" class="btn btn-primary btn-right" onclick="meta.config('index', 1)">
                            <i class="fa fa-edit"></i>
                            Cấu hình seo
                        </button>
                    </div></li>
            </ul>
        </div>
    </div>
    <div class="func-container">
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover">
                <tr>
                    <td>facebook</td>
                    <td><%= data.facebook%></td>
                    <td>google</td>
                    <td><%= data.google%></td>
                </tr>
                <tr>
                    <td>youtube</td>
                    <td><%=data.youtube%></td>
                    <td>twitter</td>
                    <td><%=data.twitter%></td>
                </tr>
                <tr>
                    <td>Điện thoại tư vấn</td>
                    <td><%=data.phoneconsult%></td>
                    <td>Điện thoại chăm sóc</td>
                    <td><%=data.phonecare%></td>
                </tr>
                <tr>
                    <td>Hà nội 1</td>
                    <td>
                        <p><%=data.address1%></p>
                        <p><%=data.tel1%></p>
                        <p><%=data.description1%></p>
                    </td>
                    <td>Hà nội 2</td>
                    <td>
                        <p><%=data.address2%></p>
                        <p><%=data.tel2%></p>
                        <p><%=data.description2%></p>
                    </td>
                </tr>
                <tr>
                    <td>TPHCM</td>
                    <td>
                        <p><%=data.address3%></p>
                        <p><%=data.tel3%></p>
                        <p><%=data.description3%></p>
                    </td>
                    <td>Thời gian bán hàng</td>
                    <td><p><%=data.time%></p><p>Skype: <%=data.skype%></p><p>Email: <%=data.email%></p></td>
                </tr>
            </table>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

