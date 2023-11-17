<div class="modal fade" id="rechazarReclamoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reclamo Rechazado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reclamos.rechazar',$reclamo->id) }}" id="rechazarReclamoForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <p>Datos de rechazo</p>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Motivo:</label>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="mensaje_rechazo" rows="10" placeholder="Motivo"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#rechazarReclamoForm').submit()">Rechazar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>