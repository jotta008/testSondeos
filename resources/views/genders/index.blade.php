@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>Géneros</h2>
        </div>
    </div>
    <div class="col-lg-6 margin-tb align-right">
        <a class="btn btn-success" href="{{ route('genders.create') }}"> Crear nuevo género</a>
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
            <th>ID</th>
            <th>Nombre</th>
            <th width="280px">Acción</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        @foreach ($genders as $gender)
        <tr>
            <td>{{ $gender->id }}</td>
            <td>{{ $gender->name }}</td>
            <td>
                <form action="{{ route('genders.destroy',$gender->id) }}" method="POST">

                    <a class="btn btn-light" href="{{ route('genders.show',$gender->id) }}"><i
                            class="fa-solid fa-eye"></i></a>

                    <a class="btn btn-primary" href="{{ route('genders.edit',$gender->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="container">
    <div class="row">
        {!! $genders->links() !!}
    </div>
</div>
</div>
<script>
    function confirmDelete() {
        if(!confirm('¿Estás seguro de que quieres eliminar este género?')) event.preventDefault();

    }
    document.querySelectorAll('.btn-danger').forEach(function(button) {
        button.onclick = confirmDelete;
    });
</script>

@endsection