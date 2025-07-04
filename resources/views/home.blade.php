@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Reportes</b></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Material</th>
                        <th>origen</th>
                        <th>destino</th>
                        <th>fecha Entrega</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimientos as $mov)
                        <tr>
                            <td>{{ $mov->id }}</td>

                            {{-- Puedes listar múltiples materiales si hay varios en movementDetails --}}
                            <td>
                                @foreach ($mov->movementDetails as $detalle)
                                    {{ $detalle->material->name  ?? '—' }}<br>
                                @endforeach
                            </td>

                            <td>{{ $mov->originSector->name ?? '—' }}</td>
                            <td>{{ $mov->destinationSector->name ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($mov->date)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($mov->type === 'salida')
                                    <form action="{{ route('movements.markAsReturned', $mov->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" title="Confirmar devolución">
                                            ✓
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Devuelto</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop