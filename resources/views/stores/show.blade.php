@extends('layouts.app')

@section('title', $store->name)
@section('meta-keywords', $store->metakeywords)
@section('meta-description', $store->metadescription)

@section('content')

  <div class="store">
    @include('partials.stores.header', ['store' => $store])
    <div class="container py-3">
      {!! $store->content !!}
    </div>
  </div>

@if($record)
  <div class="floatingChat">
    @include('partials.chat', ['record' => $record])
  </div>
@endif
@endsection
