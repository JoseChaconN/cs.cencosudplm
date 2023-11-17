<!DOCTYPE html>
    <html>
        <body>
            <table border="1px" cellspacing="3" bgcolor="#000000" >
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">N°</th>
                        <th style="border: 1px solid #0000">Tienda</th>
                        <th style="border: 1px solid #0000">Local</th>
                        <th style="border: 1px solid #0000">Sección</th>
                        <th style="border: 1px solid #0000">Nombre Proveedor</th>
                        <th style="border: 1px solid #0000">Frigorifico</th>
                        <th style="border: 1px solid #0000">SAP</th>
                        <th style="border: 1px solid #0000">EAN</th>
                        <th style="border: 1px solid #0000">Producto</th>
                        <th style="border: 1px solid #0000">Gestión presencial</th>
                        <th style="border: 1px solid #0000">Tipo Reclamo</th>
                        <th style="border: 1px solid #0000">Origen Reclamo</th>
                        <th style="border: 1px solid #0000">Status</th>
                        <th style="border: 1px solid #0000">Motivo Reclamo</th>
                        <th style="border: 1px solid #0000">Descripción Reclamo</th>
                        <th style="border: 1px solid #0000">Fecha del Reclamo</th>
                        <th style="border: 1px solid #0000">Unidades</th>
                        <th style="border: 1px solid #0000">Lote</th>
                        <th style="border: 1px solid #0000">Elaboración</th>
                        <th style="border: 1px solid #0000">Vencimiento o Duración</th>
                        <th style="border: 1px solid #0000">Sujeto a Recall</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{$item->id}}</td>
                            <td style="border: 1px solid #0000">{{$item->tienda->nombre}}</td>
                            <td style="border: 1px solid #0000">{{$item->tienda->codigo}}</td>
                            <td style="border: 1px solid #0000">{{$item->seccion->nombre}}</td>
                            <td style="border: 1px solid #0000">{{$item->nombre_proveedor}}</td>
                            <td style="border: 1px solid #0000">-</td>
                            <td style="border: 1px solid #0000">{{$item->sap_producto}}</td>
                            <td style="border: 1px solid #0000">{{$item->ean_producto}}</td>
                            <td style="border: 1px solid #0000">{{$item->nombre_producto}}</td>
                            <td style="border: 1px solid #0000">{{$item->doble_garantia}}</td>
                            <td style="border: 1px solid #0000">{{$item->tipo_reclamo}}</td>
                            <td style="border: 1px solid #0000">{{$item->origen}}</td>
                            <td style="border: 1px solid #0000">{{$item->status}}</td>
                            <td style="border: 1px solid #0000">{{$item->motivo_reclamo}}</td>
                            <td style="border: 1px solid #0000">{{$item->descripcion_reclamo}}</td>
                            <td style="border: 1px solid #0000">{{\Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                            <td style="border: 1px solid #0000">{{$item->cantidad_problema.' '.$item->unidad_cantidad_problema}}</td>
                            <td style="border: 1px solid #0000">{{$item->lote}}</td>
                            <td style="border: 1px solid #0000">{{$item->elaboracion}}</td>
                            <td style="border: 1px solid #0000">{{$item->vencimiento}}</td>
                            <td style="border: 1px solid #0000">{{(empty($item->posible_recall)) ? 'no' : $item->posible_recall}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>
    