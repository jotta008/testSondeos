@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Géneros</h2>
            </div>
            <div class="pull-right">
                {{-- <a class="btn btn-success" href="{{ route('genders.create') }}"> Create New gender</a> --}}
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($genders as $gender)
        <tr>
            <td>{{ $gender->id }}</td>
            <td>{{ $gender->name }}</td>
            <td>
                <form action="{{ route('genders.destroy',$gender->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('genders.show',$gender->id) }}">Ver</a>
    
                    <a class="btn btn-primary" href="{{ route('genders.edit',$gender->id) }}">Editar</a>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $genders->links() !!}
      
@endsection