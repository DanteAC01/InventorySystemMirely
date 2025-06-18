@extends('adminlte::page')

@section('title', 'Nuevo préstamo | IDEX PERÚ JAPÓN')

@section('content_header')
  <h1>Nuevo traslado</h1>
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

        <form method="POST" id="formSaveID" action="{{ route('loanSave') }}" onsubmit="updateMaterialsField()">
            @csrf

            <div class="row">
                <div class="mb-3 col-3">
                    <label>Usuario:</label>
                        <input type="text" name="user" class="form-control" value="{{ auth()->user()->name }}" disabled>
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
                    <input type="date" name="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo') }}" required>
                </div>

                <div class="mb-3 col-3">
                    <label>Fecha Devolución:</label>
                    <input type="date" name="fecha_devolucion" class="form-control">
                </div>
            </div>

            <hr>
            <h5>Enviar:</h5>
            <div class="row align-items-end">
                <div class="col-3">
                    <label>Área origen:</label>
                    <select class="form-control" id="area_id" onchange="loadMaterials(this.value)" required>
                        <option value="">Seleccione un aula</option>
                        @foreach($sectorsData as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <label>Material:</label>
                    <select class="form-control" id="material_id" required>
                        <option value="">Seleccione un material</option>
                    </select>
                </div>

                <div class="col-2">
                    <label>Cantidad:</label>
                    <input type="number" id="input_cantidad" class="form-control" value="1" min="1" required>
                </div>

                <div class="col-3">
                    <label>Estado:</label>
                    <select class="form-control" id="input_estado" required>
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
                        <th>Aula</th>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="materialsBody">
                    <tr class="text-center text-muted">
                        <td colspan="5">No hay materiales añadidos.</td>
                    </tr>
                </tbody>
            </table>

            <!-- Hidden field for JSON data -->
            <input type="hidden" name="materials_json" id="materials_json">

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
    <div class="container">
        <div class="overlay center" id="loader" style="display: none;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>

    <script src="/js/loanscript/loader.js"></script>
    <script src="/js/loanscript/loanscriptmanager.js"></script>
@endsection
