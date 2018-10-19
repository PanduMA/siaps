<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siaps - Sign Up</title>    
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('papperdb/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="full-height flex-center">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                    <a role="button" class="btn-back btn-lg" href="{{ route('login') }}">
                        <span class="glyphicon glyphicon-menu-left"></span>
                    </a>
                </div>
                <div class="col-md-5 col-md-offset-2">
                    <div class="thumbnail text-center">
                        <div class="caption">
                            <h1>Daftar</h1>
                            <form method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <input type="text" name="username" placeholder="NIS/NIP/Username" class="form-control effect-7" id="inputUsername" maxlength="20
                                    ">
                                    <span class="focus-border"><i></i></span>
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" name="password" placeholder="Password" class="form-control effect-7" maxlength="12"><span class="focus-border"><i></i></span>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control effect-7" maxlength="12"><span class="focus-border"><i></i></span>
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <select class="form-control" name="status" id="status">
                                        <option selected>Pilih Status</option>
                                        <option value="Siswa">Siswa</option>
                                        <option value="Guru" id="guru">Guru</option>
                                    </select>
                                    <span class="focus-border"><i></i></span>
                                </div>
                                <div class="form-group" id="rd-kt">
                                    <label class="cont">
                                        <input type="radio" name="radio" value="Kesiswaan">
                                        <span class="checkmark"></span>Kesiswaan
                                    </label>
                                    <label class="cont">
                                        <input type="radio" name="radio" value="BK">
                                        <span class="checkmark"></span>BK
                                    </label>    
                                </div>
                                <button type="submit" class="btn btn-lg btn-block">Sign Up</button>
                                <p>Dengan menekan Sign Up, Anda telah menyetujui <a href="#">Syarat dan Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> Aplikasi Penyaluran Aspirasi Siswa.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('papperdb/js/bootstrap-notify.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#rd-kt").hide();
    });
    $("#status").change(function (){
        if($("#status").val() == "Guru")
            $("#rd-kt").show(1000);
        else
            $("#rd-kt").hide(1000);
    });
</script>
</html>