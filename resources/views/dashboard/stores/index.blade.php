@extends('layouts.app')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
  <i class="fa fa-plus"></i> Add New
</button>
<div class="clearfix"></div>
@foreach($stores as $store)
  <div class="card mb-3">
    <img class="card-img" src="{{ $store->cover }}" alt="{{ $store->name }}">
    <div class="card-img-overlay text-white">
      <img class="img-fluid float-left" src="{{ $store->logo }}" alt="{{ $store->name }}">
      <h2 class="card-title">{{ $store->name }}</h2>
      <p class="card-text">{{ $store->description }}</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      <a href="/dashboard/stores/{{ $store->id }}/edit" class="btn btn-default">Editar</a>
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
@endsection
