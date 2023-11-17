<div class="modal fade" id="cerrarRecallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cerra recall</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('recall.cerrar') }}" method="POST" enctype="multipart/form-data" id="cerrarRecallForm">
                    @csrf
                    <input type="hidden" name="id_recall" value="{{ $recall->id }}" >
                    <div class="row">
                        <div class="col-md-12">
                            <p>Usted está a punto de Cerrar y subir el archivo de cierre de Recall ¿Está seguro que desea continuar?</p>
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">Documento de cierre</label>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" name="documento_cierre" class="custom-file-input" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#cerrarRecallForm').submit()">Sí</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>