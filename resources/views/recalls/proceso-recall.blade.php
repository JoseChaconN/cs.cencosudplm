<x-layout>
    <x-slot name="breadcrumb">
        Inicio / Recall en proceso / Recall detalle
    </x-slot>
    <div class="col-lg-12">
        <div class="card shadow ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recall en proceso N° {{ $recall->id }} del proveedor
                    {{ $recall->nombre_proveedor }}</h6>
            </div>
            <div class="card-body border-left-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Recall N°</th>
                                        <th>Proveedor</th>
                                        <th>Responsable</th>
                                        <th>Cargo del responsable</th>
                                        <!--th>Cargo del responsable</th-->
                                        <th>Fecha de ingreso</th>
                                        <th>Tipo de recall</th>
                                        <th>Tiempo de respuesta</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $recall->id }}</td>
                                        <td>{{ $recall->nombre_proveedor }}</td>
                                        <td>{{ $responsable->name . ' ' . $responsable->last_name }}</td>
                                        <td>{{ $responsable->name }}</td>
                                        <td>{{ $recall->momento_ingreso }}</td>
                                        <td>{{ $recall->recall }}</td>
                                        <td>{{ $recall->momento_final }}</td>
                                        <td><a class="btn btn-primary"
                                                href="{{ route('procesoDetalleRecall', $recall->id) }}">Ver/Editar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if (
                            ($recall->id_responsable == Auth::user()->id || Auth::user()->hasRole('administrador')) &&
                                $recall->status == 'PROCESO')
                            <button class="btn btn-danger" type="button" data-toggle="modal"
                                data-target="#cerrarRecallModal">Cerrar recall</button>
                            @if ($recall->cadena != 'NINGUNA')							
                                <button class="btn btn-primary" type="button" id="notificarRecallBtn">Notificar recall</button>
								<form id="notificacionRecallNuevoForm" style="display: none">
									<input type="hidden" name="id" value="{{ $recall->id }}">
									@csrf
								</form>
                            @endif
                            @include('recalls.components.cerrar-recall-modal')

                        @endif
                        @if (
                            ($recall->id_responsable == Auth::user()->id || Auth::user()->hasRole('administrador')) &&
                                $recall->status == 'CERRADO')
                            @if (!empty($recall->getMedia('documento-cierre-recall')->last()))
                                <a class="btn btn-success"
                                    href="{{ $recall->getMedia('documento-cierre-recall')->last()->getUrl() }}"
                                    download="">Descargar documento de cierre</a>
                            @endif
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#abrirRecallModal">Abrir recall</button>
                            @include('recalls.components.abrir-recall-modal')
                        @endif
                        <a class="btn btn-primary" href="{{ route('respuestaRecall', $recall->id) }}">Responder como
                            local</a>
                        <button class="btn btn-outline-dark btn-circle btn-sm"><i class="fas fa-info"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr class="sidebar-divider">
                    </div>
                    <div class="col-md-12 mb-4">
                        <h6 class="m-0 font-weight-bold text-primary">Productos asociados al proveedor:
                            {{ $recall->proveedor }}</h6>
                    </div>
                    @foreach ($productos as $producto)
                        <div class="col-md-12 mb-4">
                            <div class="card shadow ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">Respuestas del producto:
                                        {{ $producto->nombre }} <button
                                            onclick="$('#icon_{{ $producto->id }}').toggleClass('fa fa-solid fa-arrow-up fa fa-solid fa-arrow-down');$('#detalle_producto_{{ $producto->id }}').toggle('slow')"
                                            class="btn btn-primary btn-circle"><i class="fa fa-solid fa-arrow-up"
                                                id="icon_{{ $producto->id }}"></i></button></h6>
                                </div>
                                <div class="card-body border-left-warning" style="display:none"
                                    id="detalle_producto_{{ $producto->id }}">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h6 class="m-0 font-weight-bold text-warning">Información del producto</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>EAN</th>
                                                        <th>SAP</th>
                                                        <th>Marca</th>
                                                        <th>Estado</th>
                                                        <th>Lote</th>
                                                        <th>Fecha elaboración</th>
                                                        <th>Fecha vencimiento</th>
                                                        <th>Respuestas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $producto->nombre }}</td>
                                                        <td>{{ $producto->ean }}</td>
                                                        <td>{{ $producto->sap }}</td>
                                                        <td>{{ $producto->marca }}</td>
                                                        <td>Con Problemas</td>
                                                        <td>{{ $lote[$producto->id] }}</td>
                                                        <td>{{ $fecha[$producto->id] }}</td>
                                                        <td>{{ $fecha_vencimiento[$producto->id] }}</td>
                                                        <td>
                                                            <button
                                                                onclick="$('#respuestas_{{ $producto->id }}').toggleClass('fa fa-solid fa-arrow-up fa fa-solid fa-arrow-down');$('#respuestas_producto_{{ $producto->id }}').toggle('slow')"
                                                                class="btn btn-primary btn-circle"><i
                                                                    class="fa fa-solid fa-arrow-up"
                                                                    id="respuestas_{{ $producto->id }}"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12" id="respuestas_producto_{{ $producto->id }}"
                                            style="display:none;">
                                            <table class="table table-bordered table-condensed" width="100%"
                                                cellspacing="0" style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>Zona</th>
                                                        <th>Nombre de la tienda</th>
                                                        <th>Codigo de la tienda</th>
                                                        <th>UN</th>
                                                        <th>Fecha de respuesta</th>
                                                        <th>Hora de respuesta</th>
                                                        <th>Cumple tiempo Resp</th>
                                                        <th>Responsable</th>
                                                        <th>C/P - S/P</th>
                                                        <th>Cantidad</th>
                                                        <th>Medio de retiro</th>
                                                        @if (Auth::user()->id == $recall->id_responsable || Auth::user()->root == 1)
                                                            <th>PDF Respuesta</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tiendas as $tienda)
                                                        <tr
                                                            class="{{ session('u_id_tienda') == $tienda->id ? 'table-primary' : '' }}">
                                                            <td>{{ $tienda->zona }}</td>
                                                            <td>{{ $tienda->nombre }}</td>
                                                            <td>{{ $tienda->codigo }}</td>
                                                            <td>{{ $tienda->categoria }}</td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['fecha_respuesta']) ? $respuesta_local[$tienda->id]['fecha_respuesta'] : '-' }}
                                                            </td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['hora_respuesta']) ? $respuesta_local[$tienda->id]['hora_respuesta'] : '-' }}
                                                            </td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['cumple_tiempo']) ? $respuesta_local[$tienda->id]['cumple_tiempo'] : '-' }}
                                                            </td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['responsable']) ? $respuesta_local[$tienda->id]['responsable'] : '-' }}
                                                            </td>
                                                            <td>
                                                                {{ !empty($respuesta_local[$tienda->id]['cantidad'][$producto->id]) && $respuesta_local[$tienda->id]['cantidad'][$producto->id] > 0 ? 'C/P' : '' }}
                                                                {{ !empty($respuesta_local[$tienda->id]['cantidad'][$producto->id]) && $respuesta_local[$tienda->id]['cantidad'][$producto->id] == 0 ? 'S/P' : '' }}
                                                            </td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['cantidad'][$producto->id]) ? $respuesta_local[$tienda->id]['cantidad'][$producto->id] : '-' }}
                                                            </td>
                                                            <td>{{ !empty($respuesta_local[$tienda->id]['medio_retiro'][$producto->id]) ? $respuesta_local[$tienda->id]['medio_retiro'][$producto->id] : '-' }}
                                                            </td>
                                                            @if (
                                                                !empty($respuesta_local[$tienda->id]['responsable']) &&
                                                                    (Auth::user()->id == $recall->id_responsable || Auth::user()->root == 1))
                                                                <td class="text-center"><a title="Descargar PDF"
                                                                        href="{{ route('pdfRespuestaRecall', $respuesta_local[$tienda->id]['id']) }}"
                                                                        class="btn btn-circle btn-primary btn-sm"><i
                                                                            class="far fa-file-pdf"></i></a></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            $('#collapseRecall').addClass('show');
        });
        $('#notificarRecallBtn').click(function(e) {
            Swal.fire({
                title: "¿Deseas notificar a los locales?",
                showCancelButton: true,
                confirmButtonText: "Notificar",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.post("{{ route('recall.notificar.nuevo') }}", $("#notificacionRecallNuevoForm").serialize(), function(response) {
						Swal.fire(
							'El recall se ha notificado correctamente.',
							'',
							'success'
						);
					});
                }
            });
        });
    </script>
</x-layout>
