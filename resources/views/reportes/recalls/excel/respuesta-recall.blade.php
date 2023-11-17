<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">Número</th>
                        <th style="border: 1px solid #0000">Proveedor</th>
                        <th style="border: 1px solid #0000">Fecha de ingreso</th>
                        <th style="border: 1px solid #0000">Tipo de recall</th>
                        <th style="border: 1px solid #0000">Tiempo de Respuesta</th>
                        <th style="border: 1px solid #0000">Locales C/P</th>
                        <th style="border: 1px solid #0000">Locales S/P</th>
                        <th style="border: 1px solid #0000">Locales S/R</th>
                        <th style="border: 1px solid #0000">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                    <tr>
                        <td style="border: 1px solid #0000" >{{ $item->id }}</td>
                        <td style="border: 1px solid #0000" >{{ $item->nombre_proveedor }}</td>
                        <td style="border: 1px solid #0000" >{{ \Carbon\Carbon::parse($item->momento_ingreso)->format('d/m/Y H:i:s')}}</td>
                        <td style="border: 1px solid #0000" >{{ $item->recall }}</td>
                        <td style="border: 1px solid #0000" >{{ \Carbon\Carbon::parse($item->momento_final)->format('d/m/Y H:i:s')}}</td>
                        <td style="border: 1px solid #0000" >-</td>
                        <td style="border: 1px solid #0000" >-</td>
                        <td style="border: 1px solid #0000" >-</td>
                        <td style="border: 1px solid #0000" >{{ $item->status }}</td>                        
                    </tr>
                    {{-- @foreach ($item->productos as $element) --}}
                    @foreach ($productos[$item->id] as $element)
                        <tr class="productos-recall productos-recall-{{ $item->id }}" style="display: none">
                            <td style="border: 1px solid #0000" colspan="3">Producto: {{ $element->nombre }}</td>
                            <td style="border: 1px solid #0000">EAN: {{ $element->ean }}</td>
                            <td style="border: 1px solid #0000">SAP: {{ $element->sap }}</td>
                            <td style="border: 1px solid #0000">{{ $datos_productos[$item->id][$element->id]['local_cp'] }}</td>
                            <td style="border: 1px solid #0000">{{ $datos_productos[$item->id][$element->id]['local_sp'] }}</td>
                            <td style="border: 1px solid #0000">{{ $datos_productos[$item->id][$element->id]['local_sr_producto'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </body>
    </html>