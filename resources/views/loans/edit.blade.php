@extends('adminlte::page')

@section('title', 'Editar préstamo | IDEX PERÚ JAPÓN')

@section('content_header')
  <h1>Editar traslado</h1>
@stop

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('loanUpdate', $movement->id) }}" onsubmit="updateMaterialsField()" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-4">
                <label>Usuario:</label>
                <input type="text" name="fecha_prestamo" class="form-control" value="{{ auth()->user()->name }}" required disabled>
            </div>
            <div class="mb-3 col-3">
                <label>Área a enviar:</label>
                <select name="destinationSector" class="form-control" required>
                    @foreach ($sectorsData as $sectorData)
                        <option value="{{ $sectorData->id }}" {{ old('classroom_id') == $sectorData->id ? 'selected' : '' }}> {{ $sectorData->name}}
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-3">
                <label>Fecha Traslado:</label>
                <input type="date" name="fecha_prestamo" class="form-control" value="{{ $date }}" required>
            </div>

            <div class="mb-3 col-3">
                <label>Fecha Devolución:</label>
                <input type="date" name="fecha_devolucion" class="form-control" value="">
            </div>
        </div>

        <hr>
        <h5>Editar materiales</h5>
        <div class="row align-items-end">
            <div class="col-3">
                <label>Aula:</label>
                <select class="form-control" id="area_id" onchange="loadMaterials(this.value)">
                    <option value="">Seleccione un aula</option>
                    @foreach($sectorsData as $sectorData)
                        <option value="{{ $sectorData->id }}">{{ $sectorData->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label>Material:</label>
                <select class="form-control" id="material_id">
                    <option value="">Seleccione un material</option>
                </select>
            </div>

            <div class="col-2">
                <label>Cantidad:</label>
                <input type="number" id="input_cantidad" class="form-control" value="1" min="1">
            </div>

            <div class="col-3">
                <label>Estado:</label>
                <select class="form-control" id="input_estado" value="{{ $movement->status}}">
                    <option value="Reparacion">Reparación</option>
                    <option value="Traslado">Traslado</option>
                </select>
            </div>

            <div class="col-1">
                <button type="button" class="btn btn-success" onclick="addMaterial()">+</button>
            </div>
        </div>

        <hr>
        <h5>Materiales añadidos</h5>
        <table class="table table-bordered" id="materialsTable">
            <thead class="table-dark">
                <tr>
                    <th>Material</th>
                    <th>Aula</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <input type="hidden" name="materials_json" id="materials_json">

        <button type="submit" class="btn btn-primary mt-3">Actualizar registro</button>
    </form>
</div>
<script>
    window.materials = @json($movementDetails);
</script>
<script src="/js/loanscript/loanscript.js"></script>
@endsection
