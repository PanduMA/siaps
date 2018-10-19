<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link
    rel="icon"
    type="image/png"
    sizes="96x96"
    href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Siaps - Profile Siswa</title>

    <meta
    content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'
    name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet"/>

    <!-- Animation library for notifications -->
    <link href="{{asset('papperdb/css/animate.min.css')}}" rel="stylesheet"/>

    <!-- Paper Dashboard core CSS -->
    <link href="{{asset('papperdb/css/paper-dashboard.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/style2.css')}}" rel="stylesheet"/>

    <link href="{{asset('papperdb/css/themify-icons.css')}}" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="info">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">Siaps</a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="{{url("/")}}/aspirasisiswa/{{$username}}">
                            <i class="ti-archive"></i>
                            <p>Aspirasi</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <i class="ti-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li>
                        <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i>
                        <p>LOGOUT</p>
                    </a>
                    <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>

<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid custom">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a class="navbar-brand" href="#">Profile Siswa</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            <img src="{{asset('papperdb/img/faces/profile-m.jpg')}}" class="smallphoto">
                            @foreach($siswa as $siswa)
                            <p>{{$siswa->nama}}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="card card-user">
                        <div class="image">
                            <img
                            src="{{asset('papperdb/img/background/smkn1cimahi-lapangan.jpg')}}"
                            alt="background"/>
                        </div>
                        <div class="content">
                            <div class="author" id="profile-container">
                                <form 
                                    action="{{url("/")}}/siswa/{{$username}}/update" 
                                    method="post" 
                                    enctype="multipart/form-data">
                                @if(!is_null($siswa->gambar))
                                <img 
                                    class="avatar border-white" 
                                    src="{{asset('uploads/'.$siswa->gambar.'')}}" 
                                    alt="Foto Profil"
                                    id="profileImage"/>
                                @elseif($siswa->jenis_kelamin == 'Perempuan')
                                <img 
                                    class="avatar border-white" 
                                    src="{{asset('uploads/profile-f.jpg')}}" 
                                    alt="Foto Profil"
                                    id="profileImage"/>
                                @else
                                <img 
                                    class="avatar border-white" 
                                    src="{{asset('uploads/profile-m.jpg')}}" 
                                    alt="Foto Profil"
                                    id="profileImage"/>
                                @endif
                                <input
                                    id="ppUpload"
                                    type="file"
                                    onchange="preview_image(event)"
                                    name="ppUpload"
                                    accept="image/*">
                                <h4 class="title">{{$siswa->nama}}<br/>
                                    <small>
                                        siswa
                                    </small>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-3 col-md-offset-1 col-xs-3 col-xs-offset-1">
                                    @foreach($jml as $jml)
                                    <h5>{{$jml->jumlah}}<br/>
                                        <small>Aspirasi</small>
                                    </h5>
                                    @endforeach
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    @foreach($bk as $bk)
                                    <h5>{{$bk->jumlahbk}}<br/>
                                        <small>BK</small>
                                    </h5>
                                    @endforeach
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    @foreach($ks as $ks)
                                    <h5>{{$ks->jumlahks}}<br/>
                                        <small>Kesiswaan</small>
                                    </h5>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <small>
                                            Bergabung pada :
                                            {{$bergabung}}
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Edit Profile</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input
                                        type="text"
                                        class="form-control ct"
                                        disabled="disabled"
                                        placeholder="Nomer Induk Siswa"
                                        value="{{$username}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="up">
                                        <label>Nama Siswa</label>
                                        <input
                                        type="text"
                                        class="form-control ct"
                                        placeholder="Nama Siswa"
                                        name="nm"
                                        value="{{$siswa->nama}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="up">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control ct" name="jk">
                                            <option selected="selected">{{$siswa->jenis_kelamin}}</option>
                                            <option>Laki - laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" id="up">
                                        <label>Tingkat</label>
                                        <select class="form-control ct" name="tk">
                                            <option selected="selected">{{$siswa->tingkat}}</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>13</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group" id="up">
                                        <label>Jurusan</label>
                                        <select class="form-control ct" name="jr">
                                            <option selected="selected">{{$siswa->jurusan}}</option>
                                            <option>Rekayasa Perangkat Lunak</option>
                                            <option>Teknik Elektronika Industri</option>
                                            <option>Teknik Pendingin</option>
                                            <option>Teknik Otomasi Industri</option>
                                            <option>Teknik Elektronika Komunikasi</option>
                                            <option>Sistem Informasi dan Jaringan dan Aplikasi</option>
                                            <option>Instrumentasi Otamatisasi Proses</option>
                                            <option>Produksi Film dan Pertelevisian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" id="up">
                                        <label>Kelas</label>
                                        <select class="form-control ct" name="kls">
                                            <option selected="selected">{{$siswa->kelas}}</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-info" name="update">Update Profile</button>
                                {{csrf_field()}}
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, made with
            <i class="ti-heart red"></i>
            by
            <a href="https://www.instagram.com/pandumaziz/" target="_blank">Pandu MA</a>
        </div>
    </div>
</footer>

</div>
</div>

</body>

<!-- Core JS Files -->
<script src="{{asset('papperdb/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('papperdb/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!-- Notifications Plugin -->
<script src="{{asset('papperdb/js/bootstrap-notify.js')}}"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{asset('papperdb/js/paper-dashboard.js')}}"></script>

<script type="text/javascript">
    $("#profileImage").click(function (e) {
        $("#ppUpload").click();

    });
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('profileImage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    $(document).ready(function () {
        @if(isset($msg))
        $.notify({
            message: 'Profil anda berhasil diupdate.'
        }, {
            type: 'info',
            timer: 4000
        });
        @endif

    });
</script>

</html>