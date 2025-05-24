@extends('adminlte::page')

@section('title', 'Lista de préstamos | IDEX PERÚ JAPÓN')

@section('content_header')
  <h1>Lista de préstamos</h1>
@stop

@section('content')

  <div class="d-flex justify-content-md-end mb-4">
      <a href="{{ route('loanCreate') }}" class="btn btn-primary">
          <i class="bi bi-plus-lg"></i> Nuevo
      </a>
  </div>

  <div class="container-fluid">
      <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered">
              <thead class="table-dark">
                  <tr>
                      <th>ID</th>
                      <th>Material</th>
                      <th>Estudiante</th>
                      <th>Área</th>
                      <th>Fecha préstamo</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($loansDataList as $data)
                      <tr>
                          <td>{{ $data->id }}</td>
                          <td>{{ $data->material->nombre }}</td>
                          <td>{{ $data->alumno->Nombre ?? 'N/A' }}</td>
                          <td>{{ $data->material->area->nombre ?? 'N/A' }}</td>
                          <td>{{ $data->fecha_prestamo }}</td>
                          <td>{{ ucfirst($data->estado) }}</td>
                          <td>
                              <a href="{{ route('loanEdit', $data->id) }}" class="btn btn-sm btn-primary">
                                  Editar
                              </a>

                              <form action="{{ route('loanDestroy', $data->id) }}" method="POST" style="display:inline-block;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este préstamo?')">
                                      Borrar
                                  </button>
                              </form>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="7" class="text-center text-muted">No hay préstamos registrados.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>

@stop
