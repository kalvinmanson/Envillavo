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
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            Comercio
          </a>
          <div class="dropdown-menu">
            @foreach(Auth::user()->stores as $menuStore)
              <a class="dropdown-item" href="/{{ $menuStore->slug }}">{{ $menuStore->name }}</a>
            @endforeach
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/stores/new">Crear nuevo <i class="fa fa-plus"></i></a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Perfil</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/login">Entrar</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>
</header>
