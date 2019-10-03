@extends('layouts.app')

@section('title', $store->name)
@section('meta-keywords', $store->metakeywords)
@section('meta-description', $store->metadescription)

@section('content')

  <div class="store">
    @include('partials.stores.header', ['store' => $store])

    <div class="container py-3">
      <div class="landigns text-center">
        @foreach($store->landings as $landing)
        <div class="landingCard w-25 text-center d-inline-block">
          <img src="{{ $landing->picture or '/img/no-picture.jpg' }}" class="rounded-circle img-fluid px-5">
          <a href="/{{ $landing->store->slug }}/{{ $landing->slug }}"><h3>{{ $landing->name }}</h3></a>
          <p>{{ $landing->description }}</p>
        </div>
        @endforeach
      </div>

      <div class="row">
        <div class="col-sm-8">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- Parking -->
          <ins class="adsbygoogle"
               style="display:block"
               data-ad-client="ca-pub-3524399464499863"
               data-ad-slot="5369653209"
               data-ad-format="auto"
               data-full-width-responsive="true"></ins>
          <script>
               (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
          {!! $store->content !!}
        </div>
        <div class="col-sm-4">
          @foreach($store->blocks->where('format', 'photo') as $photo)
          <a href="{{ $photo->picture }}" data-fancybox data-caption="{{ $photo->description }}"><img src="{{ $photo->picture }}" class="w-50 d-inline-block"></a>
          @endforeach
        </div>

      </div>

    </div>
  </div>

@if($record)
  <div class="floatingChat">
    @include('partials.chat', ['record' => $record])
  </div>
@endif
@endsection
