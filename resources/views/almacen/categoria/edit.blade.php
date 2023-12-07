@extends('layouts.admin')
@section('contenido')
    <!-- left colum -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Editar Categoria {{ $categoria->categoria}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form action="{{ route('categoria.update' , $categoria->id_categoria) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="categoria" id="categoria" value="{{ $categoria->categoria }}"
                        placeholder="Ingrese el nombre de la categoria">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $categoria->descripcion }}"
                        placeholder="Ingrese la descripcion de la categoria">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection
