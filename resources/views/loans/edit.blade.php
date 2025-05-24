@extends('adminlte::page')

@section('title', 'Editar prestamo | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Editar prestamo</h1>
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

    <form method="POST" action="{{ route('loanUpdate', $loan->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-3">
                <label>Alumno:</label>
                <select name="alumno_id" class="form-control" required>
                    @foreach ($AlumnosData as $AlumnoData)
                        <option value="{{ $AlumnoData->id }}"
                            @if(old('alumno_id', $loan->alumno_id) == $AlumnoData->id) selected @endif>
                            {{ $AlumnoData->Nombre }} ({{ $AlumnoData->dni }})
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3 col-2">
                <label>Fecha Préstamo:</label>
                <input type="date" name="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo', $loan->fecha_prestamo) }}" required>
            </div>
            <div class="mb-3 col-2">
                <label>Fecha Devolución:</label>
                <input type="date" name="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion', $loan->fecha_devolucion) }}">
            </div>
            <div class="mb-3 col-1">
                <label>Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $loan->cantidad) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label>Aula:</label>
                <select class="form-control" name="area_id" id="area_id" onchange="loadMaterials(this.value)" required>
                    <option value="">Seleccione un aula</option>
                    @foreach($classroomsData as $area)
                        <option value="{{ $area->id }}"
                            @if(old('area_id', $loan->material->area_id) == $area->id) selected @endif>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-3">
                <label for="material_id">Material:</label>
                <select class="form-control" name="material_id" id="material_id" required>
                    <option value="">Seleccione un material</option>
                    <option value="{{ $loan->material_id }}" selected>{{ $loan->material->nombre }}</option>
                </select>
            </div>

            <div class="mb-3 col-2">
                <label>Estado:</label>
                <select name="estado" class="form-control" required>
                    @foreach(['prestado', 'devuelto', 'pendiente', 'perdida'] as $estado)
                        <option value="{{ $estado }}"
                            @if(old('estado', $loan->estado) == $estado) selected @endif>
                            {{ ucfirst($estado) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>




        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
 </div>
<script src="js/loanscript/loanscript.js"></script>
@endsection