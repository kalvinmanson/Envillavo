@extends('layouts.app')

@section('title', $store->name)
@section('meta-keywords', $store->metakeywords)
@section('meta-description', $store->metadescription)

@section('content')

  <div class="store">
    @include('partials.stores.header', ['store' => $store])
    <div class="container py-3">
      <h1>Editar: {{ $store->name }}</h1>
      <form method="POST" action="{{ url('/'.$store->slug.'/update') }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-8">
            {{ csrf_field() }}
            @if($store->trashed())
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="untrash" value="1"> This record was deleted. You want undelete?
                </label>
              </div>
            </div>
            @endif
            <div class="form-group">
              <label for="name">Nombre del comercio</label>
              <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') ? old('name') : $store->name }}" required>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Email de contacto</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : Auth::user()->email }}"  required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="category">Categoría</label>
                  <select name="category" id="category" class="form-control">
                    <option value="General">General</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="phone">Teléfono</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ? old('phone') : $store->phone }}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="mobile">Movil <i class="fa fa-whatsapp"></i></label>
                  <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') ? old('mobile') : $store->mobile }}" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="schedule">Horarios <i class="fa fa-clock-o"></i></label>
              <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule') ? old('schedule') : $store->schedule }}" placeholder="ej. Lunes a Viernes 9:00 am a 5:00 pm" required>
            </div>

            <div class="card my-3">
              <div class="card-header">Datos Geográfico</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="city">Ciudad</label>
                      <select name="city" id="city" class="form-control">
                        <option value="Acacias" {{ $store->city == "Acacias" ? 'selected' : '' }}>Acacias</option>
                        <option value="Villavicencio" {{ $store->city == "Villavicencio" ? 'selected' : '' }}>Villavicencio</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="address">Dirección</label>
                      <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ? old('address') : $store->address }}" required>
                    </div>
                  </div>
                </div>

                <mapa :initlat="{{ $store->lat }}" :initlng="{{ $store->lng }}"></mapa>
              </div>
            </div>
            <div class="form-group contarChars" data-chars=250>
              <span class="visor text-muted float-right"></span>
                <label for="description">Description corta</label>
                <textarea class="form-control textBox" id="description" name="description" placeholder="Describe tu comercio, dinos a que te dedicas y que es lo que ofreces." required>{{ old('description') ? old('description') : $store->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Página de bienvenida de tu comercio</label>
                <textarea name="content" id="content" class="form-control editor">{{ old('content') ? old('content') : $store->content }}</textarea>
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
                <label for="logo">Logo</label>
                <div class="row">
                  <div class="col-sm-4">
                    <img src="{{ $store->logo or '/img/no-logo.jpg' }}" class="rounded-circle img-fluid">
                  </div>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" id="logo" name="logo">
                    <small class="form-text text-muted">Imagen JPG o PNG optimizada para web de 400x400px.</small>
                  </div>
                </div>

              </div>
              <div class="form-group">
                <label for="logo">Cover</label>
                <p class="text-center">
                  <img src="{{ $store->cover or '/img/no-cover.jpg' }}" class="img-fluid">
                </p>
                <input type="file" class="form-control" id="cover" name="cover">
              </div>
              <div class="form-group">
                <label for="colorset">Color set</label>
                <select name="colorset" id="colorset" class="form-control">
                  <option value="Basic" {{ $store->colorset == "Basic" ? 'selected' : '' }}>Basic</option>
                  <option value="Dark" {{ $store->colorset == "Dark" ? 'selected' : '' }}>Dark</option>
                </select>
              </div>
            </div>
          </div>
          <div class="card my-3">
            <div class="card-header">SEO</div>
            <div class="card-body">
              <div class="form-group">
                <label for="metakeywords">Meta Keywords</label>
                <input type="text" class="form-control" id="metakeywords" name="metakeywords" value="{{ old('metakeywords') ? old('metakeywords') : $store->metakeywords }}">
              </div>
              <div class="form-group">
                <label for="metadescription">Meta Descripción</label>
                <textarea class="form-control" id="metadescription" name="metadescription">{{ old('metadescription') ? old('metadescription') : $store->metadescription }}</textarea>
              </div>
              <div class="form-group">
                <label for="facebook">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook') ? old('facebook') : $store->facebook }}">
              </div>
              <div class="form-group">
                <label for="twitter">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter') ? old('twitter') : $store->twitter }}">
              </div>
              <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags') ? old('tags') : $store->tags }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    {{--
      {!! Form::open([
      'method' => 'DELETE',
      'route' => ['admin.categories.destroy', $store->id]
      ]) !!}
          {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
      {!! Form::close() !!}
      --}}
    </div>
  </div>
  <div class="clearfix"></div>
@endsection
