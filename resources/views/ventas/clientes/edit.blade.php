@extends('layouts.admin')

@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Cliente</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('cliente.update' , $cliente->id_persona) }}" method="POST" class="form">
                @csrf {{-- directiva de blade para enviar el token csrf --}}
                @method('PUT') {{-- directiva de blade para enviar el formulario como metodo put --}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $cliente->nombre }}"
                                laceholder="Ingrese el nombre del cliente">
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo Documento</label>
                        <select name="tipo_documento" class="form-control" id="tipo_documento">
                            <option value="{{$cliente->tipo_documento}}">RTN</option>
                            <option value="{{$cliente->tipo_documento}}">DNI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_documento">Número Documento</label>
                        <input type="text" class="form-control" name="num_documento" id="num_documento" value="{{ $cliente->num_documento }}"
                                placeholder="Ingresa el número de documento">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $cliente->direccion }}"
                                placeholder="Ingresa la dirección">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $cliente->email }}"
                                placeholder="Ingresa el correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $cliente->telefono }}"
                                placeholder="Ingresa el teléfono">
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
