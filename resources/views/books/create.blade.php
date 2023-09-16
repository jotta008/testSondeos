@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>Crear Nuevo libro</h2>
        </div>
       
    </div>
    <div class="col-lg-6 margin-tb align-right">
        
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('genders.index') }}"> Atrás</a>
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
   
<form action="{{ route('books.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Isbn:</strong>
                <input type="text" name="isbn" class="form-control" placeholder="Isbn">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="title" class="form-control" placeholder="Título">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Autor:</strong>
                <input type="text" name="author" class="form-control" placeholder="Autor">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Precio:</strong>
                <input type="text" name="price" id="price" class="form-control" placeholder="Precio" pattern="^\d*(\.\d{0,2})?$" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Fecha de publicación:</strong>
                <input type="date" name="publication_date" class="form-control" placeholder="Fecha de publicación">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Género:</strong>
                <select name="gender_id" id="gender" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
   
</form>
@push('js')
    <script>
        document.addEventListener('keydown', function(e) {
            console.log(e)
            var priceInput = document.getElementById('price');
            if (priceInput && e.target === priceInput) {
                var input = e.target;
                var oldVal = input.value;
                var regex = new RegExp(input.getAttribute('pattern'), 'g');
                
                setTimeout(function() {
                    var newVal = input.value;
                    if (!regex.test(newVal)) {
                        input.value = oldVal;
                    }
                }, 1);
            }
        });
    </script>
    
@endpush
@endsection