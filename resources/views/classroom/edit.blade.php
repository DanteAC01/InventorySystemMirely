@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')
 <div class="container-fluid">
    <form action="{{ route('classroomUpdate', $sectorData->id) }}" method="POST">
        @csrf
        @method('PUT')   
        <div class="mb-3 col-4">
            <label for="name" class="form-label">Nombre del Área</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $sectorData->name}}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('classroomList') }}" class="btn btn-secondary">Cancelar</a>
    </form>
 </div>
@stop