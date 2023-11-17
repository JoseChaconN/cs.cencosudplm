<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">N°</th>
                        <th style="border: 1px solid #0000">Responsable</th>
                        <th style="border: 1px solid #0000">Producto</th>
                        <th style="border: 1px solid #0000">SAP</th>
                        <th style="border: 1px solid #0000">N° Entrega</th>
                        <th style="border: 1px solid #0000">Descripción</th>
                        <th style="border: 1px solid #0000">Proveedor</th>
                        <th style="border: 1px solid #0000">País de Origen</th>
                        <th style="border: 1px solid #0000">Elaboración</th>
                        <th style="border: 1px solid #0000">Vencimiento</th>
                        <th style="border: 1px solid #0000">LOTE o Fecha de Faena</th>
                        <th style="border: 1px solid #0000">Fecha de Reclamo</th>
                        <th style="border: 1px solid #0000">Local que inicia Reclamo</th>
                        <th style="border: 1px solid #0000">Problema</th>
                        <th style="border: 1px solid #0000">Respuesta Entregada</th>
                        <th style="border: 1px solid #0000">Fecha y Hora de respuesta</th>
                        <th style="border: 1px solid #0000">Status</th>
                        <th style="border: 1px solid #0000">Archivo</th>
                        <th style="border: 1px solid #0000">SUJETO A RECALL (SI/NO)</th>
                        <th style="border: 1px solid #0000">Respuesta Proveedor (S/N)</th>
                        <th style="border: 1px solid #0000">Fecha de respuesta Proveedor</th>
                        <th style="border: 1px solid #0000">Gestión presencial</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{ $item->id }}</td>
                            <td style="border: 1px solid #0000">{{ $item->responsable->name.' '.$item->responsable->last_name }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->sap_producto }}</td>
                            <td style="border: 1px solid #0000">{{ $item->numero_entrega }}</td>
                            <td style="border: 1px solid #0000">{{ $item->descripcion_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_proveedor }}</td>
                            <td style="border: 1px solid #0000">Chile</td>
                            <td style="border: 1px solid #0000">{{ $item->elaboracion }}</td>
                            <td style="border: 1px solid #0000">{{ $item->vencimiento }}</td>
                            <td style="border: 1px solid #0000">{{ $item->lote_fecha }}</td>
                            <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->codigo.' - '.$item->tienda->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tipo_reclamo }}</td>
                            <td style="border: 1px solid #0000">{{ (empty($item->msj_log_imp)) ? 'N' : 'S' }}</td>
                            <td style="border: 1px solid #0000">{{ (empty($item->msj_log_imp)) ? 'N/A' : \Carbon\Carbon::parse($item->fecha_resp_msj_log_imp)->format('d/m/Y') }}</td>
                            <td style="border: 1px solid #0000">{{ $item->status }}</td>
                            <td style="border: 1px solid #0000">-</td>
                            <td style="border: 1px solid #0000">{{ $item->posible_recall }}</td>
                            <td style="border: 1px solid #0000">{{ (empty($item->observaciones_prov)) ? 'N' : 'S' }}</td>
                            <td style="border: 1px solid #0000">{{ (empty($item->observaciones_prov)) ? 'N/A' : \Carbon\Carbon::parse($item->fecha_respuesta_prov)->format('d/m/Y') }}</td>
                            <td style="border: 1px solid #0000">{{ $item->doble_garantia }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>