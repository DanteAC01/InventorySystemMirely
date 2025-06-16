@extends('adminlte::page')

@section('title', 'Nuevo ingreso | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')
 <div class="container-fluid">
  <form method="POST" action="{{ route('materialUpdate', $material->id) }}">
    @csrf
    @method('PUT')
     <div class="row">
      <div class="mb-3 col-3">
       <label for="nombre" class="form-label">Nombre:</label>
       <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $material->nombre) }}" required>
      </div>

      <div class="mb-3 col-1">
       <label for="total" class="form-label">Cantidad Total:</label>
       <input type="number" name="total" class="form-control" value="{{ old('total', $material->total) }}" required>
      </div>
         

      <div class="mb-3 col-3">
       <label for="estado" class="form-label">Estado:</label>
       <select name="estado" class="form-control" required>
         @foreach (['nuevo', 'usado', 'deteriorado', 'en reparación', 'dado de baja'] as $estado)
             <option value="{{ $estado }}" @if(old('estado', $material->estado) === $estado) selected @endif>{{ ucfirst($estado) }}</option>
         @endforeach
       </select>
      </div>

      <div class="mb-3 col-2">
       <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
       <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $material->fecha_ingreso) }}" required>
      </div>
     </div>
     <div class="row">
      <div class="mb-3 col-6">
       <label for="descripcion" class="form-label">Descripción:</label>
       <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $material->descripcion) }}" required>
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
@stop