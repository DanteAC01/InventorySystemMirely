@extends('adminlte::page')

@section('title', 'Lista de areas | IDEX PERÚ JAPÓN')

@section('content_header')
 <h1>Lista de areas</h1>
@stop

@section('content')

<div class="d-flex justify-content-md-end mb-4">
    <a href="{{ route('areacreate') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>

 <div class="container-fluid">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
 </div>
@stop