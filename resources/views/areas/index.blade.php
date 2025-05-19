@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')

<div class="d-flex justify-content-md-end mb-4">
    <a href="{{ route('areaCreate') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>

 <div class="container-fluid">
  <table class="table">
  <tbody>
    @foreach ($areas as $area)
        <tr>
          <td>{{ $area->id }}</td>
          <td>{{ $area->Nombre }}</td>
          <td>{{ $area->Descripcion }}</td>
        </tr>
    @endforeach
  </tbody>
  <tbody>
    <tr>
    
    </tr>
  </tbody>
</table>
 </div>
@stop