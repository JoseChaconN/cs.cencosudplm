<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.logistica-seccion')}}">
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
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos por Sección Logística</h6>
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
                                    <th>Tienda</th>
                                    <th>Sección</th>
                                    <th>Proveedor</th>
                                    <th>SAP</th>
                                    <th>Producto</th>
                                    <th>Tipo Reclamo</th>
                                    <th>Status</th>
                                    <th>Motivo Reclamo</th>
                                    <th>Descripción Reclamo</th>
                                    <th>Fecha del Reclamo</th>
                                    <th>Unidades</th>
                                    <th>Lote</th>
                                    <th>Elaboración</th>
                                    <th>Vencimiento o Duración</th>
                                    <th>Sujeto a Recall</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->categoria}}</td>
                                        <td>{{$item->seccion->nombre}}</td>
                                        <td>{{$item->nombre_proveedor}}</td>
                                        <td>{{$item->sap_producto}}</td>
                                        <td>{{$item->nombre_producto}}</td>
                                        <td>{{$item->tipo_reclamo}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>{{$item->doble_garantia}}</td>
                                        <td>{{$item->origen}}</td>
                                        <td>{{$item->motivo_reclamo}}</td>
                                        <td>{{$item->descripcion_reclamo}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{$item->cantidad_problema.' '.$item->unidad_cantidad_problema}}</td>
                                        <td>{{$item->lote}}</td>
                                        <td>{{$item->elaboracion}}</td>
                                        <td>{{$item->vencimiento}}</td>
                                        <td>{{(empty($item->posible_recall)) ? 'no' : $item->posible_recall}}</td>
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