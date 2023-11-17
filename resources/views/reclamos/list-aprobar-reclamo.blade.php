<x-layout>
	<x-slot name="breadcrumb">
		Aprobar Reclamos
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
	        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Reclamos en espera de Aprobación y/o Rechazados</h6>
	            </div>
	            <div class="card-body">
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Reclamos por Aprobar</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed table-hover dataTable"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>N° Reclamo</th>
                                                <th>Producto</th>
                                                <th>Local</th>
                                                <th>Descripción Breve</th>
                                                <th>Tipo Reclamo</th>
                                                <th>Proveedor</th>
                                                <th>Fecha de ingreso</th>
                                                <th>Responsable</th>
                                                <th>Marca</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>                       
                                        <tbody>
                                            @foreach($reclamos_aprobar as $reclamo)
                                                <tr>
                                                    <td>{{$reclamo->id}}</td>
                                                    <td>{{$reclamo->nombre_producto}}</td>
                                                    <td>{{$reclamo->tienda->nombre.' - '.$reclamo->tienda->codigo}}</td>
                                                    <td>{{$reclamo->descripcion_reclamo}}</td>
                                                    <td>{{$reclamo->tipo_reclamo}}</td>
                                                    <td>{{$reclamo->nombre_proveedor}}</td>
                                                    <td>{{\Carbon\Carbon::parse($reclamo->reclamo_fecha)->format('d-m-Y')}}</td>
                                                    <td>{{$reclamo->responsable->name.' '.$reclamo->responsable->last_name}}</td>
                                                    <td>{{$reclamo->marca_producto}}</td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{ route('procesoReclamo',$reclamo->id)}}">
                                                            Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Reclamos Rechazados</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed table-hover dataTable"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>N° Reclamo</th>
                                                <th>Producto</th>
                                                <th>Local</th>
                                                <th>Descripción Breve</th>
                                                <th>Tipo Reclamo</th>
                                                <th>Proveedor</th>
                                                <th>Fecha de ingreso</th>
                                                <th>Responsable</th>
                                                <th>Marca</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>                       
                                        <tbody>
                                            @foreach($reclamos_rechazados as $reclamo)
                                                <tr>
                                                    <td>{{$reclamo->id}}</td>
                                                    <td>{{$reclamo->nombre_producto}}</td>
                                                    <td>{{$reclamo->tienda->nombre.' - '.$reclamo->tienda->codigo}}</td>
                                                    <td>{{$reclamo->descripcion_reclamo}}</td>
                                                    <td>{{$reclamo->tipo_reclamo}}</td>
                                                    <td>{{$reclamo->nombre_proveedor}}</td>
                                                    <td>{{\Carbon\Carbon::parse($reclamo->reclamo_fecha)->format('d-m-Y')}}</td>
                                                    <td>{{$reclamo->responsable->name.' '.$reclamo->responsable->last_name}}</td>
                                                    <td>{{$reclamo->marca_producto}}</td>
                                                    <td>
                                                        <button onclick="fnSearchReclamo({{ $reclamo->id }})" class="btn btn-primary" data-toggle="modal" data-target="#rechazadoReclamoModal">
                                                            Ver
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
    @include('reclamos.components.rechazado-reclamo-modal')
    <script>
		jQuery(document).ready(function(){
			$('#collapseReclamos').addClass('show');
		});
	</script>
</x-layout>