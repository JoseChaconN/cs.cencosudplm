<x-layout>
	<x-slot name="breadcrumb">
		Rechazos en Proceso
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
	        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Buscador</h6>
	            </div>
	            <div class="card-body">
	            	<div class="col-md-12">
	            		<form method="POST" action="{{ route('listProcesoRechazo')}}">
		               		@csrf
		               		<div class="row">
		               			<div class="col-md-4">
				        			<div class="form-group">
										<label class="">Mes:</label>
										<select name="mes" class="form-control">
									        <option value="">Seleccione</option>
									        @foreach ($meses_array as $key => $value)
									        	<option {{ $mes == $key ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
									        @endforeach
									    </select>
									</div>
								</div>
								<div class="col-md-4">
				        			<div class="form-group">
										<label class="">Año:</label>
										<select name="ano" class="form-control">
									        <option value="">Seleccione</option>
									        @for ($anio = date('Y'); $anio >= 2019; $anio--)
										        <option {{ $ano == $anio ? 'selected' : '' }} value="{{ $anio }}">{{ $anio }}</option>
										    @endfor
									    </select>
									</div>
								</div>								
								<div class="col-md-12">
				            		<hr class="sidebar-divider">
				            	</div>
		               		</div>
						  	<button class="btn btn-primary btn-icon-split" type="submit">
			                    <span class="icon text-white-50">
			                        <i class="fas fa-search"></i>
			                    </span>
			                    <span class="text">Buscar Rechazso</span>
			                </button>
	               		</form>
	            	</div>
	            	<div class="col-md-12">
	            		<hr class="sidebar-divider">
	            	</div>
					@if(!empty($mis_rechazos))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Mis Rechazos como Responsable</h6>
					            </div>
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table class="table table-bordered table-striped table-condensed table-hover dataTable" width="100%" cellspacing="0">
					                        <thead>
					                            <tr>
					                                <th>N° Rechazo</th>
					                                <th>Proveedor</th>
					                                <th>Responsable</th>
					                                <th>Tipo Rechazo</th>
					                                <th>Estado de Carga</th>
					                                <th>Fecha Generado</th>
					                                <th>Cant de Productos</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>
					                        <tbody>
					                        	@foreach($mis_rechazos as $mi_rechazo)
					                        		<tr>
						                                <td>{{$mi_rechazo->id}}</td>
						                                <td>{{$mi_rechazo->nombre_proveedor}}</td>
						                                <td>{{$mi_rechazo->nombre_usuario.' '.$mi_rechazo->apellido_usuario}}</td>
						                                <td>{{$mi_rechazo->tipo_rechazo}}</td>
						                                <td>{{$mi_rechazo->estado_carga}}</td>
						                                <td>{{date('d-m-Y',strtotime($mi_rechazo->fecha_inicio))}}</td>
						                                <td>{{date('d-m-Y',strtotime($mi_rechazo->fecha_inicio))}}</td>
						                                <td>
						                                	<a class="btn btn-primary btn-circle btn-sm" href="{{ route('procesoRechazo',$mi_rechazo->id)}}">
						                                        <i class="fa fa-check"></i>
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
					@endif
					@if(!empty($rechazos))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Otros Rechazos en Proceso</h6>
					            </div>
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table class="table table-bordered table-striped table-condensed table-hover dataTable" width="100%" cellspacing="0">
					                        <thead>
					                            <tr>
					                                <th>N° Rechazo</th>
					                                <th>Proveedor</th>
					                                <th>Responsable</th>
					                                <th>Tipo Rechazo</th>
					                                <th>Estado de Carga</th>
					                                <th>Fecha Generado</th>
					                                <th>Cant de Productos</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>                       
					                        <tbody>
					                        	@foreach($rechazos as $rechazo)
					                        		<tr>
						                                <td>{{$rechazo->id}}</td>
						                                <td>{{$rechazo->nombre_proveedor}}</td>
						                                <td>{{$rechazo->nombre_usuario.' '.$rechazo->apellido_usuario}}</td>
						                                <td>{{$rechazo->tipo_rechazo}}</td>
						                                <td>{{$rechazo->estado_carga}}</td>
						                                <td>{{date('d-m-Y',strtotime($rechazo->fecha_inicio))}}</td>
						                                <td>{{date('d-m-Y',strtotime($rechazo->fecha_inicio))}}</td>
						                                <td>
						                                	<a class="btn btn-primary btn-circle btn-sm" href="{{ route('procesoRechazo',$mi_rechazo->id)}}">
						                                        <i class="fa fa-check"></i>
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
				    @endif
	            </div>
	        </div>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRechazos').addClass('show');
		});
	</script>
</x-layout>
