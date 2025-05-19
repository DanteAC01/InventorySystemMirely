@extends('adminlte::page')

@section('title', 'Nuevo ingreso | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')
 <div class="container-fluid">
  <form method="POST" action="{{ url('materialeSave') }}">
    @csrf
    
    <!-- Nombre -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre completo</label>
      <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>

    <!-- Estado -->
    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <select class="form-select" name="estado" id="estado" required>
        <option value="">Selecciona un estado</option>
        <option value="Nuevo">Nuevo</option>
        <option value="Deteriorado">Deteriorado</option>
        <option value="Perdida">Perdida</option>
      </select>
    </div>

    <!-- Fecha de ingreso -->
    <div class="mb-3">
      <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
      <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" required>
    </div>

    <!-- Área -->
    <div class="mb-3">
      <label for="area" class="form-label">Área</label>
      <select class="form-select" name="area_id" id="area_id" required>
        <option value="">Selecciona un área</option>
        @foreach ($areas as $area)
         <option value="{{ $area->id }}">{{$area->Nombre}}</option>
        @endforeach
      </select>
    </div>

    <!-- Botón -->
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
 </div>
@stop