<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">N° Reclamo</th>
                        <th style="border: 1px solid #0000">Sección</th>
                        <th style="border: 1px solid #0000">Nombre Proveedor</th>
                        <th style="border: 1px solid #0000">RUT Proveedor</th>
                        <th style="border: 1px solid #0000">Nombre producto</th>
                        <th style="border: 1px solid #0000">Cantidad Pedido</th>
                        <th style="border: 1px solid #0000">UN</th>
                        <th style="border: 1px solid #0000">Local</th>
                        <th style="border: 1px solid #0000">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        @if ($item->reclamos_local_problema->isNotEmpty())
                            @foreach ($item->reclamos_local_problema as $item1)
                                <tr>
                                    <td style="border: 1px solid #0000">{{$item->id}}</td>
                                    <td style="border: 1px solid #0000">{{$item->seccion->nombre}}</td>
                                    <td style="border: 1px solid #0000">{{$item->nombre_proveedor}}</td>
                                    <td style="border: 1px solid #0000">{{$item->rut_proveedor}}</td>
                                    <td style="border: 1px solid #0000">{{$item->nombre_producto}}</td>
                                    <td style="border: 1px solid #0000">{{$item1->cantidad}}</td>
                                    <td style="border: 1px solid #0000">{{$item1->unidad_cantidad}}</td>
                                    <td style="border: 1px solid #0000">{{$item1->tienda->nombre.' - '.$item1->tienda->codigo}}</td>
                                    <td style="border: 1px solid #0000">{{$item->descripcion_reclamo}}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>