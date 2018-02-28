@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <div class="jumbotron">
          <h1>{{ $store->name }}</h1>
          {{ $store->content }}
      </div>
    </div>
    <div class="col-sm-4">
      @include('partials.chat')
    </div>
  </div>
</div>
@endsection
