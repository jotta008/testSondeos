@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-6 margin-tb">
    <div class="pull-left">
      <h2>Editar Género</h2>
    </div>
  </div>
  <div class="col-lg-6 margin-tb align-right">
    <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('genders.index') }}"> Volver</a>
    </div>
  </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
  Hubo un error.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('genders.update',$gender->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
      <div class="form-group">
        <strong>Nombre:</strong>
        <input type="text" name="name" value="{{ $gender->name }}" class="form-control" placeholder="Nombre">
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>

</form>
@endsection