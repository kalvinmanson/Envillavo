@extends('layouts.app')

@section('title', $store->name)
@section('meta-keywords', $store->metakeywords)
@section('meta-description', $store->metadescription)

@section('content')

  <div class="store">
    <div class="cover" style="background-image: url({{ $store->cover }})">
      <div class="container">
        <div class="row py-3 py-lg-5">
          <div class="col-sm-3 text-center">
            <img src="{{ $store->logo }}" class="rounded-circle img-fluid">
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
                    @if($record)
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
    <div class="container py-3">
      {!! $store->content !!}
    </div>
  </div>

@if($record)
  <div class="floatingChat">
    @include('partials.chat', ['record' => $record])
  </div>
@endif
@endsection
