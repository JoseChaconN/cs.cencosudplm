<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.logistica')}}">
    @csrf
    <input type="hidden" name="mes_excel" value="{{$mes}}">
    <input type="hidden" name="ano_excel" value="{{$ano}}">    
</form>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos Tipo Logística</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#excelForm').submit()">Descargar Excel</button>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Responsable</th>
                                    <th>Producto</th>
                                    <th>SAP</th>
                                    <th>N° Entrega</th>
                                    <th>Descripción</th>
                                    <th>Proveedor</th>
                                    <th>País de Origen</th>
                                    <th>Elaboración</th>
                                    <th>Vencimiento</th>
                                    <th>LOTE o Fecha de Faena</th>
                                    <th>Fecha de Reclamo</th>
                                    <th>Local que inicia Reclamo</th>
                                    <th>Problema</th>
                                    <th>Respuesta Entregada</th>
                                    <th>Fecha y Hora de respuesta</th>
                                    <th>Status</th>
                                    <th>Archivo</th>
                                    <th>SUJETO A RECALL (SI/NO)</th>
                                    <th>Respuesta Proveedor (S/N)</th>
                                    <th>Fecha de respuesta Proveedor</th>
                                    <th>Gestión presencial</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->responsable->name.' '.$item->responsable->last_name }}</td>
                                        <td>{{ $item->nombre_producto }}</td>
                                        <td>{{ $item->sap_producto }}</td>
                                        <td>{{ $item->numero_entrega }}</td>
                                        <td>{{ $item->descripcion_reclamo }}</td>
                                        <td>{{ $item->nombre_proveedor }}</td>
                                        <td>Chile</td>
                                        <td>{{ $item->elaboracion }}</td>
                                        <td>{{ $item->vencimiento }}</td>
                                        <td>{{ $item->lote_fecha }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{ $item->tienda->codigo.' - '.$item->tienda->nombre }}</td>
                                        <td>{{ $item->tipo_reclamo }}</td>
                                        <td>{{ (empty($item->msj_log_imp)) ? 'N' : 'S' }}</td>
                                        <td>{{ (empty($item->msj_log_imp)) ? 'N/A' : \Carbon\Carbon::parse($item->fecha_resp_msj_log_imp)->format('d/m/Y') }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>-</td>
                                        <td>{{ $item->posible_recall }}</td>
                                        <td>{{ (empty($item->observaciones_prov)) ? 'N' : 'S' }}</td>
                                        <td>{{ (empty($item->observaciones_prov)) ? 'N/A' : \Carbon\Carbon::parse($item->fecha_respuesta_prov)->format('d/m/Y') }}</td>
                                        <td>{{ $item->doble_garantia }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="sidebar-divider">
                </div>
            </div>
        </div>
    </div>
</div>