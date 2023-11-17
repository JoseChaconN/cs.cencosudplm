<div class="modal fade" id="notificarReclamoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notificar reclamo a locales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="notificarReclamoForm">
                    @csrf
                    <input type="hidden" name="id_reclamo" value="{{ $reclamo->id }}" >
                    <div class="row">
                        <div class="col-md-12">
                            <p>Seleccione a que cadena de locales desea enviar la notificación del reclamo para que los locales ingresen sus respuestas.</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="jumbo" name="local[]" id="cadena_jumbo">
                                    <label class="custom-control-label" for="cadena_jumbo">Cadena Jumbo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="sisa" name="local[]" id="cadena_sisa">
                                    <label class="custom-control-label" for="cadena_sisa">Cadena Sisa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="notificarBtn">Notificar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#notificarBtn').click(function (e) {
        $.post("{{ route('reclamo.notificar.respuestas') }}", $("#notificarReclamoForm").serialize(), function(response) {
            if(response.success){
                Swal.fire(
                    'La notificación se ha enviado correctamente.',
                    '',
                    'success'
                )
            }else{
                Swal.fire(
                    'No se pudo enviar la notificación. Intenta más tarde o contacta soporte.',
                    '',
                    'danger'
                )
            }
            $('#notificarReclamoModal').modal('hide')
        });
    });
</script>