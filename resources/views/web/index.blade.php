@extends('layouts.app')
@section('title', 'Todo lo que buscas En Villavo')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="search">
  <div class="container text-center">
    <form action="/buscar" method="GET" class="p-1 p-lg-5">
      <h1>Todo lo que estas buscando <span class="text-primary">En Villavo.</span></h1>
      <div class="input-group mb-3">
        <input name="q" type="text" class="form-control form-control-lg" placeholder="Comprar casa en villavicencio..." aria-label="Buscar" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-primary btn-lg" type="button"><i class="fa fa-search"></i> Buscar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
