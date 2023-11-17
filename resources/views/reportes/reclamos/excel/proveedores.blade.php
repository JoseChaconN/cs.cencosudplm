<!DOCTYPE html>
    <html>
        <body>
            <table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border: 1px solid #0000">Nombre Proveedor</th>
                        <th style="border: 1px solid #0000">Rut del proveedor</th>
                        <th style="border: 1px solid #0000">Cantidad de Reclamos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte_data as $item)
                        <tr>
                            <td style="border: 1px solid #0000">{{ $item->nombre }}</td>
                            <td style="border: 1px solid #0000">{{ $item->rut }}</td>
                            <td style="border: 1px solid #0000">{{ $item->reclamos_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>