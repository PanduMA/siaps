<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Siaps - Dashboard</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('papperdb/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('papperdb/css/paper-dashboard.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/style2.css')}}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
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
                <li class="active">
                    <a href="{{url("/")}}/aspirasiguru/{{$username}}">
                        <i class="ti-archive"></i>
                        <p>Aspirasi</p>
                    </a>
                </li>
                <li>
                    <a href="{{url("/")}}/guru/{{$username}}">
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
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" {{-- class="dropdown-toggle" data-toggle="dropdown" --}}> 
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
                                @endforeach
                            </a>
                            {{-- <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul> --}}
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Data Aspirasi</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-bordered dataaspirasi">
                                            <tr>
                                                <td>Pengirim : {{$aspirasi->nis}}</td>
                                            </tr>
                                            <tr>
                                                <td>Subjek: {{$aspirasi->subjek}}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu : {{$aspirasi->waktu}}</td>
                                            </tr>
                                            <tr>
                                                <td>Pesan : </td>
                                            </tr>
                                            <tr>
                                                <td>{{$aspirasi->pesan}}<br>
                                                    @if(!is_null($gambar))
                                                    <img src="{{asset('uploads/'.$aspirasi->gambar.'')}}" class="pic">
                                                    @endif
                                                </td>
                                            </tr>                                               
                                        </table>
                                        <a href="{{url("/")}}/aspirasiguru/{{$username}}" class="btn btn-default pull-right" role="button">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Aspirasi</h4>
                </div>
                <div class="modal-body">
                    <div class="deleteContent">
                        Apakah kamu yakin akan menghapus data aspirasi dengan subjek <span class="dname"></span> ? <span
                        class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn actionBtn delete" data-dismiss="modal">
                            <i class="ti-trash" id="footer_action_button"></i> Delete
                        </button>
                        <button type="button" class="btn " data-dismiss="modal">
                            <i class="ti-close"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="{{asset('papperdb/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('papperdb/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('papperdb/js/bootstrap-notify.js')}}"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{asset('papperdb/js/paper-dashboard.js')}}"></script>


<script type='text/javascript'>
 $(document).ready(function () {
    $(document).on('click', '.delete-modal', function() {
        $('.did').text($(this).data('id'));
        $('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deletedata',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('#item' + $('.did').text()).fadeOut();
                $.notify({
                    message: 'Success , Aspirasi anda berhasil dihapus.'
                },{
                    type: 'success',
                    timer: 4000
                });
            }
        });
    });
});
</script>
</html>
