<div class="modfal fade" id="modal-delete-{{ $cat->id_categoria }}">
    <div class="modal-dialog">
        <form action="{{ route('categoria.destroy', $cat->id_categoria) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de eliminar la categoría
                        <strong>{{ $cat->categoria }}</strong>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
