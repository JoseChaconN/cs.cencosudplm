<x-layout>
	<x-slot name="breadcrumb">
		Recall en proceso
	</x-slot>
	<div class="col-lg-12">
	<div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recall en proceso</h6>
        </div>
        <form method="POST" action="{{ route('guardarRespuestaRecall') }}">
        	@csrf
        	<input type="hidden" name="id_recall" value="{{$recall->id}}">
        	<div class="card-body border-left-primary">
        		<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Información del proveedor</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{$recall->proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Rut del proveedor:</label> {{$recall->rut_proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12">
						<div class="form-group row">
	        				<label class="col-sm-4 col-form-label font-weight-bold">N° Recall:</label>
	        				<div class="col-sm-8">{{$recall->id}}</div>
	        			</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tipo de recall:</label>
							<div class="col-sm-8">
								{{$recall->recall}}
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
	        				<label class="col-sm-4 col-form-label font-weight-bold">Fecha de recall:</label>
	        				<div class="col-sm-8">{{$recall->momento_ingreso}}</div>
	        			</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo de recall:</label>
							<div class="col-sm-8">
								@if($recall->motivo == 'cliente')
									Por reclamo de cliente
								@endif
								@if($recall->motivo == 'sanitaria')
									Notificación de autoridad sanitaria.
								@endif
								@if($recall->motivo == 'interno')
									Reclamo interno.
								@endif
								@if($recall->motivo == 'proveedor')
									Solicitud de proveedor.
								@endif
								@if($recall->motivo == 'simulacro')
									Simulacro
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Descripción del problema:</label>
							<div class="col-sm-8">
								{{$recall->problema}}
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
		        			<label class="col-sm-4 col-form-label font-weight-bold">Sección:</label> 
		        			<div class="col-sm-8">{{$seccion->nombre}}</div>
		        		</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Acción correctiva inmediata:</label>
							<div class="col-sm-8">
								{{$recall->accion}}
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">¿Locales ingresan lotes?:</label>
							<div class="col-sm-8">
								@if($recall->locales_lotes == 1)
									Si
								@endif
								@if($recall->locales_lotes == 0)
									No
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">El Recall, en que tiendas se realizará:</label>
							<div class="col-sm-8">
								{{$recall->cadena}}
							</div>
						</div>
					</div>
					<!--div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 1:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input imagen_reclamo">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 2:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input imagen_reclamo">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 3:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input imagen_reclamo">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 4:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input imagen_reclamo">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 5:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input imagen_reclamo">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div-->
	                <div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tiempo de respuesta:</label>
							<div class="col-sm-8">
								@if($recall->recall == 'Calidad' || $recall->recall == 'Legalidad')
									24 Horas.
								@endif
								@if($recall->recall == 'Inocuidad')
									12 Horas.
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Fecha de ingreso:</label>
							<div class="col-sm-8">
								{{$recall->momento_ingreso}}
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Fecha de cierre para responder:</label>
							<div class="col-sm-8">
								{{$recall->momento_final}}
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Local:</label>
							<div class="col-sm-8">
								{{session('u_nombre_tienda').' - '.session('u_codigo_tienda')}}
							</div>
						</div>
					</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Productos asociados seleccionados</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="table-responsive">
		                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:13px">
		                        <thead>
		                            <tr>
		                                <th>Producto</th>
		                                <th>EAN</th>
		                                <th>SAP</th>
		                                <th>Marca</th>
		                                <th>Lote</th>
		                                <th>Fecha elaboración</th>
		                                <th>Fecha vencimiento</th>
		                                <th>Cantidad</th>
		                                <th>Unidad de medida</th>
		                                <th>Medio de retiro</th>
		                            </tr>
		                        </thead>                       
		                        <tbody>
		                        	@foreach($productos as $producto)
			                        	<tr>
			                                <td>
			                                	{{$producto->nombre}}
			                                	<input type="hidden" name="producto[{{$producto->id}}]" value="{{$producto->id}}">
			                                </td>
			                                <td>{{$producto->ean}}</td>
			                                <td>{{$producto->sap}}</td>
			                                <td>{{$producto->marca}}</td>
			                                <td><input class="form-control" type="text" {{($recall->locales_lotes != 1) ? 'readonly' : ''}} placeholder="Lote" name="lote[{{$producto->id}}]" value="{{$lote[$producto->id]}}"></td>
			                                <td><input class="form-control" type="text" {{($recall->locales_lotes != 1) ? 'readonly' : ''}} placeholder="Fecha elaboración" name="fecha_elaboracion[{{$producto->id}}]" value="{{$fecha[$producto->id]}}"></td>
			                                <td><input class="form-control" type="text" {{($recall->locales_lotes != 1) ? 'readonly' : ''}} placeholder="Fecha vencimiento" name="fecha_vencimiento[{{$producto->id}}]" value="{{$fecha_vencimiento[$producto->id]}}"></td>
			                                <td><input class="form-control inputDecimal" type="text" placeholder="Cantidad" name="cantidad_unidad[{{$producto->id}}]"></td>
			                                <td>
			                                	<select class="form-control" name="tipo_unidad[{{$producto->id}}]">
			                                		<option>Seleccione</option>
			                                		<option value="Unidad">Unidad</option>
			                                		<option value="Kilo">Kilo</option>
			                                	</select>
			                                </td>
			                                <td>
			                                	<select class="form-control" name="retiro_formato[{{$producto->id}}]">
			                                		<option>Seleccione</option>
			                                		<option value="Directo">Directo</option>
			                                		<option value="Centralizado">Centralizado</option>
			                                	</select>
			                                </td>
			                            </tr>
		                        	@endforeach	
		                        </tbody>
		                    </table>
	                	</div>
	        		</div>
	        	</div>
	        </div>
	        <div class="card-footer text-right">
	        	<button class="btn btn-primary btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fa fa-check"></i>
                    </span>
                    <span class="text">Ingresar Respuesta</span>
                </button>
	        </div>	       
        </form>
    </div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRecall').addClass('show');
		});
	</script>
</x-layout>