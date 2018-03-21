@extends('layouts.app')

@section('title', $landing->name)
@section('meta-keywords', $landing->metakeywords)
@section('meta-description', $landing->metadescription)

@section('content')
  <div class="store">
    @include('partials.stores.header', ['store' => $landing->store])
  </div>

<div class="container">
  <form method="POST" action="{{ url('/'.$landing->store->slug.'/landings/'.$landing->id.'/update') }}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-8">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Nombre del producto o servicio</label>
            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') ? old('name') : $landing->name }}" required>
          </div>

          <div class="form-group contarChars" data-chars=250>
            <span class="visor text-muted float-right"></span>
              <label for="description">Description corta</label>
              <textarea class="form-control textBox" id="description" name="description" placeholder="Describe tu comercio, dinos a que te dedicas y que es lo que ofreces." required>{{ old('description') ? old('description') : $landing->description }}</textarea>
          </div>
          <div class="form-group">
              <label for="content">Página de bienvenida de tu comercio</label>
              <textarea name="content" id="content" class="form-control editor">{{ old('content') ? old('content') : $landing->content }}</textarea>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar cambios</button>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card my-3">
          <div class="card-header">Branding</div>
          <div class="card-body">
            <div class="form-group">
              <label for="picture">Imasgen destacada</label>
              <div class="row">
                <div class="col-sm-4">
                  <img src="{{ $landing->picture or '/img/no-picture.jpg' }}" class="rounded-circle img-fluid">
                </div>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="picture" name="picture">
                  <small class="form-text text-muted">Imagen JPG o PNG optimizada para web de 400x400px.</small>
                </div>
              </div>

            </div>
            <div class="form-group">
              <label for="logo">Cover</label>
              <p class="text-center">
                <img src="{{ $landing->cover or '/img/no-cover.jpg' }}" class="img-fluid">
              </p>
              <input type="file" class="form-control" id="cover" name="cover">
            </div>
          </div>
        </div>
        <div class="card my-3">
          <div class="card-header">SEO</div>
          <div class="card-body">
            <div class="form-group">
              <label for="metakeywords">Meta Keywords</label>
              <input type="text" class="form-control" id="metakeywords" name="metakeywords" value="{{ old('metakeywords') ? old('metakeywords') : $landing->metakeywords }}">
            </div>
            <div class="form-group">
              <label for="metadescription">Meta Descripción</label>
              <textarea class="form-control" id="metadescription" name="metadescription">{{ old('metadescription') ? old('metadescription') : $landing->metadescription }}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
