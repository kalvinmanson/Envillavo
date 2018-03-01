@extends('layouts.app')

@section('content')

  <div class="store">
    <div class="cover" style="background-image: url({{ $store->cover }})">
      <div class="container">
        <div class="row py-3 py-lg-5">
          <div class="col-sm-3 text-center">
            <img src="{{ $store->logo }}" class="rounded-circle img-fluid">
          </div>
          <div class="col-md-9">
            <h1>{{ $store->name }}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-3">
      {!! $store->content !!}
    </div>
  </div>


<div class="floatingChat">
  @include('partials.chat')
</div>
@endsection
