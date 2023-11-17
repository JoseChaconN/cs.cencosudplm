<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.ciclo-3')}}">
    @csrf
    <input type="hidden" name="mes_excel" value="{{$mes}}">
    <input type="hidden" name="ano_excel" value="{{$ano}}">
</form>
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos Ciclo 3 </h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" onclick="$('#excelForm').submit()" type="button">Descargar Excel</button>
                    <!--button class="btn btn-secondary" type="button">Descargar PDF</button-->
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° del reclamo</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Local</th>
                                    <th>Código Local</th>
                                    <th>Status</th>
                                    <th>Canal de Ingreso</th>
                                    <th>Orígen de la Venta</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Descripción</th>
                                    <th>Mensaje SAC</th>
                                    <th>Fecha de Cierre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                                    <td>{{ $item->tienda->nombre }}</td>
                                    <td>{{ $item->tienda->codigo }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->origen}}</td>
                                    <td>{{ $item->origen_venta}}</td>
                                    <td>{{ $item->nombre_producto}}</td>
                                    <td>{{ $item->nombre_proveedor}}</td>
                                    <td>{{ $item->origen_venta}}</td>
                                    <td>{{ $item->mensaje_atento}}</td>
                                    <td>{{ (empty($item->fecha_cerrado)) ? '' : \Carbon\Carbon::parse($item->fecha_cerrado)->format('d/m/Y')}}</td>
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