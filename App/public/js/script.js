$(document).ready(function () {
    // load lai trang
    
    $('#login').click(function () {
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
            type: "POST",
            url: "checklogin",
            data: {
                username: user,
                password: pass
            },
            dataType: "text",
            success: function (response) {
                if (response == 'false') {
                    alert('Tài khoản hoặc mật khẩu không chính xác');
                }
                else {
                    if (response == 'user') {
                        window.location.href = "";
                    }
                    else if (response == 'admin') {
                        window.location.href = "view_admin";
                    }
                }

            }
        });
    });
    $('#password').on('keypress', function (e) {
        if (e.which === 13) {
            $('#login').trigger('click');
        }
    });
})
