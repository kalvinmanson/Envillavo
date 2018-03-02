@extends('layouts.app')

@section('title', 'Explorar comercios')
@section('meta-keywords', 'Comercios, en villavo, comercio, tiendas, negocios en villavicencio, establecimientos en villavicencio, buscar comercios en villavo')
@section('meta-description', 'Encuentra y descubre los mas importantes comercios en villavicencio, lo que estes bucascando encuentralo en Villavo')

@section('content')
  <div class="container">
    <div class="card-columns">
    @foreach($stores as $store)
        <div class="card">
          <img class="card-img-top" src="{{ $store->cover }}" alt="{{ $store->name }}">
          <div class="card-body">
            <a href="/{{ $store->slug }}" title="{{ $store->name }}">
              <h3>{{ $store->name }}</h3>
            </a>
              <h4>{{ $store->description }}</h4>
          </div>
        </div>
    @endforeach
    </div>
  </div>
@endsection
