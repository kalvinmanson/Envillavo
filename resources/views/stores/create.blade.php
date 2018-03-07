@extends('layouts.app')

@section('content')
<div class="container py-3">
  <form method="POST" action="{{ url('/stores') }}">
  {{ csrf_field() }}
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <label for="name">Nombre del comercio</label>
            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') ? old('name') : '' }}">
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email">Email de contacto</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : Auth::user()->email }}">
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
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ? old('phone') :'' }}">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="mobile">Movil <i class="fa fa-whatsapp"></i></label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') ? old('mobile') : '' }}">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="schedule">Horarios <i class="fa fa-clock-o"></i></label>
            <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule') ? old('schedule') : '' }}" placeholder="ej. Lunes a Viernes 9:00 am a 5:00 pm">
          </div>

          <div class="card my-3">
            <div class="card-header">Datos Geográfico</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="city">Ciudad</label>
                    <select name="city" id="city" class="form-control">
                      <option value="Acacias" {{ old('city') == "Acacias" ? 'selected' : '' }}>Acacias</option>
                      <option value="Villavicencio" {{ old('city') == "Villavicencio" ? 'selected' : '' }}>Villavicencio</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ? old('address') : '' }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
              <label for="description">Description corta</label>
              <textarea class="form-control" id="description" name="description" placeholder="Describe tu comercio, dinos a que te dedicas y que es lo que ofreces." required>{{ old('description') ? old('description') : '' }}</textarea>
          </div>
        </div>
        <div class="col-sm-4">

        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Crear</button>
      </div>
  </form>
</div>
@endsection
