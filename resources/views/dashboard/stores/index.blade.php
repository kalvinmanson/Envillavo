@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
    <i class="fa fa-plus"></i> Add New
  </button>
  <div class="clearfix"></div>
  @foreach($stores as $store)
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img class="rounded-circle img-fluid" src="{{ $store->logo or '/img/no-logo.jpg' }}" alt="{{ $store->name }}">
            <p class="text-muted">
              <small>
                <i class="fa fa-eye"></i> {{ $store->views }} | <i class="fa fa-star-o"></i> {{ $store->rank }}
              </small>
            </p>
          </div>
          <div class="col-sm-10">
            <h2 class="card-title">{{ $store->name }}</h2>
            <div class="row">
              <div class="col-md-6">
                <p class="card-text">{!! nl2br(strip_tags($store->description)) !!}</p>
              </div>
              <div class="col-md-6">
                <p class="card-text">
                  <i class="fa fa-phone"></i> {{ $store->phone }}<br>
                  <i class="fa fa-whatsapp"></i> {{ $store->mobile }}<br>
                  <i class="fa fa-map-marker"></i> {{ $store->city }}, {{ $store->address }}<br>
                  <i class="fa fa-clock-o"></i> {{ $store->schedule }}
                </p>
              </div>
            </div>

            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="/{{ $store->slug }}" target="_blank" class="btn btn-light btn-sm"><i class="fa fa-angle-right"></i> Ver</a>
              <a href="/dashboard/stores/{{ $store->id }}/edit" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Editar</a>
              <a href="/dashboard/stores/{{ $store->id }}/edit" class="btn btn-light btn-sm"><i class="fa fa-paper-plane"></i> Landings <span class="badge">{{ $store->landings->count() }}</i></a>
              <a href="/dashboard/stores/{{ $store->id }}/edit" class="btn btn-light btn-sm"><i class="fa fa-comments-o"></i> Chats <span class="badge">{{ $store->records->count() }}</i></a>
            </div>
          </div>
        </div>


      </div>
    </div>
  @endforeach
  <!-- Modal -->
  <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" action="{{ url('dashboard/stores') }}">
      {{ csrf_field() }}
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo comercio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Crear</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
