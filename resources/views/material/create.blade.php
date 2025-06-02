@extends('adminlte::page')

@section('title', 'Nuevo ingreso | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Agregar un nuevo material</h1>
@stop

@section('content')
    <div class="container-fluid">
    <form method="POST" id="formSaveID" action="{{ route('materialSave') }}">
        @csrf
        <div class="row">
            <div class="mb-3 col-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3 col-1">
                <label for="total" class="form-label">Cantidad Total:</label>
                <input type="number" name="total" class="form-control" required>
            </div>
            

            <div class="mb-3 col-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" class="form-control" required>
                    <option value="">-- Selecciona un estado --</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="usado">Usado</option>
                    <option value="deteriorado">Deteriorado</option>
                    <option value="en reparación">En reparación</option>
                    <option value="dado de baja">Dado de baja</option>
                </select>
            </div>

            <div class="mb-3 col-2">
                <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" name="fecha_ingreso" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" required>
            </div>

            <div class="mb-3 col-2">
                <label for="area_id" class="form-label">Área:</label>
                <select name="area_id" class="form-control" required>
                    @foreach ($classroomData as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    </div>
    <div class="container">
        <div class="overlay center" id="loader" style="display: none;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>

    <script src="/js/loanscript/loader.js"></script>
@stop