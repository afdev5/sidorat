<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}">
    <title>Sidorat</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Datatable -->
    <link href="{{ asset('assets/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand"><b>Si</b>dorat</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{ route('home') }}">Dashboard <span
                                        class="sr-only">(current)</span></a></li>
                            @if(Auth::user()->level == 0)
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                            <li><a href="{{ route('surat.create') }}">Buat Surat</a></li>
                            <li><a href="{{ route('surat.index') }}">Surat Masuk</a></li>
                            <li><a href="{{ route('arsip') }}">Arsip Surat</a></li>
                            @elseif(Auth::user()->level == 1)
                            <li><a href="{{ route('surat.create') }}">Buat Surat</a></li>
                            <li><a href="{{ route('arsip') }}">Arsip Surat</a></li>
                            @else
                            <li><a href="{{ route('surat.index') }}">Surat Masuk</a></li>
                            <li><a href="{{ route('arsip') }}">Arsip Surat</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu" id="notif">
                                @php
                                if(Auth::user()->level == 2)
                                {
                                $notif = App\Surat::where('no_agenda', null)->count();
                                }
                                elseif(Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5)
                                {
                                $notif = App\Teruskan::where([['user_id', Auth::user()->id],['read', '0']])->count();
                                }
                                @endphp
                                <!-- Menu toggle button -->
                                @if(Auth::user()->level != 1 && Auth::user()->level != 0)
                                <a href="{{ route('surat.index') }}">
                                    <i class="fa fa-envelope-o"></i>
                                    @if($notif)
                                    <span class="label label-danger">{{ $notif }}</span>
                                    @endif
                                </a>
                                @endif
                            </li>
                            <!-- /.messages-menu -->
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{ asset('assets/dist/img/avatar.png') }}" class="user-image"
                                        alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"> {{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{ asset('assets/dist/img/avatar.png') }}" class="img-circle"
                                            alt="User Image">

                                        <p>
                                            {{ Auth::user()->name }}
                                            <small>
                                                User
                                            </small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @else
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                    </div>
                    </li>
                    </ul>
                    </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
    </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            @yield('content')
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019 <a href="http://ti.unima.ac.id/">Kerja Praktek Teknik Informatika UNIMA</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('assets/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('assets/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <!-- Pusher -->
    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>

    {{-- Notifikasi Realtime --}}

    <script type="text/javascript">
        var pusher = new Pusher('{{ env('
            MIX_PUSHER_APP_KEY ') }}', {
                cluster: '{{ env('
                MIX_PUSHER_APP_CLUSTER ') }}',
                encrypted: true
            });


        @if(Auth::check())
        var channel = pusher.subscribe('surat-channel.{{ Auth::user()->id }}');
        channel.bind('App\\Events\\PusherEvent', function (data) {
            // this is called when the event notification is received...
            $("#notif").load(location.href + " #notif");

        });

        @else
        var channel = pusher.subscribe('surat-channel');
        channel.bind('App\\Events\\PusherEvent', function (data) {
            // this is called when the event notification is received...
            console.log('oke');
        });
        @endif

    </script>

    @yield('js')
</body>

</html>
