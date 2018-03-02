<header>
  <nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-primary">
    <a class="navbar-brand" href="/">
      <img src="/img/envillavo-logo.png" class="logo" alt="En Villavo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/buscar">Explorar</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/dashboard/stores">Escritorio</a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="/users/my"><i class="fa fa-bell"></i></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        @endif
      </ul>
    </div>
  </nav>
</header>
