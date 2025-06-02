@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Nueva aula</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('classroomSave') }}" id="formSaveID" method="POST">
            @csrf         
            <div class="mb-3 col-4">
                <label for="nombre" class="form-label">Nombre del Área</label>
                <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>

            <button type="submit" id="btnGuardar" class="btn btn-success">Guardar</button>
            <a href="{{ route('classroomList') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="container">
        <div class="overlay center" id="loader" style="display: none;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
    </div>

    <script src="/js/loanscript/loader.js"></script>
@stop