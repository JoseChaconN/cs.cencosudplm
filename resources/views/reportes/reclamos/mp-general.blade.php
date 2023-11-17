<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.mp-general')}}">
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
                                    <th>Fecha del reclamo</th>
                                    <th>Reclamo</th>
                                    <th>Sección</th>
                                    <th>Tipo Reclamo</th>
                                    <th>Estado</th>
                                    <th>Local</th>
                                    <th>Producto</th>
                                    <th>EAN</th>
                                    <th>SAP</th>
                                    <th>Marca</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de Elaboración</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Lote</th>
                                    <th>Cliente</th>
                                    <th>Problema</th>
                                    <th>Investigación técnica</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->seccion->nombre }}</td>
                                        <td>{{ $item->tipo_reclamo }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->tienda->codigo.' - '.$item->tienda->nombre }}</td>
                                        <td>{{ $item->nombre_producto }}</td>
                                        <td>{{ $item->ean_producto }}</td>
                                        <td>{{ $item->sap_producto }}</td>
                                        <td>{{ $item->marca_producto }}</td>
                                        <td>{{ $item->nombre_proveedor }}</td>
                                        <td>{{ $item->elaboracion }}</td>
                                        <td>{{ $item->vencimiento }}</td>
                                        <td>{{ $item->lote_fecha }}</td>
                                        <td>{{ $item->nombre_cliente }}</td>
                                        <td>{{ $item->descripcion_reclamo }}</td>
                                        <td>{{ $item->obs_general }}</td>
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