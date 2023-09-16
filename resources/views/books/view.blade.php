@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-6 margin-tb">
    <div class="pull-left">
      <h2> Ver Libro</h2>
    </div>
  </div>
  <div class="col-lg-6 margin-tb align-right">
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('books.index') }}"> Volver</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="form-group">
      <strong>Isbn:</strong>
      {{ $book->isbn }}
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="form-group">
      <strong>Título:</strong>
      {{ $book->title }}
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="form-group">
      <strong>Autor:</strong>
      {{ $book->author }}
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="form-group">
      <strong>Precio:</strong>
      ${{ $book->price }}
    </div>
  </div>
</div>
<div class="row mt-4">
    
  <div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group">
      <strong>Fecha de publicación:</strong>
      {{ $book->publication_date }}
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="form-group">
      <strong>Género:</strong>
      {{ $book->getGender->name }}
    </div>
</div>
@endsection