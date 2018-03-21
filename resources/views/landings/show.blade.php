@extends('layouts.app')

@section('title', $landing->name. ' | '. $landing->store->name)
@section('meta-keywords', $landing->metakeywords)
@section('meta-description', $landing->metadescription)

@section('content')

  <div class="store">
    @include('partials.landings.header', ['landing' => $landing])
    <div class="container py-3">
      {!! $landing->content !!}
    </div>
  </div>

@if($record)
  <div class="floatingChat">
    @include('partials.chat', ['record' => $record])
  </div>
@endif
@endsection
