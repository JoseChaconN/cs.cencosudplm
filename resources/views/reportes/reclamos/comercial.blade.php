<form method="POST" id="excelForm" target="_blank" action="{{route('reporte.reclamos.excel.comercial')}}">
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
                <h6 class="m-0 font-weight-bold text-primary">Reporte Reclamos Comercial</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-success" type="button" onclick="$('#excelForm').submit()">Descargar Excel</button>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° Reclamo</th>
                                    <th>Sección</th>
                                    <th>Nombre Proveedor</th>
                                    <th>RUT Proveedor</th>
                                    <th>Nombre producto</th>
                                    <th>Cantidad Pedido</th>
                                    <th>UN</th>
                                    <th>Local</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data as $item)
                                    @if ($item->reclamos_local_problema->isNotEmpty())
                                        @foreach ($item->reclamos_local_problema as $item1)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->seccion->nombre}}</td>
                                                <td>{{$item->nombre_proveedor}}</td>
                                                <td>{{$item->rut_proveedor}}</td>
                                                <td>{{$item->nombre_producto}}</td>
                                                <td>{{$item1->cantidad}}</td>
                                                <td>{{$item1->unidad_cantidad}}</td>
                                                <td>{{$item1->tienda->nombre.' - '.$item1->tienda->codigo}}</td>
                                                <td>{{$item->descripcion_reclamo}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
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