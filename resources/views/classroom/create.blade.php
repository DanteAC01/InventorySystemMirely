@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Nueva área</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('classroomSave') }}" id="formSaveID" method="POST">
            @csrf         
            <div class="mb-3 col-4">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" required>
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