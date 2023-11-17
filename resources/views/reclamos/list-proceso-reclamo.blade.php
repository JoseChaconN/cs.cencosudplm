<x-layout>
	<x-slot name="breadcrumb">
		Reclamos en Proceso
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
										<label class="">Tipo Reclamo:</label>
										<select name="tipoReclamo" class="form-control">
									        <option value="">Seleccione</option>
									        <option {{ $tipoReclamo == 'Interno' ? 'selected' : '' }} value="Interno">Interno</option>
									        <option {{ $tipoReclamo == 'Externo' ? 'selected' : '' }} value="Externo">Externo</option>
									    </select>
									</div>
								</div>
								<div class="col-md-12">
				            		<hr class="sidebar-divider">
				            	</div>
				            	<div class="col-md-12">
				            		<label class="m-0 font-weight-bold text-black">Buscar por Producto</label>
				            	</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="nombreProd">Nombre producto:</label>
										<input type="text" class="form-control" id="nombreProd" name="nombreProd" placeholder="Nombre producto" value="{{ empty($nombreProd) ? '' : $nombreProd }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="eanProd">Código EAN:</label>
										<input type="text" class="form-control" id="eanProd" name="eanProd" placeholder="Código EAN" value="{{ empty($eanProd) ? '' : $eanProd }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="sapProd">Código SAP:</label>
										<input type="text" class="form-control" id="sapProd" name="sapProd" placeholder="Código SAP" value="{{ empty($sapProd) ? '' : $sapProd }}">
									</div>
								</div>
								<div class="col-md-12">
				            		<hr class="sidebar-divider">
				            	</div>
				            	<div class="col-md-12">
				            		<label class="m-0 font-weight-bold text-black">Buscar por Cliente</label>
				            	</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="rutCliente">RUT cliente:</label>
										<input type="text" class="form-control" id="rutCliente" name="rutCliente" placeholder="RUT cliente" value="{{ empty($rutCliente) ? '' : $rutCliente }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nomApeCliente">Nombre y/o Apellido cliente:</label>
										<input type="text" class="form-control" id="nomApeCliente" name="nomApeCliente" placeholder="Nombre y/o Apellido cliente" value="{{ empty($nomApeCliente) ? '' : $nomApeCliente }}">
									</div>
								</div>
		               		</div>
						  	<button class="btn btn-primary btn-icon-split" type="submit">
			                    <span class="icon text-white-50">
			                        <i class="fas fa-search"></i>
			                    </span>
			                    <span class="text">Buscar Reclamo</span>
			                </button>
	               		</form>
	            	</div>
	            	<div class="col-md-12">
	            		<hr class="sidebar-divider">
	            	</div>
	            	@if(!empty($reclamos_call_center))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Reclamos Call Center</h6>
					            </div>
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table class="table table-bordered table-striped table-responsive table-condensed table-hover dataTable" width="100%" cellspacing="0">
					                        <thead>
					                            <tr>
					                                <th>N° Reclamo</th>
					                                <th>Producto</th>
					                                <th>EAN</th>
					                                <th>SAP</th>
					                                <th>Proveedor</th>
					                                <th>Marca</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>                       
					                        <tbody>
					                        	@foreach($productos as $producto)
					                        		<tr>
						                                <td>{{$producto->mp == 1 ? 'Marcas Propias' : 'Supermercado'}}</td>
						                                <td>{{$producto->nombre}}</td>
						                                <td>{{$producto->ean}}</td>
						                                <td>{{$producto->sap}}</td>
						                                <td>{{$producto->proveedor}}</td>
						                                <td>{{$producto->marca}}</td>
						                                <td>
						                                	<button type="button" class="btn btn-primary btn-circle btn-sm" onclick="fnSelectProducto({{$producto->id}},'{{$producto->nombre}}')">
						                                        <i class="fa fa-check"></i>
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
					@endif
					@if(!empty($reclamos_sac))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Reclamos SAC</h6>
					            </div>
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table class="table table-bordered table-striped table-responsive table-condensed table-hover dataTable" width="100%" cellspacing="0">
					                        <thead>
					                            <tr>
					                                <th>N° Reclamo</th>
					                                <th>Producto</th>
					                                <th>Local</th>
					                                <th>Descripción Breve</th>
					                                <th>Tipo Reclamo</th>
					                                <th>Mensaje</th>
					                                <th>Proveedor</th>
					                                <th>Fecha de ingreso</th>
					                                <th>Fecha Resolución</th>
					                                <th>Responsable</th>
					                                <th>Marca</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>                       
					                        <tbody>
					                        	@foreach($productos as $producto)
					                        		<tr>
						                                <td>{{$producto->mp == 1 ? 'Marcas Propias' : 'Supermercado'}}</td>
						                                <td>{{$producto->nombre}}</td>
						                                <td>{{$producto->ean}}</td>
						                                <td>{{$producto->sap}}</td>
						                                <td>{{$producto->proveedor}}</td>
						                                <td>{{$producto->marca}}</td>
						                                <td>
						                                	<button type="button" class="btn btn-primary btn-circle btn-sm" onclick="fnSelectProducto({{$producto->id}},'{{$producto->nombre}}')">
						                                        <i class="fa fa-check"></i>
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
					@endif
					@if(!empty($mis_reclamos))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Mis Reclamos como Responsable</h6>
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
					                                <th>Mensaje</th>
					                                <th>Proveedor</th>
					                                <th>Fecha de ingreso</th>
					                                <th>Fecha Resolución</th>
					                                <th>Responsable</th>
					                                <th>Marca</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>
					                        <tbody>
					                        	@foreach($mis_reclamos as $mi_reclamo)
					                        		<tr>
						                                <td>{{$mi_reclamo->id}}</td>
						                                <td>{{$mi_reclamo->nombre_producto}}</td>
						                                <td>{{$mi_reclamo->nombre_tienda.' - '.$mi_reclamo->codigo_tienda}}</td>
						                                <td>{{$mi_reclamo->descripcion_reclamo}}</td>
						                                <td>{{$mi_reclamo->tipo_reclamo}}</td>
						                                <td>{{$mi_reclamo->interno_externo}}</td>
						                                <td>{{$mi_reclamo->nombre_proveedor}}</td>
						                                <td>{{\Carbon\Carbon::parse($mi_reclamo->reclamo_fecha)->format('d-m-Y')}}</td>
						                                <td>{{\Carbon\Carbon::parse($mi_reclamo->fecha_entrega)->format('d-m-Y')}}</td>
						                                <td>{{$mi_reclamo->nombre_usuario.' '.$mi_reclamo->apellido_usuario}}</td>
						                                <td>{{$mi_reclamo->marca_producto}}</td>
						                                <td>
						                                	<a class="btn btn-primary btn-circle btn-sm" href="{{ route('procesoReclamo',$mi_reclamo->id)}}">
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
					@if(!empty($reclamos))
					    <div class="col-lg-12 mb-4">
					    	<div class="card shadow mb-4">
					            <div class="card-header py-3">
					                <h6 class="m-0 font-weight-bold text-primary">Otros Reclamos en Proceso</h6>
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
					                                <th>Mensaje</th>
					                                <th>Proveedor</th>
					                                <th>Fecha de ingreso</th>
					                                <th>Fecha Resolución</th>
					                                <th>Responsable</th>
					                                <th>Marca</th>
					                                <th>-</th>
					                            </tr>
					                        </thead>                       
					                        <tbody>
					                        	@foreach($reclamos as $reclamo)
					                        		<tr>
						                                <td>{{$reclamo->id}}</td>
						                                <td>{{$reclamo->nombre_producto}}</td>
						                                <td>{{$reclamo->nombre_tienda.' - '.$reclamo->codigo_tienda}}</td>
						                                <td>{{$reclamo->descripcion_reclamo}}</td>
						                                <td>{{$reclamo->tipo_reclamo}}</td>
						                                <td>{{$reclamo->interno_externo}}</td>
						                                <td>{{$reclamo->nombre_proveedor}}</td>
						                                <td>{{\Carbon\Carbon::parse($reclamo->reclamo_fecha)->format('d-m-Y')}}</td>
						                                <td>{{\Carbon\Carbon::parse($reclamo->fecha_entrega)->format('d-m-Y')}}</td>
						                                <td>{{$reclamo->nombre_usuario.' '.$reclamo->apellido_usuario}}</td>
						                                <td>{{$reclamo->marca_producto}}</td>
						                                <td>
						                                	<a class="btn btn-primary btn-circle btn-sm" href="{{ route('procesoReclamo',$reclamo->id)}}">
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
			$('#collapseReclamos').addClass('show');
		});
	</script>
</x-layout>
