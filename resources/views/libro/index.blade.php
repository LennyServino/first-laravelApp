@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        
            <strong>Mensaje: </strong>{{ Session::get('mensaje') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('libro.create') }}" class="btn btn-success">Subir juego</a>
        </div>
        <div class="card-body">

            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Url</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                            <tr class="">
                                <td>{{ $libro->id }}</td>
                                <td>{{ $libro->nombre }}</td>
                                <td>{{ $libro->url }}</td>
                                <td>
                                    <img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$libro->imagen) }}" alt="" width="50">
                                </td>
                                <td>
                                    <a href="{{ route('libro.edit', $libro->id )}}" class="btn btn-warning">Editar</a> | 
                                    <form class="d-inline" action="{{ route('libro.destroy', $libro->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">{!! $libros->links() !!}</div>
    </div>
</div>
@endsection