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
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nombre">Proveedor</label>
                                <select name="id_proveedor" class="form-control" id="id_proveedor">
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id_persona }}">{{ $persona->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo Documento</label>
                                <select name="tipo_documento" class="form-control" id="tipo_documento">
                                    <option value="RTN">RTN</option>
                                    <option value="DNI">DNI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="num_documento">Número Documento</label>
                                <input type="text" class="form-control" name="num_documento" id="num_documento"
                                    placeholder="Ingresa el número de documento">
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nombre">Productos</label>
                                <select name="id_producto" class="form-control selectpicker" id="id_producto"
                                    data-live-search="true">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_producto }}">{{ $producto->Articulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" name="pcantidad" id="pcantidad"
                                    placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="pcompra">P. Compra</label>
                                <input type="number" class="form-control" name="pprecio_compra" step="0.01" min="0" id="pprecio_compra"
                                    placeholder="P. Compra">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="pventa">P. Venta</label>
                                <input type="number" class="form-control" name="pprecio_venta" step="0.01" min="0" id="pprecio_venta"
                                    placeholder="P. Venta">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="accion">Acción</label>
                                <button type="button" id="btn_add" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                    </div>

                        <div class="col-12">
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalles">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">
                                                <p align="right">SUBTOTAL:</p>
                                            </th>
                                            <th>
                                                <p align="right"><span id="subtotal">L 0.00</span> </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">
                                                <p align="right">TOTAL IMPUESTO (15%):</p>
                                            </th>
                                            <th>
                                                <p align="right"><span id="total_impuesto">L 0.00</span> </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">
                                                <p align="right">TOTAL:</p>
                                            </th>
                                            <th>
                                                <p align="right"><span align="right" id="total_pagar_html">L 0.00</span>
                                                    <input type="hidden" name="total_pagar" id="total_pagar"></p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <input type="hidden name="token" value="{{ csrf_token() }}" id="token">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                            <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                        </div>
                    </div>
                </div>

        </div>
        </form>
    </div>
    <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection
