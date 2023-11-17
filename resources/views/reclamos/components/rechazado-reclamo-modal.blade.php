<div class="modal fade" id="rechazadoReclamoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reclamo Rechazado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="buscarReclamoForm">
                    @csrf
                    <input type="hidden" name="id" id="id_reclamo_form">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Datos de rechazo</p>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Responsable:</label> <span id="responsableRechazoReclamoSpan"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Fecha:</label> <span id="fechaRechazoReclamoSpan"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Motivo:</label> <span id="mensajeRechazoReclamoSpan"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function fnSearchReclamo(id) {
        $('#id_reclamo_form').val(id);
        $.post("{{ route('reclamos.buscar') }}",$('#buscarReclamoForm').serialize(), function (response) {
                //console.log(response)
                var fechaFormateada = moment(response.data.fecha_rechazo).format('DD-MM-YYYY');
                $('#fechaRechazoReclamoSpan').html(fechaFormateada)
                $('#responsableRechazoReclamoSpan').html(response.data.responsable_rechazo.name+' '+response.data.responsable_rechazo.last_name);
                $('#mensajeRechazoReclamoSpan').html(response.data.mensaje_rechazo);
            },
            "json"
        );
    }
</script>