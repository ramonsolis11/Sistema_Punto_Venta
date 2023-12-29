@extends('layouts.admin')

@section('contenido')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Ingreso</h3>
            </div>
            
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


                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nombre">Productos</label>
                                <select name="idarticulo" class="form-control selectpicker" id="idarticulo"
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
                                <input type="number" class="form-control" name="pprecio_compra" step="0.01"
                                    min="0" id="pprecio_compra" placeholder="P. Compra">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="pventa">P. Venta</label>
                                <input type="number" class="form-control" name="pprecio_venta" step="0.01"
                                    min="0" id="pprecio_venta" placeholder="P. Venta">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="accion">Acción</label>
                                <button type="button" id="btn_add"
                                    class="btn btn-block btn-outline-success">Agregar</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card-body">
                            <table id="detalles"
                                class="table table-striped table-bordered table-hover table-responsive-md">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>Subtotal</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">L. 0.00</h4>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    <input type="hidden" name="token" value="{{ csrf_token() }}" id="token">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                        <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#btn_add").click(function() {
                    agregar();
                });
            });

            var cont = 0;
            total = 0;
            subtotal = [];


            $("#btn_guardar").hide();


            $("#idarticulo").change(mostrarValores);

            function mostrarValores() {
                /
                datosArticulo = document.getElementById('idarticulo').value.split('_');

            }

            function agregar() {

                idarticulo = $("#idarticulo").val();
                articulo = $("#idarticulo option:selected").text();
                cantidad = $("#pcantidad").val();
                precio_compra = $("#pprecio_compra").val();
                precio_venta = $("#pprecio_venta").val();

                if (idarticulo != "" && cantidad != "" && cantidad > 0 && precio_compra != "" && precio_venta != "") {
                    subtotal[cont] = cantidad * precio_compra;
                    total += subtotal[cont];

                    var fila = '<tr class="selected" id="fila' + cont + '">' +
                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td>' +
                        '<td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + articulo + '</td>' +
                        '<td><input type="number" name="cantidad[]" value="' + cantidad + '" readonly></td>' +
                        '<td><input type="number" name="precio_compra[]" value="' + precio_compra + '" readonly></td>' +
                        '<td><input type="number" name="precio_venta[]" value="' + precio_venta + '" readonly></td>' +
                        '<td>' + subtotal[cont].toFixed(2) + '</td>' +
                        '</tr>';
                    cont++;
                    limpiar();
                    $("#total").html("L. " + total.toFixed(2));
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
                }
            }

            function limpiar() {
                $("#pcantidad").val("");
                $("#pprecio_compra").val("");
                $("#pprecio_venta").val("");
            }

            function evaluar() {
                if (total > 0) {
                    $("#btn_guardar").show();
                } else {
                    $("#btn_guardar").hide();
                }
            }

            function eliminar(index) {
                total -= subtotal[index];
                $("#total").html("L. " + total.toFixed(2));
                $("#fila" + index).remove();
                evaluar();
            }
        </script>
    @endpush
@endsection
