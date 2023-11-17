<div class="modal fade" id="abrirRecallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Abrir recall</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('recall.abrir') }}" method="POST" enctype="multipart/form-data" id="abrirRecallForm">
                    @csrf
                    <input type="hidden" name="id_recall" value="{{ $recall->id }}" >
                    <div class="row">
                        <div class="col-md-12">
                            <p>Usted está a punto de abrir el recall.¿Está seguro que desea continuar?</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#abrirRecallForm').submit()">Sí</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>