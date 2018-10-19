<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siaps - Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('papperdb/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="full-height flex-center">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="logo">
                        <img src="{{asset('img/logo2.png')}}" class="img-responsive">    
                    </div>
                </div>
                <div class="col-md-2">
                    <hr>
                </div>
                <div class="col-md-5"> 
                    <div class="thumbnail">
                        <div class="caption">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <input type="text" name="username" placeholder="NIS/NIP/Username" class="form-control" id="inputUsername" maxlength="20"><span class="focus-border"><i></i></span>
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <input type="password" name="password" placeholder="Password" class="form-control effect-7 pwd" id="inputPassword" maxlength="12"><span class="focus-border"><i></i></span>
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <span class="input-group-addon"><span toggle="#inputPassword" class="glyphicon glyphicon-eye-close field-icon toggle-password"></span></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-block">Sign In</button>
                                <p>Belum punya akun?Daftar <a href="{{ route('register') }}">disini</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('papperdb/js/bootstrap-notify.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(session('msg'))
            $.notify({
                message: 'Terima Kasih Telah Mendaftar, Silahkan Untuk Login Kembali'
            },{
                type: 'info',
                timer: 4000
            });
            @endif
        });
        $(".toggle-password").click(function() {
            $(this).toggleClass("glyphicon-eye-open").toggleClass("glyphicon-eye-close");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
</script>
</body>
</html>