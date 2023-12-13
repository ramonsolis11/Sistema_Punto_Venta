<div class="modal fade" id="modal-delete-{{ $prod->id_producto }}">
    <div class="modal-dialog">
        <form action="{{ route('producto.destroy', $prod->id_producto) }}" method="POST"> // Ruta para eliminar
            @csrf
            @method('DELETE')  <!-- Method to remove -->
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el producto {{ $prod->nombre }}</p> <!-- Confirmation message -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

