<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', '2CC')</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/sandstone/bootstrap.min.css">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  
  <link href="{{ asset('/css/material-dashboard.css')}}"  rel="stylesheet" />
  <!-- <link href="../assets/demo/demo.css" rel="stylesheet" />  href="css/material-dashboard.css"-->
</head>
<body>
  <div class="wrapper" id="app">
    @yield('login')
    @if(Auth::user())
      <section class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
          Tip 2: you can also add an image using data-image tag
        -->
        <!-- Side Bar -->
        @include('inc.sidebar')
      </section>
      <section class="main-panel">
        <!-- Navbar -->
        @include('inc.navbar')

        <!-- Loader -->
        <div id="loader"></div>
        <section class="content">
          <!-- Content -->
          @include('inc.messages')
            @yield('content')
          @include('inc.userModal')
        </section>
      </section>
      @endif
    </div>
  </div>
<!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/bloodhound.min.js" integrity="sha256-WJlyUMyJDhWTumC7/oaAtXFRBh0rZGc7qT80egxJafw=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>
</html>
