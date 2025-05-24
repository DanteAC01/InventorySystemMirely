@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')
 <div class="container-fluid">
    <form action="{{ route('classroomUpdate', $classroom->id) }}" method="POST">
        @csrf
        @method('PUT')   
        <div class="mb-3 col-4">
            <label for="nombre" class="form-label">Nombre del Área</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $classroom->nombre}}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('classroomList') }}" class="btn btn-secondary">Cancelar</a>
    </form>
 </div>
@stop