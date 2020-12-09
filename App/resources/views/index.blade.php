<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    
    <title>Thi trắc nghiệm</title>
</head>

<body>
    <div class="dangnhap">
        <!-- <h3>Đăng nhập hệ thống </h3> -->
        <form action="" id="form" >
            <legend id="h">Đăng nhập hệ thống</legend>
            <span>Tài Khoản:</span>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" id="username" class="form-control" placeholder="Nhập tài khoản của bạn">
            </div>
            <span>Mật khẩu:</span>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu của bạn">
            </div>
            <input type="button" value='Đăng nhập' id="login">
        </form>
    </div>
</body>

</html>
<script>
$(document).ready(function () {
    // load lai trang
    
    $('#login').click(function () {
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
            type: "GET",
            url: "{{ route('checklogin.check') }}",
            data: {
                user1: user,
                pass1: pass
            },
            dataType: "text",
            success: function (response) {
                if (response == 'false') {
                    alert('Tài khoản hoặc mật khẩu không chính xác');
                }
                else {
                    if (response == 'user') {
                        window.location.href = "{{ route('view_user.check') }}";
                    }
                    else if (response == 'admin') {
                        window.location.href = "{{ route('view_admin.check') }}";
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
</script>