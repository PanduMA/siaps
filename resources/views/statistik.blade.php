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
        <title>Siaps - Statistik</title>
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
        
        <!-- Style -->
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
                        <li>
                            <a href="{{url("/")}}/guru/{{$username}}">
                                <i class="ti-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
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
                            <a class="navbar-brand" href="#">Statistik</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#">
                                        <img src="{{asset('papperdb/img/faces/profile-m.jpg')}}" class="smallphoto">
                                        @foreach($guru as $guru)
                                        <p>{{$guru->nama}}</p>
                                        @endforeach
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-pencil-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers text-center">
                                                    <p>Jumlah Aspirasi Masuk</p>
                                                    @foreach($jml as $jml)
                                                    {{$jml->Jumlah}}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-calendar"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers text-center">
                                                    <p>Aspirasi Masuk Hari Ini</p>
                                                    {{$today}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-files"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers text-center">
                                                    <p>Aspirasi Jurusan Terbanyak</p>
                                                    {{$nmjur}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistik Aspirasi</h4>
                                        <p class="category">Aspirasi Masuk Menurut Bulan</p>
                                    </div>
                                    <div class="content">
                                        <canvas id="myChart"></canvas>
                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="ti-timer"></i> Campaign sent 2 days ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistik Aspirasi</h4>
                                        <p class="category">Aspirasi Masuk Menurut Hari</p>
                                    </div>
                                    <div class="content">
                                        <canvas id="myChart2"></canvas>
                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="ti-timer"></i> Campaign sent 2 days ago
                                            </div>
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

    <!--  Charts Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, { 
            type: 'bar', 
            data: { 
                labels: [
                        <?php   
                            foreach($bulanan as $bulan)
                             echo ' " '.$bulan->waktu.' ", ';
                        ?>
                    ], 
                datasets: [{ 
                    label: "Jumlah Aspirasi",
                    borderColor:'rgb(32,178,170)', 
                    borderWidth:4,
                    data: [
                        <?php
                            foreach($bulanan as $bulan)
                             echo ' " '.$bulan->data.' ", ';
                        ?>,
                    ], 
                }] 
            },
            options: {
				responsive: true,
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Bulan'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			},  
        });
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, { 
            type: 'line', 
            data: { 
                labels: [
                        <?php   
                            foreach($harian as $hari)
                             echo ' " '.$hari->tgl.' ", ';
                        ?>
                    ], 
                datasets: [{ 
                    label: "Jumlah Aspirasi", 
                    borderColor: 'rgb(32,178,170)', 
                    borderWidth:4,
                    data: [
                        <?php
                            foreach($harian as $hari)
                             echo ' " '.$hari->data.' ", ';
                        ?>,
                    ],
                }] 
            },
            options: {
				responsive: true,
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Tanggal'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			} 
        });
	</script>
</html>