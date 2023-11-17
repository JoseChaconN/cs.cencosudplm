<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">N° Reclamo</th>
                        <th style="border: 1px solid #0000">Estado Reclamo</th>
                        <th style="border: 1px solid #0000">Fecha del reclamo</th>
                        <th style="border: 1px solid #0000">Código Tienda</th>
                        <th style="border: 1px solid #0000">Nombre de Tienda</th>
                        <th style="border: 1px solid #0000">Responsable Gestión</th>
                        <th style="border: 1px solid #0000">Origen de venta</th>
                        <th style="border: 1px solid #0000">Gestión presencial</th>
                        <th style="border: 1px solid #0000">Gestión SAC</th>
                        <th style="border: 1px solid #0000">Cierre Reclamo ACA/Gerencia</th>
                        <th style="border: 1px solid #0000">EAN</th>
                        <th style="border: 1px solid #0000">Nombre producto</th>
                        <th style="border: 1px solid #0000">Sección</th>
                        <th style="border: 1px solid #0000">Descripción del Reclamo</th>
                        <th style="border: 1px solid #0000">Motivo del Reclamo</th>
                        <th style="border: 1px solid #0000">Proveedor</th>
                        <th style="border: 1px solid #0000">Frigorifico</th>
                        <th style="border: 1px solid #0000">Fecha elaboración o Faena</th>
                        <th style="border: 1px solid #0000">Fecha de Vencimiento</th>
                        <th style="border: 1px solid #0000">Lote</th>
                        <th style="border: 1px solid #0000">Investigación Técnica</th>
                        <th style="border: 1px solid #0000">Origen del reclamo</th>
                        <th style="border: 1px solid #0000">Tipo Reclamo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{ $item->id }}</td>
                            <td style="border: 1px solid #0000">{{ $item->status }}</td>
                            <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->codigo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->responsable->name.' '.$item->responsable->last_name}}</td>
                            <td style="border: 1px solid #0000">{{ $item->origen_venta }}</td>
                            <td style="border: 1px solid #0000">{{ $item->doble_garantia }}</td>
                            <td style="border: 1px solid #0000">{{ $item->gestion_sac }}</td>
                            <td style="border: 1px solid #0000">{{ $item->responsable_cerrado->name.' '.$item->responsable_cerrado->last_name }}</td>
                            <td style="border: 1px solid #0000">{{ $item->ean_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->seccion->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->descripcion_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->motivo_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_proveedor }}</td>
                            <td style="border: 1px solid #0000">{{ $item->frigorifico }}</td>
                            <td style="border: 1px solid #0000">{{ $item->elaboracion }}</td>
                            <td style="border: 1px solid #0000">{{ $item->vencimiento }}</td>
                            <td style="border: 1px solid #0000">{{ $item->lote }}</td>
                            <td style="border: 1px solid #0000">{{ $item->obs_general }}</td>
                            <td style="border: 1px solid #0000">{{ $item->origen_reclamo->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tipo_reclamo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>