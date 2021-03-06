<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset(env('THEME'))}}/front/css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="{{asset(env('THEME'))}}/front/css/bootstrap/bootstrap-theme.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset(env('THEME'))}}/front/css/app.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="{{ route('tournaments') }}">Tournaments</a></li>
              <li><a href="">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
              <div class="navbar-right">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                    <li>
                        <a class="btn" id="logout" href="{{ route('logout') }}">@lang('Logout')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            @else 
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('register') }}" class="btn">Регистрация</a></li>
                    <li><a href="{{ route('login') }}" class="btn">Вход</a></li>
                </ul>
            @endif
            </div>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <main role="main" class="container">
		
      <div class="wrapper">
            @yield('main')
      </div>

    </main><!-- /.container -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset(env('THEME'))}}/front/js/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{asset(env('THEME'))}}/front/js/bootstrap/bootstrap.min.js"></script>
    <script src="{{asset(env('THEME'))}}/front/js/app.js"></script>
    @yield('js')
    <script>
	   $(function() {
		   $('#logout').click(function(e) {
			   e.preventDefault();
			   $('#logout-form').submit()
		   })
	   })
   </script>
  </body>
</html>



