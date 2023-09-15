@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Edit Gender</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
    </div>
  </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
  There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('books.update',$book->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Isbn:</strong>
          <input type="text" name="isbn" class="form-control" placeholder="Isbn" value="{{ $book->isbn }}">
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Título:</strong>
          <input type="text" name="title" class="form-control" placeholder="Título" value="{{ $book->title }}">
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Autor:</strong>
          <input type="text" name="author" class="form-control" placeholder="Autor" value="{{ $book->author }}">
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Precio:</strong>
          <input type="text" name="price" id="price" class="form-control" placeholder="Precio" pattern="^\d*(\.\d{0,2})?$" value="{{ $book->price }}" >
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Fecha de publicación:</strong>
          <input type="date" name="publication_date" class="form-control" placeholder="Fecha de publicación" value="{{ $book->publication_date }}">
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Género:</strong>
          <select name="gender_id" id="gender">
              <option value="">Seleccione</option>
              @foreach ($genders as $gender)
                  <option value="{{ $gender->id }}" {{$book->gender_id === $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
              @endforeach
          </select>
      </div>
  </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Editar</button>
    </div>
  </div>

</form>
@endsection