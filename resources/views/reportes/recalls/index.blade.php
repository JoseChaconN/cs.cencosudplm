<x-layout>
	<x-slot name="breadcrumb">
		Reportes Recalls
	</x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Buscador Reportes de Recalls</h6>
	            </div>
	            <div class="card-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('reporte.recalls')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreProv">Reporte Área:</label>
                                        <select class="form-control form-control-sm selectpicker show-tick" name="area_reporte" id="area_reporte" data-live-search="true" title="Reporte Área">
                                            @foreach ($area_reportes as $key => $value)
                                                <option {{($value['val'] == $area_reporte) ? 'selected' : ''}} value="{{$value['val']}}">{{$value['text']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreProv">Tipo Reporte:</label>
                                        <select class="form-control form-control-sm selectpicker show-tick" name="tipo_reporte" id="tipo_reporte" data-live-search="true" title="Tipo Reporte">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreProv">Mes Creado:</label>
                                        <select class="form-control form-control-sm selectpicker show-tick" name="mes" id="mes" data-live-search="true" title="Mes Creado">
                                            <option value="99">Todos</option>
                                            @foreach ($meses_array as $key => $value)
                                                <option {{($key == $mes) ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreProv">Año Creado:</label>
                                        <select class="form-control form-control-sm selectpicker show-tick" name="ano" id="ano" data-live-search="true" title="Año Creado">
                                            @for ($i = 2023; $i <= date('Y'); $i++)
                                                <option {{($i == $ano) ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                @if (in_array($tipo_reporte,[2,3,5,8,10]))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreProv">Secciones:</label>
                                            <select class="form-control form-control-sm selectpicker show-tick" name="seccion" id="seccion" data-live-search="true" title="Secciones">
                                                @foreach ($secciones as $key => $value)
                                                    <option {{($value['codigo'] == $seccion) ? 'selected' : ''}} value="{{$value['codigo']}}">{{$value['nombre']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                              <button class="btn btn-primary btn-icon-split" type="submit">
                                <span class="icon text-white-50">
                                    <i class="fas fa-search"></i>
                                </span>
                                <span class="text">Buscar</span>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <hr class="sidebar-divider">
                    </div>
	            </div>
	        </div>
        </div>
    </div>
    <script>
        /*$(document).ready(function () {
            
            var areaSelect = $("#area_reporte");
            var tipoReportesSelect = $("#tipo_reporte");

            // Define los datos de los arrays
            var areaReportes = <?php echo json_encode($area_reportes); ?>;
            var tipoReportes = <?php echo json_encode($tipo_reportes); ?>;

            // Agrega un controlador de eventos para el cambio en el select de área
            areaSelect.on("change", function () {
                // Limpia las opciones existentes en el select de tipos de reportes
                tipoReportesSelect.empty().selectpicker('refresh');

                // Obtiene el valor seleccionado en el select de área
                var areaSeleccionada = areaSelect.val();
                
                // Filtra los tipos de reportes que coinciden con el área seleccionada
                var tiposFiltrados = tipoReportes.filter(function (tipo) {
                    return tipo.grupo.includes(parseInt(areaSeleccionada));
                });
                console.log(tiposFiltrados)
                // Agrega las opciones filtradas al select de tipos de reportes
                tiposFiltrados.forEach(function (tipo) {
                    tipoReportesSelect.append("<option value='" + tipo.val + "'>" + tipo.text + "</option>").selectpicker('refresh');
                });
            });
        });*/
        $(document).ready(function () {
            
            const areaSelect = $("#area_reporte");
            const tipoReportesSelect = $("#tipo_reporte");
            const areaReportes = @json($area_reportes);
            const tipoReportes = @json($tipo_reportes);
            @if(!empty($area_reporte))
                setTimeout(() => {
                    areaSelect.trigger('change');
                }, 100);
            @endif
            areaSelect.on("change", function () {
                tipoReportesSelect.empty().selectpicker('refresh');
                const areaSeleccionada = areaSelect.val();

                const tiposFiltrados = tipoReportes.filter(tipo => tipo.grupo.includes(parseInt(areaSeleccionada)));

                tiposFiltrados.forEach(tipo => {
                    tipoReportesSelect.append($("<option>", { value: tipo.val, text: tipo.text })).selectpicker('refresh');
                });
                
            });
            @if(!empty($tipo_reporte))
                setTimeout(() => {
                    tipoReportesSelect.val({{$tipo_reporte}}).selectpicker('refresh');
                }, 100);
            @endif
        });
    </script>
    @if ($tipo_reporte == 2)
        @include('reportes.recalls.respuesta-recall')
    @endif
    @if ($tipo_reporte == 3)
        @include('reportes.recalls.comercial-recall')
    @endif
<script>
	jQuery(document).ready(function(){
		$('#collapseReporte').addClass('show');
	});
</script>
</x-layout>