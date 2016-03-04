var func = {};
func.groups = [];
func.grid = function () {
    layout.title("Function in Systen");
    layout.breadcrumb([
        ["Dashboad", "#index/grid"],
        ["System administrator", "#func/grid"],
        ["Definitions privileges"]
    ]);

    ajax({
        service: '/function/grid',
        done: function (resp) {
            if (resp.success) {
                func.groups = resp.data.groups;
                layout.container(Fly.template("/function/grid.tpl", resp));

                setTimeout(function () {
                    $("input[name=cpGroupName]").keyup(function (event) {
                        if (event.keyCode === 13) {
                            func.addGroup();
                        }
                    });

                    //drawl item per
                    $.each(resp.data.items, function () {
                        $("input[data-id='" + this.name + "']").val(this.alias == null ? "" : this.alias);
                        if (this.type == 1) {
                            $("select[data-id='" + this.name + "']").val(this.groupId);
                        }
                    });
                }, 300);

            } else {
                popup.msg(resp.message);
            }
        }
    });

};

func.addGroup = function () {
    var gname = $("input[name=cpGroupName]").val();
    if (gname === '') {
        $("div[data-rel=addGroup]").addClass("has-error");
        setTimeout(function () {
            $("div[data-rel=addGroup]").removeClass("has-error");
        }, 2000);
        return false;
    }
    ajax({
        service: '/function/authgroupsave',
        data: {name: gname, position: 1},
        contentType: 'json',
        type: 'post',
        loading: false,
        done: function (rs) {
            if (rs.success) {
                $("select[data-field]").append('<option value="' + rs.data.id + '">' + rs.data.name + '</option>');
                $("input[name=cpGroupName]").val("");
                func.groups.push(rs.data);
                //hiệu ứng
                $("div[data-rel=addGroup]").addClass("has-success");
                setTimeout(function () {
                    $("div[data-rel=addGroup]").removeClass("has-success");
                }, 2000);
            } else {
                popup.msg(rs.message);
            }
        }
    });
};

func.saveItem = function (_name, _type) {

    var groupId = $("select[data-id='" + _name + "']").val();
    var name = $("input[data-id='" + _name + "']").val();
    if (name == '') {
        return false;
    }
    var item = {
        type: _type,
        name: _name,
        alias: name,
        groupId: typeof groupId == 'undefined' ? "0" : groupId,
    };
    ajax({
        service: '/function/authitemsave',
        data: item,
        contentType: 'json',
        type: 'post',
        loading: false,
        done: function (rs) {
            if (rs.success) {
                $("tr[data-rel=" + _name + "]").addClass("success");
            } else {
                popup.msg(rs.message);
            }
        }
    });
};
