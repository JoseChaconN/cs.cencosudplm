<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.recalls.excel.respuesta-recall')}}">
    @csrf
    <input type="hidden" name="mes_excel" value="{{$mes}}">
    <input type="hidden" name="ano_excel" value="{{$ano}}">
</form>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Resumen Recalls</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Proceso</th>
					                <th>Cerrados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $reporte_data['n_recall_proceso'] }}</td>
                                    <td>{{ $reporte_data['n_recall_cerrado'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Comercial Detallado</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#excelForm').submit()">Descargar Excel</button>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° Recall</th>
                                    <th>Fecha Recall</th>
                                    <th>Tiempo de Respuesta</th>
                                    <th>Nombre Proveedor</th>
                                    <th>RUT Proveedor</th>
                                    <th>Nombre producto</th>
                                    <th>Sección</th>
                                    <th>Cadena</th>
                                    <th>Locales Con Problemas</th>
                                    <th>Locales Sin Problemas</th>
                                    <th>Tipo de recall</th>
                                    <th>Estado</th>
                                    <th>Ver Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data['recalls'] as $item)
                                    @foreach ($reporte_data['productos'][$item->id] as $element)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->momento_ingreso)->format('d/m/Y H:i:s')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->momento_final)->format('d/m/Y H:i:s')}}</td>
                                            <td>{{ $item->nombre_proveedor }}</td>
                                            <td>{{ $item->rut_proveedor }}</td>
                                            <td>{{ $element->nombre }}</td>
                                            <td>{{ $element->seccion->nombre }}</td>
                                            <td>{{ $item->cadena }}</td>
                                            <td>{{ $reporte_data['datos_productos'][$item->id][$element->id]['local_cp'] }}</td>
                                            <td>{{ $reporte_data['datos_productos'][$item->id][$element->id]['local_sp'] }}</td>
                                            <td>{{ $item->recall }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td><a class="btn btn-primary btn-sm" type="button" href="{{ route('reporte.recalls.comercial-recall-detalle',$id) }}" target="_blank">Detalle</a></td>
                                        </tr>
                                    @endforeach
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