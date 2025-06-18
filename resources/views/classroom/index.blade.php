@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')

<div class="d-flex justify-content-md-end mb-4">
    <a href="{{ route('classroomCreate') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>

 <div class="container-fluid">
  <table class="table">
  <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($sectorsData as $data)
      <tr>
        <td>{{ $data->id }}</td>
        <td>{{ $data->name }}</td>
        <td>
          <a href="{{ route('classroomEdit', $data->id) }}" class="btn btn-sm btn-secondary">Editar</a>

          <form action="{{ route('classroomDestroy', $data->id) }}" method="POST" style="display:inline-block;">
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
  <tbody>
    <tr>
    
    </tr>
  </tbody>
</table>
 </div>
@stop