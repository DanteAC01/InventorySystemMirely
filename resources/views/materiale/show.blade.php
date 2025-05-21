@extends('adminlte::page')

@section('title', 'Detalle del Área | IDEX PERÚ JAPÓN')

@section('content_header')
    <h1>Detalle del Área: {{ $va->nombre }}</h1> {{-- Asegúrate de tener un campo "nombre" en la tabla areas --}}
@stop

@section('content')

<div class="d-flex justify-content-md-end mb-4">
    <a href="{{ route('areaCreate') }}" class="btn btn-primary">
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
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Fecha de ingreso</th>
                    <th>Area</th>
                </tr>
            </thead>
            <tbody>
                @foreach($va->materiales as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->nombre }}</td>
                        <td>{{ $material->estado}}</td>
                        <td>{{ $material->fecha_ingreso}}</td>
                        <td>{{ $material->area->Nombre}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@stop
