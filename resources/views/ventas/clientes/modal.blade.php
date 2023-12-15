<div class="modal fade" id="modal-delete-{{ $cli->id_persona }}">
    <div class="modal-dialog">
        <form action="{{ route('cliente.destroy', $cli->id_persona) }}" method="POST">
            @csrf
            @method('DELETE') <!-- para que el formulario sepa que se va a eliminar -->
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el cliente {{ $cli->nombre }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
