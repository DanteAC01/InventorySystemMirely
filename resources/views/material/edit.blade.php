@extends('adminlte::page')

@section('title', 'Nuevo ingreso | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')
 <div class="container-fluid">
  <form action="{{ route('materialUpdate', $material->id) }}" method="POST" >
    @csrf
    @method('PUT')
     <div class="row">
      <div class="mb-3 col-3">
       <label for="name" class="form-label">Nombre:</label>
       <input type="text" name="name" class="form-control" value="{{ old('nombre', $material->name) }}" required>
      </div>

      <div class="mb-3 col-1">
       <label for="quantity" class="form-label">Cantidad:</label>
       <input type="number" name="quantity" class="form-control" value="{{ old('total', $material->quantity) }}" required>
      </div>
         
      <div class="mb-3 col-3">
       <label for="status" class="form-label">Estado:</label>
       <select name="status" class="form-control" required>
         @foreach (['nuevo', 'usado', 'deteriorado', 'en reparación', 'dado de baja'] as $estado)
             <option value="{{ $material->status }}" @if(old('status', $material->status) === $estado) selected @endif>{{ ucfirst($estado) }}</option>
         @endforeach
       </select>
      </div>

      <div class="mb-3 col-2">
       <label for="dateEntry" class="form-label">Fecha de Ingreso:</label>
       <input type="date" name="dateEntry" class="form-control" value="{{ old('dateEntry', $material->dateEntry) }}" required>
      </div>
     </div>
     <div class="row">
      <div class="mb-3 col-6">
       <label for="description" class="form-label">Descripción:</label>
       <input type="text" name="description" class="form-control" value="{{ old('description', $material->description) }}" required>
      </div>

      <div class="mb-3 col-2">
       <label for="sector_id" class="form-label">Área:</label>
       <select name="sector_id" class="form-control" required>
        @foreach ($sectorData as $sector)
         <option value="{{ $sector->id }}">{{ $sector->name }}</option>
        @endforeach
       </select>
      </div>
  </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
 </div>
@stop