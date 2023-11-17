<!DOCTYPE html>
    <html>
        <body>
            <h3>Respuestas otros locales con mismo problema</h3>
            <br>
            <table>
                <tr>
                    <td>N° reclamo: {{$data->id}}</td>
                </tr>
                <tr>
                    <td>Fecha del reclamo: {{\Carbon\Carbon::parse($data->reclamo_fecha)->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td>Producto: {{$data->nombre_producto}}</td>
                </tr>
                <tr>
                    <td>EAN: {{$data->ean_producto}}</td>
                </tr>
                <tr>
                    <td>Proveedor: {{$data->nombre_proveedor}}</td>
                </tr>
                <tr>
                    <td>Rut proveedor: {{$data->rut_proveedor}}</td>
                </tr>
            </table>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">Nombre del usuario</th>
                        <th style="border: 1px solid #0000">Fecha del reclamo generado en el local</th>
                        <th style="border: 1px solid #0000">Tienda</th>
                        <th style="border: 1px solid #0000">Resultado</th>
                        <th style="border: 1px solid #0000">Lote</th>
                        <th style="border: 1px solid #0000">Fecha elaboración</th>
                        <th style="border: 1px solid #0000">Fecha vencimiento</th>
                        <th style="border: 1px solid #0000">Cantidad</th>
                        <th style="border: 1px solid #0000">Unidad de medida</th>
                        <th style="border: 1px solid #0000">Medio de retiro</th>
                    </tr>
                </thead>
                @foreach ($data->reclamos_local_problema as $item)
                    <tr>
                        <td style="border: 1px solid #0000">{{ $item->responsable->name.' '.$item->responsable->last_name }}</td>
                        <td style="border: 1px solid #0000">{{\Carbon\Carbon::parse($data->reclamo_fecha)->format('d-m-Y')}}</td>
                        <td style="border: 1px solid #0000">{{ $item->tienda->nombre.' - '.$item->tienda->codigo }}</td>
                        <td style="border: 1px solid #0000">{{ $item->resultado }}</td>
                        <td style="border: 1px solid #0000">{{ $item->lote }}</td>
                        <td style="border: 1px solid #0000">{{ $item->fecha_elab }}</td>
                        <td style="border: 1px solid #0000">{{ $item->fecha_venc }}</td>
                        <td style="border: 1px solid #0000">{{ $item->cantidad }}</td>
                        <td style="border: 1px solid #0000">{{ $item->unidad_cantidad }}</td>
                        <td style="border: 1px solid #0000">{{ $item->retiro }}</td>
                    </tr>
                @endforeach
            </table>
        </body>
    </html>