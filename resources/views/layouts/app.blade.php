<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"  content="@yield('meta-keywords')">
    <meta name="description"  content="@yield('meta-description')" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

</head>
<body>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143945159-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-143945159-1');
</script>

  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '193974634527418',
      xfbml      : true,
      version    : 'v2.12'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
  <div id="app">
    @include('partials.menu')
    <div class="container">
        @include('flash::message')
        @include('partials.errors')
    </div>
    @yield('content')
    <footer class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h5>En Villavo</h5>
            <ul>
              <li><a href="#">Quiénes somos</a></li>
              <li><a href="#">Para empresas y comercios</a></li>
              <li><a href="#">Políticas de privacidad</a></li>
            </ul>
          </div>
          <div class="col-sm-4">

          </div>
          <div class="col-sm-4 text-right">
            <div class="btn-group" role="group" aria-label="Redes sociales">
              <a href="https://www.facebook.com/envillavo/" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
              <a href="#" target="_blank" class="btn btn-info"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>
          <p>&copy; 2018 By <a href="//droni.co" title="Desarrollo Inteligente">Droni.co</a></p>
      </div>
    </footer>
  </div>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
