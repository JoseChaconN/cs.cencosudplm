<x-layout>
	<x-slot name="breadcrumb">
		Informe de Gestión
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
	        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Listado de Recalls</h6>
	            </div>
	            <div class="card-body">
	            	<div class="col-md-12">
	            		<label class="m-0 font-weight-bold text-black">Buscador</label>
	            	</div>
	            	<div class="col-md-12">
	            		<form method="POST" action="{{ route('listProcesoReclamo')}}">
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
								<div class="col-md-4">
									<div class="form-group">
										<label for="n_recall">N° Recall:</label>
										<input type="text" class="form-control" id="n_recall" name="n_recall" placeholder="N° Recall" value="{{ empty($n_recall) ? '' : $n_recall }}">
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
			                    <span class="text">Buscar Recall</span>
			                </button>
			                <div class="col-md-12">
			            		<hr class="sidebar-divider">
			            	</div>
			            	 
			            	<div class="col-md-12">
			            		<table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
			                        <thead>
			                            <tr>
			                                <th>N° Recall</th>
			                                <th>Estado</th>
			                                <th>Proveedor</th>
			                                <th>Fecha de ingreso</th>
			                                <th>Tipo de recall</th>
			                                <th>Tiempo de cierre para Respuesta</th>
			                                <th>Ver</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($recalls as $recall)
			                        		<tr>
				                                <td>{{$recall->id}}</td>
				                                <td>{{$recall->status}}</td>
				                                <td>{{$recall->nombre_proveedor}}</td>
				                                <td>{{$recall->momento_ingreso}}</td>
				                                <td>{{$recall->recall}}</td>
				                                <td>{{$recall->momento_final}}</td>
				                                <td>
				                                	<a class="btn btn-primary btn-circle btn-sm" href="{{route('procesoRecall',$recall->id)}}">
				                                        <i class="fa fa-check"></i>
				                                    </a>
				                                </td>
				                            </tr>
			                        	@endforeach
			                        </tbody>
			                    </table>
			            	</div>
	               		</form>
	            	</div>
	            	<div class="col-md-12">
	            		<hr class="sidebar-divider">
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRecall').addClass('show');
		});
	</script>
</x-layout>