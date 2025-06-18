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
                        <th>Usuario</th>
                        <th>Área</th>
                        <th>Fecha de traslado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movementDataList as $movement)
                        <tr>
                            <td>{{ $movement->id }}</td>

                            <td>
                                @foreach($movement->movementDetails as $detail)
                                    <div>{{ $detail->material->name ?? 'Sin material' }}</div>
                                @endforeach
                            </td>

                            <td>{{ $movement->user->name ?? 'N/A' }}</td>

                            <td>
                                @foreach($movement->movementDetails as $detail)
                                    <div>{{ $detail->material->sector->name ?? 'Sin área' }}</div>
                                @endforeach
                            </td>

                            <td>{{ $movement->date }}</td>

                            <td>
                                @foreach($movement->movementDetails as $detail)
                                    <div>{{ ucfirst($detail->status) }}</div>
                                @endforeach
                            </td>

                            <td>
                                <a href="{{ route('loanEdit', $movement->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('loanDestroy', $movement->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este movimiento?')">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay movimientos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
          </table>
      </div>
  </div>

@stop
