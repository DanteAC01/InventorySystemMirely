@extends('adminlte::page')

@section('title', 'Editar préstamo | IDEX PERÚ JAPÓN')

@section('content_header')
  <h1>Editar préstamo</h1>
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

    <form method="POST" action="{{ route('loanUpdate', $loan->id) }}" onsubmit="updateMaterialsField()">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-4">
                <label>Alumno:</label>
                <select name="alumno_id" class="form-control" required>
                    @foreach ($alumnosData as $alumnoData)
                        <option value="{{ $alumnoData->id }}" {{ old('alumno_id', $loan->alumno_id) == $alumnoData->id ? 'selected' : '' }}>
                            {{ $alumnoData->Nombre }} - {{ $alumnoData->dni }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-3">
                <label>Fecha Préstamo:</label>
                <input type="date" name="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo', $loan->fecha_prestamo) }}" required>
            </div>

            <div class="mb-3 col-3">
                <label>Fecha Devolución:</label>
                <input type="date" name="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion', $loan->fecha_devolucion) }}">
            </div>
        </div>

        <hr>
        <h5>Editar materiales</h5>
        <div class="row align-items-end">
            <div class="col-3">
                <label>Aula:</label>
                <select class="form-control" id="area_id" onchange="loadMaterials(this.value)">
                    <option value="">Seleccione un aula</option>
                    @foreach($classroomsData as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
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
                <select class="form-control" id="input_estado">
                    <option value="prestado">Prestado</option>
                    <option value="devuelto">Devuelto</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="perdida">Pérdida</option>
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

        <button type="" class="btn btn-primary mt-3">Actualizar préstamo</button>
    </form>
</div>
<script>
    window.materials = @json($prestamoMaterialData);
</script>
<script src="/js/loanscript/loanscript.js"></script>
@endsection
