var auth = {};
auth.login = function() {
    $('[data-click="signin"]').click(function() {
        auth.googleSignin();
    });
    $('[data-click="signinface"]').click(function() {
        auth.facebookSignin();
    });
}
auth.googleSignin = function() {
    var clientId = '417347703611-a7ji873ii24dlifp3rsmva2ftuq1bprv.apps.googleusercontent.com';
    var apiKey = 'AIzaSyDU3iWTwTmbW3qZg6bkMCvzeys9FS5vn-o';
    var scopes = 'https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/plus.profile.emails.read';
    gapi.client.setApiKey(apiKey);
    window.setTimeout(function() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, function(authResult) {
            gapi.client.load('plus', 'v1', function() {
                var request = gapi.client.plus.people.get({
                    'userId': 'me'
                });
                request.execute(function(resp) {
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
                            done: function(rs) {
                                if (rs.success) {
                                    $("div[data-rel=message]").html('<div class="alert alert-success alert-login">' + rs.message + '</div>');
                                    setTimeout(function() {
                                        location.reload();
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
auth.facebookSignin = function() {
    console.log('a');
    FB.init({
        appId: '448249385342778',
        xfbml: true,
        version: 'v2.3'
    });

    FB.login(function(response) {
        if (response.authResponse) {
            FB.api("/me", {
                fields: "id,name,email,gender,picture,link,first_name,last_name",
                access_token: response.authResponse.accessToken
            }, function(resp) {
                var user = {
                    email: resp.email,
                    description: 'Tên : ' + resp.name + ' , giới tính : ' + resp.gender,
                };
                ajax({
                    service: '/auth/signin',
                    data: user,
                    contentType: 'json',
                    type: 'post',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                            $("div[data-rel=message]").html('<div class="alert alert-success alert-login">' + rs.message + '</div>');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $("div[data-rel=message]").html('<div class="alert alert-warning alert-login">' + rs.message + '</div>');
                        }
                    }
                });
            });
        } else {
            $("[data-error=message]").html('<div  class="alert alert-danger alert-passport">The system can not get your information from facebook</div>');
            return false;
        }
    }, {scope: 'public_profile,email'});
}