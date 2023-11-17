<!DOCTYPE html>
<html>
    <body>
        <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="border: 1px solid #0000">Categoria</th>
                    <th style="border: 1px solid #0000">N°</th>
                    <th style="border: 1px solid #0000">Fecha de Ingreso</th>
                    <th style="border: 1px solid #0000">Ejecutivo responsable <br>SAC ATENTO</th>
                    <th style="border: 1px solid #0000">Ejecutivo responsable <br>SAC HOLDTECH</th>
                    <th style="border: 1px solid #0000">Local</th>
                    <th style="border: 1px solid #0000">Código Local</th>
                    <th style="border: 1px solid #0000">Zona</th>
                    <th style="border: 1px solid #0000">Estado</th>
                    <th style="border: 1px solid #0000">Canal de Ingreso</th>
                    <th style="border: 1px solid #0000">Origen de venta</th>
                    <th style="border: 1px solid #0000">Motivo Reclamo</th>
                    <th style="border: 1px solid #0000">Descripción del Reclamo</th>
                    <th style="border: 1px solid #0000">Sección Involucrada</th>
                    <th style="border: 1px solid #0000">Fecha de Cierre</th>
                    <th style="border: 1px solid #0000">Cliente Contactado (S/N)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte_data as $item)
                    <tr>
                        <td style="border: 1px solid #0000">{{ $item->categoria }}</td>
                        <td style="border: 1px solid #0000">{{ $item->id }}</td>
                        <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->reclamo_fecha)->format('d/m/Y')}}</td>
                        <td style="border: 1px solid #0000">{{ $item->ejecutivo_responsable_sac }}</td>
                        <td style="border: 1px solid #0000">{{ $item->ejecutivo_responsable_hold }}</td>
                        <td style="border: 1px solid #0000">{{ $item->tienda->nombre }}</td>
                        <td style="border: 1px solid #0000">{{ $item->tienda->codigo }}</td>
                        <td style="border: 1px solid #0000">{{ $item->tienda->zona }}</td>
                        <td style="border: 1px solid #0000">{{ $item->status }}</td>
                        <td style="border: 1px solid #0000">{{ $item->origen_reclamo->nombre }}</td>
                        <td style="border: 1px solid #0000">{{ $item->origen_venta }}</td>
                        <td style="border: 1px solid #0000">{{ $item->motivo_reclamo }}</td>
                        <td style="border: 1px solid #0000">{{ $item->descripcion_reclamo }}</td>
                        <td style="border: 1px solid #0000">{{ $item->seccion->nombre }}</td>
                        <td style="border: 1px solid #0000">{{ \Carbon\Carbon::parse($item->fecha_cerrado)->format('d/m/Y')}}</td>
                        <td style="border: 1px solid #0000">{{ (empty($item->obs_cliente)) ? 'N' : 'S' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>