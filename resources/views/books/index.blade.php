@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>Libros</h2>
        </div>
    </div>
    <div class="col-lg-6 margin-tb new">
        <a class="btn btn-success" href="{{ route('books.create') }}"> Crear nuevo libro</a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ISBN</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Price</th>
            <th>Fecha de publicación</th>
            <th>Género</th>
            <th width="280px">Acción</th>
        </tr>
    </thead>
    <tbody class="table-striped">

        @foreach ($books as $book)
        <tr>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>${{ $book->price }}</td>
            <td>{{ $book->publication_date }}</td>
            <td>{{ $book->getGender->name }}</td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
    
                    <a class="btn btn-light" href="{{ route('books.show',$book->id) }}"><i class="fa-solid fa-eye"></i></a>
    
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $books->links() !!}
@endsection