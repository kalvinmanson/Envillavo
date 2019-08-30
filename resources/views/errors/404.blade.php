@extends('layouts.app')
@section('title', 'Todo lo que buscas En Villavo')
@section('meta-keywords', 'comercios en villavicencio, tiendas, almacenes, negocios, villavicencio, meta, colombia, buscar negocios en villavicencio, buscar compras, en villavo, tiendas villavo')
@section('meta-description', 'todo lo que quieras encontrar en comercios esta En Villavo, el mejor portal de comercios y negocios en villavicencio.')
@section('content')
<div class="bgIndex">
  <div class="container text-center">
    <form action="/buscar" method="GET" class="p-1 p-lg-5">
      <img src="/img/envillavo-logo-big.png" class="img-fluid" alt="En Villavo">
      <h1>
        ¡Ups!, estamos remodelando un poco,<br>
        pronto veras mas cosas <span class="text-info">en Villavo.</span>
      </h1>
      <div class="input-group mb-3">
        <input name="q" type="text" class="form-control form-control-lg" placeholder="Comprar casa en villavicencio..." required autofocus>
        <div class="input-group-append">
          <button class="btn btn-outline-primary btn-lg" type="submit"><i class="fa fa-search"></i> Buscar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
