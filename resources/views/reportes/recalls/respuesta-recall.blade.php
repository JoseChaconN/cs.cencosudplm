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
                <h6 class="m-0 font-weight-bold text-primary">Reporte Respuesta Recalls</h6>
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
                                    <th>Número</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Tipo de recall</th>
                                    <th>Tiempo de Respuesta</th>
                                    <th>Locales C/P</th>
                                    <th>Locales S/P</th>
                                    <th>Locales S/R</th>
                                    <th>Status</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte_data['recalls'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre_proveedor }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->momento_ingreso)->format('d/m/Y H:i:s')}}</td>
                                        <td>{{ $item->recall }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->momento_final)->format('d/m/Y H:i:s')}}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{ $item->status }}</td>
                                        <td><button class="btn btn-primary btn-sm" type="button" onclick="$('.productos-recall').hide();$('.productos-recall-{{ $item->id }}').show('slow');">Productos</button></td>
                                    </tr>
                                    {{-- @foreach ($item->productos as $element) --}}
                                    @foreach ($reporte_data['productos'][$item->id] as $element)
                                        <tr class="productos-recall productos-recall-{{ $item->id }}" style="display: none">
                                            <td colspan="3">Producto: {{ $element->nombre }}</td>
                                            <td>EAN: {{ $element->ean }}</td>
                                            <td>SAP: {{ $element->sap }}</td>
                                            <td>{{ $reporte_data['datos_productos'][$item->id][$element->id]['local_cp'] }}</td>
                                            <td>{{ $reporte_data['datos_productos'][$item->id][$element->id]['local_sp'] }}</td>
                                            <td>{{ $reporte_data['datos_productos'][$item->id][$element->id]['local_sr_producto'] }}</td>
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