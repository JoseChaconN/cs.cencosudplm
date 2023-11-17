<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.analisis-quejas-sac')}}">
    @csrf
    <input type="hidden" name="mes_excel" value="{{$mes}}">
    <input type="hidden" name="ano_excel" value="{{$ano}}">
    <input type="hidden" name="seccion_excel" value="{{$seccion}}">
</form>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos Análisis Quejas SAC</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#excelForm').submit()">Descargar Excel</button>
                    <!--button class="btn btn-secondary" type="button">Descargar PDF</button-->
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° Reclamo</th>
                                    <th>Estado Reclamo</th>
                                    <th>Fecha del reclamo</th>
                                    <th>Código Tienda</th>
                                    <th>Nombre de Tienda</th>
                                    <th>Responsable Gestión</th>
                                    <th>Origen de venta</th>
                                    <th>Gestión presencial</th>
                                    <th>Gestión SAC</th>
                                    <th>Cierre Reclamo ACA/Gerencia</th>
                                    <th>EAN</th>
                                    <th>Nombre producto</th>
                                    <th>Sección</th>
                                    <th>Descripción del Reclamo</th>
                                    <th>Motivo del Reclamo</th>
                                    <th>Proveedor</th>
                                    <th>Frigorifico</th>
                                    <th>Fecha elaboración o Faena</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Lote</th>
                                    <th>Investigación Técnica</th>
                                    <th>Origen del reclamo</th>
                                    <th>Tipo Reclamo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{ $item->tienda->codigo }}</td>
                                        <td>{{ $item->tienda->nombre }}</td>
                                        <td>{{ $item->responsable->name.' '.$item->responsable->last_name}}</td>
                                        <td>{{ $item->origen_venta }}</td>
                                        <td>{{ $item->doble_garantia }}</td>
                                        <td>{{ $item->gestion_sac }}</td>
                                        <td>{{ $item->responsable_cerrado->name.' '.$item->responsable_cerrado->last_name }}</td>
                                        <td>{{ $item->ean_producto }}</td>
                                        <td>{{ $item->nombre_producto }}</td>
                                        <td>{{ $item->seccion->nombre }}</td>
                                        <td>{{ $item->descripcion_reclamo }}</td>
                                        <td>{{ $item->motivo_reclamo }}</td>
                                        <td>{{ $item->nombre_proveedor }}</td>
                                        <td>{{ $item->frigorifico }}</td>
                                        <td>{{ $item->elaboracion }}</td>
                                        <td>{{ $item->vencimiento }}</td>
                                        <td>{{ $item->lote }}</td>
                                        <td>{{ $item->obs_general }}</td>
                                        <td>{{ $item->origen_reclamo->nombre }}</td>
                                        <td>{{ $item->tipo_reclamo }}</td>
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