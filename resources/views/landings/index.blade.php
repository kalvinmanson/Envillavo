@extends('layouts.app')

@section('title', $store->name)
@section('meta-keywords', $store->metakeywords)
@section('meta-description', $store->metadescription)

@section('content')

  <div class="store">
    @include('partials.stores.header', ['store' => $store])
  </div>

<div class="container">
  <a href="#" data-toggle="modal" data-target="#addNew" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Agregar nuevo</a>
  <p>Mediante las landing puedes promocionar productos y servicios específicos de tu comercio, asignando un precio y agregando la información especifica de cada uno, pero los datos de contacto y registros serán los mismos de tu comercio principal.</p>
  <table class="table table-striped">
    <tr>
      <th>Titulo</th>
      <th>Descripcion</th>
      <th>Registros</th>
      <th>Rank/Views</th>
    </tr>
    @foreach($store->landings as $landing)
    <tr>
      <td><a href="/{{ $landing->store->slug }}/landings/{{ $landing->id }}/edit">{{ $landing->name }}</a></td>
      <td>{{ $landing->description }}</td>
      <td>{{ $landing->records->count() }}</td>
      <td>{{ $landing->rank }} / {{ $landing->views }}</td>
    </tr>
    @endforeach
  </table>
</div>


<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('/'.$store->slug.'/landings/') }}">
    {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar producto o servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="name">Nombre del producto o servicio</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
    </form>
  </div>
</div>

@endsection
