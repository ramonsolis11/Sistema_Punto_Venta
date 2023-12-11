@extends('layouts.admin')
@section('contenido')
    <!-- left colum -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Producto</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('producto.store') }}" method="POST" class="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"
                            placeholder="Ingrese el nombre del nuevo producto">
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="id_categoria" class="form-control" id="idcategoria">
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->categoria }}">{{ $cat->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" class="form-control" name="codigo" id="codigo"
                                placeholder="Ingrese el codigo del producto">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock"
                                placeholder="Ingrese el stock del producto">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="unidad">Unidad</label>
                            <select name="unidad" class="form-control" id="unidad">
                                <option>Pieza</option>
                                <option>Kilos</option>
                                <option>Cajas</option>
                                <option>Paquetes</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion"
                                placeholder="Ingrese la descripcion del producto">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                        </div>
                    </div>


                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                        <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.row -->
@endsection
