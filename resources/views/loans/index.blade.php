@extends('adminlte::page')

@section('title', 'Lista de préstamos | IDEX PERÚ JAPÓN')

@section('content_header')
  <h1>Registro de movimientos</h1>
@stop

@section('content')

  <div class="d-flex justify-content-md-end mb-4">
      <a href="{{ route('loanCreate') }}" class="btn btn-primary">
          <i class="bi bi-plus-lg"></i> Nuevo
      </a>
  </div>

  <div class="container-fluid">
      <div class="table-responsive">
          <table class="table table-striped table-bordered">
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
                            
                            <td>
                                @foreach($data->prestamoMateriales as $pm)
                                    <div>{{ $pm->material->nombre ?? 'Sin material' }}</div>
                                @endforeach
                            </td>

                            <td>{{ $data->alumno->Nombre ?? 'N/A' }}</td>
                            
                            <td>
                                @foreach($data->prestamoMateriales as $pm)
                                    <div>{{ $pm->area->nombre ?? 'Sin área' }}</div>
                                @endforeach
                            </td>

                            <td>{{ $data->fecha_prestamo }}</td>

                            <td>
                                @foreach($data->prestamoMateriales as $pm)
                                    <div>{{ ucfirst($pm->estado) }}</div>
                                @endforeach
                            </td>

                            <td>
                                <a href="{{ route('loanEdit', $data->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('loanDestroy', $data->id) }}" method="POST" style="display:inline-block">
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
