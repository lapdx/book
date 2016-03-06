var auth = {};

auth.signin = function () {
    layout.title("Manager website");
    $("body").html("");
    // $("body").addClass("bg-login");
    $("body").prepend(Fly.template("/auth/signin.tpl", null));

    setTimeout(function () {
        $('[data-click="signin"]').click(function () {
            // auth.googleSignin();
            auth.submitForm();
        });
    }, 300);

};

auth.sigout = function () {
    ajax({
        service: '/auth/sigout',
        done: function (resp) {
            if (resp.success) {
                location.hash = "#auth/signin";
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

auth.googleSignin = function () {
    var clientId = '1040368870497-nmt1e6fa4uea639huitlgq85s0s4cle2.apps.googleusercontent.com';
    var apiKey = 'AIzaSyAk_fD8jiiceUtQ9l-180ZzyRccDSNeOlk';
    var scopes = 'https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/plus.profile.emails.read';
    gapi.client.setApiKey(apiKey);
    window.setTimeout(function () {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, function (authResult) {
            gapi.client.load('plus', 'v1', function () {
                var request = gapi.client.plus.people.get({
                    'userId': 'me'
                });
                request.execute(function (resp) {
                    if (resp != "" && resp.result != "") {
                        var user = {
                            email: resp.emails[0].value,
                            description: 'Tên : ' + resp.displayName + ' , giới tính : ' + resp.gender,
                        };
                        ajax({
                            service: '/auth/signin',
                            data: user,
                            contentType: 'json',
                            type: 'post',
                            loading: false,
                            done: function (rs) {
                                if (rs.success) {
                                    $("div[data-rel=message]").html('<div class="alert alert-success alert-login">' + rs.message + '</div>');
                                    setTimeout(function () {
                                        window.location.href = baseUrl ;
//                                        location.reload();
}, 1000);
                                } else {
                                    $("div[data-rel=message]").html('<div class="alert alert-warning alert-login">' + rs.message + '</div>');
                                }
                            }
                        });
                    }
                });
});
});
}, 1);
};

auth.submitForm = function(){
    var username = $("#username").val();
    var password = $("#password").val();
    var user = {
        username:username,
        password:password
    }
    ajax({
        service: '/auth/signin',
        data: user,
        contentType: 'json',
        type: 'post',
        loading: false,
        done: function (rs) {
            if (rs.success) {
                $("#error").text(rs.message);
                setTimeout(function () {
                    window.location.href = baseUrl ;
                }, 1000);
            } else {
                $("#error").text(rs.message);
            }
        }
    });
}