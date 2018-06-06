<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('img/logo-fav.png')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/kasir.css')}}" type="text/css"/>
</head>
<body class="be-splash-screen">
<div class="be-wrapper be-login">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="text-center">
                <h1><strong>SELAMAT DATANG {{ strtoupper(\Auth::guard('kasir')->user()->name) }}</strong></h1>
                <hr>
                <div role="group" class="btn-group btn-group-lg btn-group-justified btn-space">
                    <a href="#" class="btn btn-lg btn-primary">PEMBELIAN</a>
                    <a href="#" class="btn btn-lg btn-default">SERVIS</a>
                    <a href="#" class="btn btn-lg btn-default">LAPORAN</a>
                    <a href="javascript:void(0);" class="btn btn-lg btn-default" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        LOGOUT
                    </a>
                </div>

                <form id="logout-form" action="{{ url('kasir/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <br>
            @yield('content')
        </div>
    </div>
</div>
<script src="{{asset('lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
        App.init();
    });
    @yield('script')

</script>
</body>
</html>
