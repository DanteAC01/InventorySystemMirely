@extends('adminlte::page')

@section('title', 'Lista de materiales | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Nuevo prestamo</h1>
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

    <form method="POST" action="{{ route('loanSave') }}">
        @csrf
        <div class="row">
            <div class="mb-3 col-3">
                <label>Alumno:</label>
                <select name="alumno_id" class="form-control" required>
                    @foreach ($AlumnosData as $AlumnoData)
                        <option value="{{ $AlumnoData->id }}">{{ $AlumnoData->Nombre }} ({{ $AlumnoData->dni }})</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3 col-2">
                <label>Fecha Préstamo:</label>
                <input type="date" name="fecha_prestamo" class="form-control" required>
            </div>
            <div class="mb-3 col-2">
                <label>Fecha Devolución:</label>
                <input type="date" name="fecha_devolucion" class="form-control">
            </div>
            <div class="mb-3 col-1">
                <label>Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label>Aula:</label>
                <select class="form-control" name="area_id" id="area_id" onchange="loadMaterials(this.value)" required>
                    <option value="">Seleccione un aula</option>
                    @foreach($classroomsData as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-3">
                <label for="material_id">Material:</label>
                <select class="form-control" name="material_id" id="material_id" required>
                    <option value="">Seleccione un material</option>
                </select>
            </div>

            <div class="mb-3 col-2">
                <label>Estado:</label>
                <select name="estado" class="form-control" required>
                    <option value="prestado">Prestado</option>
                    <option value="devuelto">Devuelto</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="perdida">Perdida</option>
                </select>
            </div>
        </div>




        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
 </div>
<script src="js/loanscript/loanscript.js"></script>
@endsection