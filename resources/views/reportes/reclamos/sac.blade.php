<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.sac')}}">
    @csrf
    <input type="hidden" name="mes_excel" value="{{$mes}}">
    <input type="hidden" name="ano_excel" value="{{$ano}}">
    <input type="hidden" name="tipo_excel" id="tipo_excel" value="0">
</form>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos SAC Jumbo</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#tipo_excel').val(1);$('#excelForm').submit()">Descargar Excel</button>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Ejecutivo responsable <br>SAC ATENTO</th>
                                    <th>Ejecutivo responsable <br>SAC HOLDTECH</th>
                                    <th>Local</th>
                                    <th>Código Local</th>
                                    <th>Zona</th>
                                    <th>Estado</th>
                                    <th>Canal de Ingreso</th>
                                    <th>Origen de venta</th>
                                    <th>Motivo Reclamo</th>
                                    <th>Descripción del Reclamo</th>
                                    <th>Sección Involucrada</th>
                                    <th>Fecha de Cierre</th>
                                    <th>Cliente Contactado (S/N)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data['jumbo'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{ $item->ejecutivo_responsable_sac }}</td>
                                        <td>{{ $item->ejecutivo_responsable_hold }}</td>
                                        <td>{{ $item->tienda->nombre }}</td>
                                        <td>{{ $item->tienda->codigo }}</td>
                                        <td>{{ $item->tienda->zona }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->origen_reclamo->nombre }}</td>
                                        <td>{{ $item->origen_venta }}</td>
                                        <td>{{ $item->motivo_reclamo }}</td>
                                        <td>{{ $item->descripcion_reclamo }}</td>
                                        <td>{{ $item->seccion->nombre }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->fecha_cerrado)->format('d/m/Y')}}</td>
                                        <td>{{ (empty($item->obs_cliente)) ? 'N' : 'S' }}</td>
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
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos SAC SISA</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#tipo_excel').val(2);$('#excelForm').submit()">Descargar Excel</button>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Ejecutivo responsable <br>SAC ATENTO</th>
                                    <th>Ejecutivo responsable <br>SAC HOLDTECH</th>
                                    <th>Local</th>
                                    <th>Código Local</th>
                                    <th>Zona</th>
                                    <th>Estado</th>
                                    <th>Canal de Ingreso</th>
                                    <th>Origen de venta</th>
                                    <th>Motivo Reclamo</th>
                                    <th>Descripción del Reclamo</th>
                                    <th>Sección Involucrada</th>
                                    <th>Fecha de Cierre</th>
                                    <th>Cliente Contactado (S/N)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data['sisa'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                        <td>{{ $item->ejecutivo_responsable_sac }}</td>
                                        <td>{{ $item->ejecutivo_responsable_hold }}</td>
                                        <td>{{ $item->tienda->nombre }}</td>
                                        <td>{{ $item->tienda->codigo }}</td>
                                        <td>{{ $item->tienda->zona }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->origen_reclamo->nombre }}</td>
                                        <td>{{ $item->origen_venta }}</td>
                                        <td>{{ $item->motivo_reclamo }}</td>
                                        <td>{{ $item->descripcion_reclamo }}</td>
                                        <td>{{ $item->seccion->nombre }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->fecha_cerrado)->format('d/m/Y')}}</td>
                                        <td>{{ (empty($item->obs_cliente)) ? 'N' : 'S' }}</td>
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