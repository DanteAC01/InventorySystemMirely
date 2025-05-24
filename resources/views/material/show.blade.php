@extends('adminlte::page')

@section('title', 'Detalle del Área | IDEX PERÚ JAPÓN')

@section('content_header')
    <h1>Detalle del Área: {{ $va->nombre }}</h1> {{-- Asegúrate de tener un campo "nombre" en la tabla areas --}}
@stop

@section('content')

<div class="d-flex justify-content-md-end mb-4">
    <a href="{{ route('materialCreate') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva Área
    </a>
</div>

<div class="container-fluid">
    <h4>Bienes y materiales del area:</h4>

    @if($va->materiales->isEmpty())
        <p>No hay materiales registrados para esta área.</p>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>nombre</th>
                    <th>total de ingreso</th>
                    <th>cantidad disponible</th>
                    <th>estado</th>
                    <th>fecha ingreso</th>
                    <th>Area</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($va->materiales as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->nombre }}</td>
                        <td>{{ $material->total}}</td>
                        <td>{{ $material->cantidad_disponible}}</td>
                        <td>{{ $material->estado}}</td>
                        <td>{{ $material->fecha_ingreso}}</td>
                        <td>{{ $material->area->nombre}}</td>
                        <td>
                            <a href="{{ route('materialEdit', $material->id) }}" class="btn btn-sm btn-secondary">Editar</a>

                            <form action="{{ route('materialDestroy', $material->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este aula?')">
                                Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@stop
