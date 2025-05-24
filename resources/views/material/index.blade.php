@extends('adminlte::page')

@section('title', 'Lista de materiales | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de materiales</h1>
@stop

@section('content')
  <div class="d-flex justify-content-md-end mb-4">
      <a href="{{ route('materialCreate') }}" class="btn btn-primary">
          <i class="bi bi-plus-lg"></i> Nuevo
      </a>
  </div>

 <div class="container-fluid">
  <div class="row">
    @foreach ($classroomDataMaterial as $data)
      <div class="col-md-4 mb-4">
        <a href="{{ route('materialShow', $data->id) }}" class="text-decoration-none text-dark">
          <div class="card border-primary shadow-sm h-100">
            <div class="card-header">
              <h2 class="card-title">{{ $data->nombre }}</h2>
            </div>
            <div class="card-body">
              <p class="card-text">
                <strong>{{ $data->materiales_count }}</strong> tipos materiales registrados
              </p>
            </div>
            <div class="card-footer bg-primary text-white text-center">
              Ver detalles
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
 </div>
@stop