@extends('layouts.admin')

@section('contenido')

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Ingreso</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('ingreso.store') }}" method="POST" class="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Proveedor</label>
                        <select name="id_proveedor" class="form-control" id="id_proveedor">
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id_persona }}">{{ $persona->nombre }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo Documento</label>
                        <select name="tipo_documento" class="form-control" id="tipo_documento">
                            <option value="RTN">RTN</option>
                            <option value="DNI">DNI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_documento">Número Documento</label>
                        <input type="text" class="form-control" name="num_documento" id="num_documento"
                                placeholder="Ingresa el número de documento">
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
