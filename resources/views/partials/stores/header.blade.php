<div class="cover" style="background-image: url({{ $store->cover or '/img/no-cover.jpg' }})">
  <div class="container">
    <div class="row py-3 py-lg-5">
      <div class="col-sm-3 text-center">
        <img src="{{ $store->logo or '/img/no-logo.jpg' }}" class="rounded-circle img-fluid">
        <h5 class="bg-light rounded d-inline p-2 my-2">
          <i class="fa fa-eye"></i> {{ $store->views }} | <i class="fa fa-star-o"></i> {{ $store->rank }}
        </h5>
      </div>
      <div class="col-md-9">

        <h1 class="title">{{ $store->name }}</h1>
        <h2 class="description">{{ $store->description }}</h2>
        <div class="card card-light border-0">
          <div class="card-header">Ponte en contacto</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p>Para ver numeros de telófono, dirección y otros datos de este comercio completa los sigueinte datos.</p>
              </div>
              <div class="col-md-6">
                @if((isset($record) && $record != null) || (Auth::check() && Auth::user()->id == $store->user_id))
                <p class="card-text">
                  <i class="fa fa-phone"></i> {{ $store->phone }}<br>
                  <i class="fa fa-whatsapp"></i> {{ $store->mobile }}<br>
                  <i class="fa fa-map-marker"></i> {{ $store->city }}, {{ $store->address }}<br>
                  <i class="fa fa-clock-o"></i> {{ $store->schedule }}
                </p>
                @else
                <form method="POST" action="/record">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono (Opcional)">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <button type="submit" class="btn btn-success">Ver información de contacto</button>
                  </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if(Auth::check() && Auth::user()->id == $store->user_id)
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/{{ $store->slug }}">Portada</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <a href="/{{ $store->slug }}/edit" class="nav-link"><i class="fa fa-edit"></i> Editar</a>
      <a href="/dashboard/stores/{{ $store->id }}/edit" class="nav-link"><i class="fa fa-paper-plane"></i> Landings <span class="badge badge-secondary">{{ $store->landings->count() }}</i></a>
      <a href="/dashboard/stores/{{ $store->id }}/edit" class="nav-link"><i class="fa fa-comments-o"></i> Chats <span class="badge badge-secondary">{{ $store->records->count() }}</i></a>
    </ul>
    <span class="navbar-text">
      Este es tu panel de administración
    </span>
  </div>
</nav>
</div>
@endif
