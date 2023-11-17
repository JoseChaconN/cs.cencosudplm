<x-layout>
	<x-slot name="breadcrumb">
		Inicio / Recall en proceso / Recall detalle 
	</x-slot>
    <form method="POST" id="excelForm" target="_blank" action="{{route('reporte.recalls.excel.respuesta-recall')}}">
        @csrf
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Productos del Recall</h6>
                </div>
                <div class="card-body border-left-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>EAN</th>
                                        </tr>
                                    </thead>                       
                                    <tbody>
                                        @foreach ($productos as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->ean }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="sidebar-divider">
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6 class="m-0 font-weight-bold text-primary">Productos asociados al proveedor: {{$recall->proveedor}}</h6>
                        </div>
                        @foreach($productos as $producto)
                            <div class="col-md-12 mb-4">
                                <div class="card shadow ">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-warning">Respuestas del producto: {{$producto->nombre}} <button onclick="$('#icon_{{$producto->id}}').toggleClass('fa fa-solid fa-arrow-up fa fa-solid fa-arrow-down');$('#detalle_producto_{{$producto->id}}').toggle('slow')" class="btn btn-primary btn-circle"><i class="fa fa-solid fa-arrow-up" id="icon_{{$producto->id}}"></i></button></h6>
                                    </div>
                                    <div class="card-body border-left-warning" style="display:none" id="detalle_producto_{{$producto->id}}">
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
                                                            <td>{{$producto->nombre}}</td>
                                                            <td>{{$producto->ean}}</td>
                                                            <td>{{$producto->sap}}</td>
                                                            <td>{{$producto->marca}}</td>
                                                            <td>Con Problemas</td>
                                                            <td>{{$lote[$producto->id]}}</td>
                                                            <td>{{$fecha[$producto->id]}}</td>
                                                            <td>{{$fecha_vencimiento[$producto->id]}}</td>
                                                            <td>
                                                                <button onclick="$('#respuestas_{{$producto->id}}').toggleClass('fa fa-solid fa-arrow-up fa fa-solid fa-arrow-down');$('#respuestas_producto_{{$producto->id}}').toggle('slow')" class="btn btn-primary btn-circle"><i class="fa fa-solid fa-arrow-up" id="respuestas_{{$producto->id}}"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12" id="respuestas_producto_{{$producto->id}}" style="display:none;">
                                                <table class="table table-bordered table-condensed" width="100%" cellspacing="0" style="font-size: 13px;">
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
                                                            @if(Auth::user()->id == $recall->id_responsable ||  Auth::user()->root == 1)
                                                                <th>PDF Respuesta</th>
                                                                <!--th>Eliminar</th-->
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tiendas as $tienda)
                                                            <tr class="{{(session('u_id_tienda') == $tienda->id) ? 'table-primary' : ''}}">
                                                                <td>{{$tienda->zona}}</td>
                                                                <td>{{$tienda->nombre}}</td>
                                                                <td>{{$tienda->codigo}}</td>
                                                                <td>{{$tienda->categoria}}</td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['fecha_respuesta'])) ? $respuesta_local[$tienda->id]['fecha_respuesta'] : '-'}}</td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['hora_respuesta'])) ? $respuesta_local[$tienda->id]['hora_respuesta'] : '-'}}</td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['cumple_tiempo'])) ? $respuesta_local[$tienda->id]['cumple_tiempo'] : '-'}}</td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['responsable'])) ? $respuesta_local[$tienda->id]['responsable'] : '-'}}</td>
                                                                <td>
                                                                    {{(!empty($respuesta_local[$tienda->id]['cantidad'][$producto->id]) && $respuesta_local[$tienda->id]['cantidad'][$producto->id] > 0 ) ? 'C/P':''}}
                                                                    {{(!empty($respuesta_local[$tienda->id]['cantidad'][$producto->id]) && $respuesta_local[$tienda->id]['cantidad'][$producto->id] == 0 ) ? 'S/P':''}}
                                                                </td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['cantidad'][$producto->id])) ? $respuesta_local[$tienda->id]['cantidad'][$producto->id]: '-'}}</td>
                                                                <td>{{(!empty($respuesta_local[$tienda->id]['medio_retiro'][$producto->id])) ? $respuesta_local[$tienda->id]['medio_retiro'][$producto->id]: '-'}}</td>
                                                                @if( !empty($respuesta_local[$tienda->id]['responsable']) && (Auth::user()->id == $recall->id_responsable || Auth::user()->root == 1))
                                                                    <td class="text-center"><a title="Descargar PDF" href="{{route('pdfRespuestaRecall',$respuesta_local[$tienda->id]['id'])}}" class="btn btn-circle btn-primary btn-sm"><i class="far fa-file-pdf"></i></a></td>
                                                                    <td><a title="Editar Respuesta" class="btn btn-circle btn-warning btn-sm" href="{{route('respuestaRecallEdit',$respuesta_local[$tienda->id]['id'])}}"><i class="far fa-edit"></i></a></td>
                                                                    <!--td><a title="Eliminar Respuesta" class="btn btn-circle btn-danger btn-sm"><i class="fas fa-trash"></i></a></td-->
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
    </div>
    <script>
        jQuery(document).ready(function(){
            $('#collapseReporte').addClass('show');
        });
    </script>
</x-layout>