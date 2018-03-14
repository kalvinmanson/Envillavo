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

        <h1 class="title breaker">{{ $store->name }}</h1>
        <h2 class="description breaker">{{ $store->description }}</h2>

        <ul class="nav nav-tabs" id="contacto" role="tablist">
          <li class="nav-item">
            <a class="nav-link btn-info" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="true">
              <i class="fa fa-comment"></i> Escribenos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-info" id="profile-tab" data-toggle="tab" href="#phones" role="tab" aria-controls="phones" aria-selected="false"><i class="fa fa-phone"></i> Datos de contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-info" id="contact-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false"><i class="fa fa-map-marker"></i> ¿Donde estamos?</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane bg-light p-3 fade" id="message" role="tabpanel" aria-labelledby="message-tab">
            <form method="POST" action="/record">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">¿Cómo te llamas?</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="email">¿Cual es tu email?</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
                  </div>
                  <div class="form-group">
                    <label for="email">¿Cual es tu teléfono?</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono (Opcional)">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="content">¿En que podemos servirte?</label>
                    <textarea name="content" id="content" class="form-control" required rows=6></textarea>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <button type="submit" class="btn btn-success">Enviar mensaje</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane bg-light p-3 fade" id="phones" role="tabpanel" aria-labelledby="phones-tab">
            <div class="row">
              <div class="col-sm-6">
                <h5>Puedes llamarnos en estos teléfonos:</h5>
                <p class="card-text">
                  <i class="fa fa-phone"></i> {{ $store->phone }}<br>
                  <i class="fa fa-whatsapp"></i> {{ $store->mobile }}
                </p>
                <h5>O escribenos a:</h5>
                <p class="card-text">
                  <i class="fa fa-envelope"></i> {{ $store->email }}
                </p>
              </div>
              <div class="col-sm-6 text-center">
                <a href="https://api.whatsapp.com/send?phone={{ $store->mobile }}" class="btn btn-lg btn-success">Escribenos por Whatsapp <i class="fa fa-whatsapp"></i></a>
              </div>
            </div>

          </div>
          <div class="tab-pane bg-light p-3 fade" id="location" role="tabpanel" aria-labelledby="location-tab">
            <div class="row">
              <div class="col-sm-6">
                <h5>Visitanos en la ciudad de {{ $store->city }}: </h5>
                <p class="card-text">
                  <i class="fa fa-map-marker"></i> {{ $store->address }}<br>
                  <i class="fa fa-clock-o"></i> Horario: {{ $store->schedule }}
                </p>
              </div>
              <div class="col-sm-6 text-center">
                <a href="https://www.google.com/maps/?q=-15.623037,18.388672" target="_blank" class="btn btn-lg btn-warning">¿Como llegar? <i class="fa fa-location-arrow"></i></a>
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
