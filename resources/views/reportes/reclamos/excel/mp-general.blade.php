<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">Fecha del reclamo</th>
                        <th style="border: 1px solid #0000">Reclamo</th>
                        <th style="border: 1px solid #0000">Sección</th>
                        <th style="border: 1px solid #0000">Tipo Reclamo</th>
                        <th style="border: 1px solid #0000">Estado</th>
                        <th style="border: 1px solid #0000">Local</th>
                        <th style="border: 1px solid #0000">Producto</th>
                        <th style="border: 1px solid #0000">EAN</th>
                        <th style="border: 1px solid #0000">SAP</th>
                        <th style="border: 1px solid #0000">Marca</th>
                        <th style="border: 1px solid #0000">Proveedor</th>
                        <th style="border: 1px solid #0000">Fecha de Elaboración</th>
                        <th style="border: 1px solid #0000">Fecha de Vencimiento</th>
                        <th style="border: 1px solid #0000">Lote</th>
                        <th style="border: 1px solid #0000">Cliente</th>
                        <th style="border: 1px solid #0000">Problema</th>
                        <th style="border: 1px solid #0000">Investigación técnica</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                            <td style="border: 1px solid #0000">{{ $item->id }}</td>
                            <td style="border: 1px solid #0000">{{ $item->seccion->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tipo_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->status }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->codigo.' - '.$item->tienda->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->ean_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->sap_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->marca_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_proveedor }}</td>
                            <td style="border: 1px solid #0000">{{ $item->elaboracion }}</td>
                            <td style="border: 1px solid #0000">{{ $item->vencimiento }}</td>
                            <td style="border: 1px solid #0000">{{ $item->lote_fecha }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_cliente }}</td>
                            <td style="border: 1px solid #0000">{{ $item->descripcion_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->obs_general }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>