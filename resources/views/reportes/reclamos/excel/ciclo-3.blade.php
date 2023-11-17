<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">N° del reclamo</th>
                        <th style="border: 1px solid #0000">Fecha de Ingreso</th>
                        <th style="border: 1px solid #0000">Local</th>
                        <th style="border: 1px solid #0000">Código Local</th>
                        <th style="border: 1px solid #0000">Status</th>
                        <th style="border: 1px solid #0000">Canal de Ingreso</th>
                        <th style="border: 1px solid #0000">Orígen de la Venta</th>
                        <th style="border: 1px solid #0000">Producto</th>
                        <th style="border: 1px solid #0000">Proveedor</th>
                        <th style="border: 1px solid #0000">Descripción</th>
                        <th style="border: 1px solid #0000">Mensaje SAC</th>
                        <th style="border: 1px solid #0000">Fecha de Cierre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{ $item->id }}</td>
                            <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->tienda->codigo }}</td>
                            <td style="border: 1px solid #0000">{{ $item->status }}</td>
                            <td style="border: 1px solid #0000">{{ $item->origen}}</td>
                            <td style="border: 1px solid #0000">{{ $item->origen_venta}}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_producto}}</td>
                            <td style="border: 1px solid #0000">{{ $item->nombre_proveedor}}</td>
                            <td style="border: 1px solid #0000">{{ $item->origen_venta}}</td>
                            <td style="border: 1px solid #0000">{{ $item->mensaje_atento}}</td>
                            <td style="border: 1px solid #0000">{{ (empty($item->fecha_cerrado)) ? '' : \Carbon\Carbon::parse($item->fecha_cerrado)->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>