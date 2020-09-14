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
        <title>Siaps - Profile Guru</title>
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

        <!-- Fonts and icons -->
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
                            <a href="{{url("/")}}/aspirasiguru/{{$username}}">
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
                            <a href="{{url("/")}}/statistik/{{$username}}">
                                <i class="ti-pie-chart"></i>
                                <p>Statistik</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti-power-off"></i>
                                <p>LOGOUT</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                            <a class="navbar-brand" href="#">Profile Guru</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#">
                                        @foreach($guru as $guru)
                                            @if(($guru->gambar))
                                            <img 
                                                class="smallphoto" 
                                                src="{{asset('uploads/'.$guru->gambar.'')}}" 
                                                alt="Foto Profil"/>
                                            @elseif($guru->jenis_kelamin == 'Perempuan')
                                            <img 
                                                class="smallphoto" 
                                                src="{{asset('uploads/profile-f.jpg')}}" 
                                                alt="Foto Profil"/>
                                            @else
                                            <img 
                                                class="smallphoto" 
                                                src="{{asset('uploads/profile-m.jpg')}}" 
                                                alt="Foto Profil"/>
                                            @endif
                                        <p>{{$guru->nama}}</p>
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
                                                action="/guru/{{$username}}/update"
                                                enctype="multipart/form-data"
                                                method="post">
                                                @if(($guru->gambar))
                                                <img 
                                                    class="avatar border-white" 
                                                    src="{{asset('uploads/'.$guru->gambar.'')}}" 
                                                    alt="Foto Profil"
                                                    id="profileImage"/>
                                                @elseif($guru->jenis_kelamin == 'Perempuan')
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
                                                    id="imageUpload"
                                                    type="file"
                                                    onchange="preview_image(event)"
                                                    name="imageUpload"
                                                    accept="image/*">
                                                <h4 class="title">{{$guru->nama}}<br/>
                                                    <small>guru</small>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>{{$guru->kategori}}</h5>
                                                </div>
                                            </div>
                                        </div>
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
                                                        <label>NIP</label>
                                                        <input
                                                            type="text"
                                                            class="form-control ct"
                                                            disabled="disabled"
                                                            placeholder="Nomer Induk Siswa"
                                                            value="{{$guru->nip}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama Guru</label>
                                                        <input
                                                            type="text"
                                                            class="form-control ct"
                                                            placeholder="Nama Guru"
                                                            value="{{$guru->nama}}"
                                                            name="nm">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control ct" name="jk">
                                                            <option selected="selected">{{$guru->jenis_kelamin}}</option>
                                                            <option>Laki - laki</option>
                                                            <option>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-block btn-info" name="update">Update Profile</button>
                                                {{csrf_field()}}
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                        @endforeach
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
            $("#imageUpload").click();

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