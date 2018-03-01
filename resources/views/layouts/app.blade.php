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


</head>
<body>
  <div id="app">
    @include('partials.menu')
    <div class="container">
        @include('flash::message')
        @include('partials.errors')
    </div>
    @yield('content')
    <footer>
      <div class="container">
          <p>&copy; 2018 By <a href="//droni.co" title="Desarrollo Inteligente">Droni.co</a></p>
      </div>
    </footer>
  </div>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
