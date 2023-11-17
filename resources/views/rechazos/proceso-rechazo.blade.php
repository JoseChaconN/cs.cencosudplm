<x-layout>
	<x-slot name="breadcrumb">
		Rechazo {{$rechazo->status}}
	</x-slot>
	<div class="col-lg-12">
	<div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rechazo {{$rechazo->status}}</h6>
        </div>
        <form method="POST" action="{{ (!empty($rechazo->id)) ? route('guardarEditRechazo',$rechazo->id) : route('guardarRechazo') }}" enctype="multipart/form-data" id="rechazoForm">
        	@csrf
        	@if(!empty($rechazo->id))
        		@method('PATCH')
        	@endif
        	<input type="hidden" name="action" id="action" value="">
        	<input type="hidden" name="status" id="status" value="{{$rechazo->status}}">
        	<div class="card-body border-left-primary">
        		<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Información del proveedor</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{$proveedor->nombre}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Rut del proveedor:</label> {{$proveedor->rut}}
	        		</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Información del Rechazo</h6>
	        		</div>
					<div class="col-md-12">
						<div class="form-group row">
	        				<label class="col-sm-4 col-form-label font-weight-bold">Fecha:</label>
	        				<div class="col-sm-8">{{date('d-m-Y',strtotime($rechazo->created_at))}}</div>
	        			</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Fecha del Rechazo:</label>
							<div class="col-sm-8">
								<input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio',$rechazo->fecha_inicio)}}">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Secciones:</label>
							<div class="col-sm-8">
								<select name="secciones_rechazo[]" id="secciones_rechazo" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
							        @foreach($secciones as $seccion)
							        	<option {{ in_array($seccion->codigo, old('secciones_aca', $seccion_producto)) ? 'selected' : '' }} value="{{$seccion->codigo}}">{{$seccion->nombre}}</option>
							        @endforeach
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Rechazo:</label>
							<div class="col-sm-8">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline1" name="tipo_rechazo" class="custom-control-input" {{($rechazo->tipo_rechazo == 'Total') ? 'checked' : ''}} value="Total" onclick="$('#motivoTotal').show();">
									<label class="custom-control-label" for="customRadioInline1">Total</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline2" name="tipo_rechazo" class="custom-control-input" {{($rechazo->tipo_rechazo == 'Parcial') ? 'checked' : ''}} value="Parcial" onclick="$('#motivoTotal').hide();">
									<label class="custom-control-label" for="customRadioInline2">Parcial</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="motivoTotal" {{($rechazo->tipo_rechazo == 'Total') ? '' : 'style="display: none;"'}}>
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo de Rechazo Total:</label>
							<div class="col-sm-8">
								<select name="motivo_total" class="selectpicker" data-live-search="true" data-width="100%" title="Seleccione">
							        <option value="">Seleccione</option>
									<option {{($rechazo->motivo_total == 'Carga de mercadería volcada') ? 'selected' : ''}} value="Carga de mercadería volcada">Carga de mercadería volcada</option>
									<option {{($rechazo->motivo_total == 'Temperatura fuera de rango') ? 'selected' : ''}} value="Temperatura fuera de rango">Temperatura fuera de rango</option>
									<option {{($rechazo->motivo_total == 'Contaminación') ? 'selected' : ''}} value="Contaminación">Contaminación</option>
									<option {{($rechazo->motivo_total == 'Sin bandeja de piso') ? 'selected' : ''}} value="Sin bandeja de piso">Sin bandeja de piso</option>
									<option {{($rechazo->motivo_total == 'Problemas con Resolución Sanitaria del transporte') ? 'selected' : ''}} value="Problemas con Resolución Sanitaria del transporte">Problemas con Resolución Sanitaria del transporte</option>
									@if(session('u_zona_tienda') == 'BODEGAS')
										<option {{($rechazo->motivo_total == 'Fuera del rango de vida útil') ? 'selected' : ''}} value="Fuera del rango de vida útil">Fuera del rango de vida útil</option>
										<option {{($rechazo->motivo_total == 'Rotulación Incorrecta') ? 'selected' : ''}} value="Rotulación Incorrecta">Rotulación Incorrecta</option>
									@endif
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Estado de Carga:</label>
							<div class="col-sm-8">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="buenoCarga" name="estado_carga" value="Bueno" class="custom-control-input" {{($rechazo->estado_carga == 'Bueno') ? 'checked' : ''}} >
									<label class="custom-control-label" for="buenoCarga">Bueno</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="maloCarga" name="estado_carga" value="Malo" class="custom-control-input" {{($rechazo->estado_carga == 'Malo') ? 'checked' : ''}} >
									<label class="custom-control-label" for="maloCarga">Malo</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="regularCarga" name="estado_carga" value="Regular" class="custom-control-input" {{($rechazo->estado_carga == 'Regular') ? 'checked' : ''}} >
									<label class="custom-control-label" for="regularCarga">Regular</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Autorización especial:</label>
							<div class="col-sm-8">
								<input type="text" name="auto_especial" id="auto_especial" class="form-control" placeholder="Autorización especial" value="{{ old('auto_especial',$rechazo->auto_especial)}}">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Responsable autorizante:</label>
							<div class="col-sm-8">
								<input type="text" name="auto_responsable" id="auto_responsable" class="form-control" placeholder="Responsable autorizante" value="{{ old('auto_responsable',$rechazo->auto_responsable)}}">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo:</label>
							<div class="col-sm-8">
								<input type="text" name="auto_motivo" id="auto_motivo" class="form-control" placeholder="Motivo" value="{{ old('auto_motivo',$rechazo->auto_motivo)}}">
							</div>
						</div>
	        		</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Observaciones:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="obs_rechazo" id="obs_rechazo" rows="5" placeholder="Observaciones">{{ old('obs_rechazo',$rechazo->obs_rechazo)}}</textarea>
							</div>
						</div>
					</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12">
	        			<h6 class="m-0 font-weight-bold text-primary">Productos asociados al proveedor: {{$proveedor->nombre}}</h6>
	        		</div>
	        		<div class="col-md-12 mt-1">
	        			<span><small>* Seleccionar producto para habilitar editar información</small></span><br>
						<span><small>** Puede utilizar el campo "Buscar:" para filtrar entre el listado de productos.</small></span><br>
						<span><small>*** Solo se permite un máximo de 2 fotos por producto.</small></span><br>
	        		</div>
	        		
        			@if($rechazo->tipo_tienda != 'BODEGAS')
	        			<div class="col-md-12 mt-4">
		        			<div class="table-responsive tabla-contenedor">
			                    <table class="table table-bordered table-striped table-hover dataTableProd mi-tabla-scroll" style="font-size:12px" width="100%" cellspacing="0">
			                        <thead>
			                            <tr>
			                            	<th>X</th>
											<th>Producto</th>
											<th>Sección</th>
											<th>EAN</th>
											<th>SAP</th>										
											@if(in_array(6, $secciones_q))
												<th>Cantidad Rechazadas</th>
												<th title="Unidad Mínima Básica = formato de entrega">UMB</th>
												<!--th>O/C o Factura</th-->						
												<th>Orden de Compra o Número de Entrega</th>
												<th>Fotos</th>
											@endif
											<th class="vida_util {{(in_array(6, $secciones_q)) ? '' : 'd-none'}}">Fecha Elab</th>
											<th class="vida_util {{(in_array(6, $secciones_q)) ? '' : 'd-none'}}">Fecha Venc</th>
											<th>Motivos del Rechazo</th>
			                            </tr>
			                        </thead>                       
			                        <tbody>
			                        	@foreach($productos as $producto)
				                        	<tr class="tr_prod tr_sec_prod_{{$producto->id_seccion}} {{(in_array($producto->id,$id_producto)) ? 'table-success' : ''}}">
				                        		<td>
				                        			<input type="checkbox" class="check_prod check_prod_{{$producto->id}}" name="producto[{{$producto->id}}]" value="{{$producto->id}}">
				                        			<input type="hidden" name="seccion_producto[{{$producto->id}}]" value="{{$producto->id_seccion}}">
				                        		</td>
				                                <td>{{$producto->nombre}}</td>
				                                <td>{{$producto->nombre_seccion}}</td>
				                                <td>{{$producto->ean}}</td>
				                                <td>{{$producto->sap}}</td>
				                                @if(in_array(6, $secciones_q))
				                                	<td><input type="text" class="inputInt form-control form-control-sm prod_{{$producto->id}}" placeholder="" name="cant_cajas_rechz[{{$producto->id}}]" value="{{(!empty($cant_cajas_rechz[$producto->id])) ? $cant_cajas_rechz[$producto->id] : ''}}"></td>
													<td title="Unidad Mínima Básica = formato de entrega">
														<select class="form-control form-control-sm prod_{{$producto->id}}" disabled="" name="un_cant_cajas_rechz[{{$producto->id}}]" id="un_cant_cajas_rechz_{{$producto->id}}">
															<option value="">UMB</option>
															@foreach($unidades_medida as $index => $value)
																<option value="{{$value['val']}}" {{ (!empty($un_cant_cajas_rechz[$producto->id]) && $un_cant_cajas_rechz[$producto->id] == $value['val']) ? 'selected' : '' }} > {{$value['text']}}</option>
															@endforeach
														</select>
													</td>
													<td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" placeholder="" id="orden_compra_entrega_{{$producto->id}}" name="orden_compra_entrega[{{$producto->id}}]" value="{{(!empty($orden_compra_entrega[$producto->id])) ? $orden_compra_entrega[$producto->id] : ''}}"></td>
													<td><input class="form-control form-control-sm file-foto prod_{{$producto->id}}" disabled="" accept="image/jpg, image/jpeg, image/png" type="file" multiple name="fotos_prod_rechz[{{$producto->id}}][]" /></td>
				                                @endif
				                                <td class="{{(in_array(6, $secciones_q)) ? '' : 'd-none'}}"><input id="fecha_elab_{{$producto->id}}" class="form-control form-control-sm" type="date" placeholder="Fecha elaboración" name="fecha_elab[{{$producto->id}}]" value="{{(!empty($fecha_elab[$producto->id])) ? $fecha_elab[$producto->id] : ''}}"></td>
				                                <td class="{{(in_array(6, $secciones_q)) ? '' : 'd-none'}}"><input id="fecha_venc_{{$producto->id}}" class="form-control form-control-sm" type="date" placeholder="Fecha vencimiento" name="fecha_venc[{{$producto->id}}]" value="{{(!empty($fecha_venc[$producto->id])) ? $fecha_venc[$producto->id] : ''}}"></td>
				                                <td>
													<select class="form-control prod_{{$producto->id}} form-control-sm" disabled="" required="" name="causa_rechazo[{{$producto->id}}]" id="causa_rechazo_{{$producto->id}}" onchange="fnShowVidaUtil($(this).find('option:selected').attr('data-vida-util'),{{$producto->id}})">
														<option value="">Seleccione...</option>
														@foreach($motivos_rechazos as $motivo_rechazo)
															<option data-vida-util="{{$motivo_rechazo->vida_util}}" value="{{$motivo_rechazo->id}}" {{ (!empty($causa_rechazo[$producto->id]) && $causa_rechazo[$producto->id] == $motivo_rechazo->id) ? 'selected' : '' }}>{{$motivo_rechazo->causa_rechazo}}</option>
														@endforeach
													</select>
												</td>
				                            </tr>
			                        	@endforeach	
			                        </tbody>
			                    </table>
		                	</div>
		                </div>
                	@endif
                	@if($rechazo->tipo_tienda == 'BODEGAS')
                		<div class="col-md-12 mt-4">
		        			<div class="table-responsive tabla-contenedor">
			                    <table class="table table-bordered table-striped table-hover dataTableProd mi-tabla-scroll" style="font-size:12px" width="100%" cellspacing="0">
			                        <thead>
			                            <tr>
			                            	<th>X</th>
											<th>Descripción</th>
											<th>Sección</th>
											<th>Codigo Sap</th>
											<th>Cajas Recibidas</th>
											<th title="Unidad Mínima Básica = formato de entrega">UMB</th>
											<th>Cajas Rechazadas</th>
											<th title="Unidad Mínima Básica = formato de entrega">UMB</th>
											<th>Motivos del Rechazo</th>
											<th>Orden de Compra</th>
											<th>Folio de Rechazo</th>
											<th>Especificaciones</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($productos as $producto)
				                        	<tr class="tr_prod tr_sec_prod_{{$producto->id_seccion}} {($producto->id == $id_producto) ? 'table-success' : ''}}">
				                        		<td>
				                        			<input type="checkbox" class="check_prod check_prod_{{$producto->id}}" name="producto[{{$producto->id}}]" value="{{$producto->id}}">
				                        			<input type="hidden" name="seccion_producto[{{$producto->id}}]" value="{{$producto->id_seccion}}">
				                        		</td>
				                                <td>{{$producto->nombre}}</td>
				                                <td>{{$producto->nombre_seccion}}</td>
				                                <td>{{$producto->sap}}</td>
				                                <td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" disabled="" placeholder="" name="cant_cajas[{{$producto->id}}]" value="{{(!empty($cant_cajas[$producto->id])) ? $cant_cajas[$producto->id] : ''}}"></td>
												<td title="Unidad Mínima Básica = formato de entrega">
													<select class="form-control form-control-sm prod_{{$producto->id}}" disabled="" name="un_cant_cajas[{{$producto->id}}]" id="un_cant_cajas_{{$producto->id}}">
														<option value="">UMB</option>
														@foreach($unidades_medida as $index => $value)
															<option {{ (!empty($un_cant_cajas[$producto->id]) && $un_cant_cajas[$producto->id] == $value['val']) ? 'selected' : '' }} value="{{$value['val']}}">{{$value['text']}}</option>
														@endforeach
													</select>
												</td>
			                                	<td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" disabled="" placeholder="" name="cant_cajas_rechz[{{$producto->id}}]" value="{{(!empty($cant_cajas_rechz[$producto->id])) ? $cant_cajas_rechz[$producto->id] : ''}}"></td>
												<td title="Unidad Mínima Básica = formato de entrega">
													<select class="form-control form-control-sm prod_{{$producto->id}}" disabled="" name="un_cant_cajas_rechz[{{$producto->id}}]" id="un_cant_cajas_rechz_{{$producto->id}}">
														<option value="">UMB</option>
														@foreach($unidades_medida as $index => $value)
															<option {{ (!empty($un_cant_cajas_rechz[$producto->id]) && $un_cant_cajas_rechz[$producto->id] == $value['val']) ? 'selected' : '' }} value="{{$value['val']}}">{{$value['text']}}</option>
														@endforeach
													</select>
												</td>
				                                <td>
													<select class="form-control prod_{{$producto->id}} form-control-sm" disabled="" required="" name="causa_rechazo[{{$producto->id}}]" id="causa_rechazo_{{$producto->id}}" onchange="fnShowVidaUtil($(this).find('option:selected').attr('data-vida-util'),{{$producto->id}})">
														<option value="">Seleccione...</option>
														@foreach($motivos_rechazos as $motivo_rechazo)
															<option data-vida-util="{{$motivo_rechazo->vida_util}}" value="{{$motivo_rechazo->id}}" {{ (!empty($causa_rechazo[$producto->id]) && $causa_rechazo[$producto->id] == $motivo_rechazo->id) ? 'selected' : '' }}>{{$motivo_rechazo->causa_rechazo}}</option>
														@endforeach
													</select>
												</td>												
												<td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" disabled="" placeholder="" id="num_fact_{{$producto->id}}" name="num_fact[{{$producto->id}}]" value="{{(!empty($num_fact[$producto->id])) ? $num_fact[$producto->id] : ''}}"></td>
												<td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" disabled="" placeholder="" id="folio_rechazo_{{$producto->id}}" name="folio_rechazo[{{$producto->id}}]" value="{{(!empty($folio_rechazo[$producto->id])) ? $folio_rechazo[$producto->id] : ''}}"></td>
												<td><input type="text" class="form-control form-control-sm prod_{{$producto->id}}" disabled="" placeholder="" id="especificaciones_{{$producto->id}}" name="especificaciones[{{$producto->id}}]" value="{{(!empty($especificaciones[$producto->id])) ? $especificaciones[$producto->id] : ''}}"></td>
				                            </tr>
			                        	@endforeach	
			                        </tbody>
			                    </table>
		                	</div>
		        		</div>
                	@endif
	        		
	        	</div>
	        </div>
	        <div class="card-footer text-right">
	        	@if($rechazo->status != 'CERRADO')
		        	<button class="btn btn-primary btn-icon-split" type="submit">
	                    <span class="icon text-white-50">
	                        <i class="fa fa-check"></i>
	                    </span>
	                    <span class="text">Guardar Rechazo</span>
	                </button>
	                <button class="btn btn-danger btn-icon-split" type="button" id="cerrarBtn">
	                    <span class="icon text-white-50">
	                        <i class="fa fa-check"></i>
	                    </span>
	                    <span class="text">Cerrar Rechazo</span>
	                </button>
	                <button class="btn btn-warning btn-icon-split" type="button" id="responsableBtn">
	                    <span class="icon text-white-50">
	                        <i class="fa fa-check"></i>
	                    </span>
	                    <span class="text">Ser Responsable</span>
	                </button>
                @endif
	        </div>	       
        </form>
    </div>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
    		//$('.tr_prod').hide();
    		id_productos = {{json_encode($id_producto)}};
    		setTimeout(function() { 
    			$('#secciones_rechazo').trigger('change'); 
    			
    			if(id_productos.length > 0){
    				$.each(id_productos,function(index,value){
    					$('.check_prod_'+value).trigger('click');
    				});
    			}

    		}, 5000);
    		
    		
    	});
		$('#secciones_rechazo').on('change', function() {
			// Obtener todos los valores posibles del select
			var todosLosValores = [];
			$('#secciones_rechazo option').each(function() {
				todosLosValores.push($(this).val());
			});

			// Obtener los valores seleccionados en un array
			var valoresSeleccionados = $(this).val();

			// Obtener los valores no seleccionados
			var valoresNoSeleccionados = todosLosValores.filter(function(valor) {
				return valoresSeleccionados.indexOf(valor) === -1;
			});
			// Hacer un console.log por cada valor seleccionado
		    if (valoresSeleccionados) {
	    		valoresSeleccionados.forEach(function(valor) {
					$('.tr_sec_prod_'+valor).show();
					$('.check_prod_'+valor).removeAttr('disabled');
				});
		    }
			// Mostrar los valores no seleccionados en el console.log
			if (valoresNoSeleccionados.length > 0) {				
				valoresNoSeleccionados.forEach(function(valor) {
					$('.tr_sec_prod_'+valor).hide();
				});
			}
			/*var opcionesSeleccionadas = $(this).val();

	        // Mostrar u ocultar filas en función de las opciones seleccionadas
	        tabla.rows().every(function() {
	            var fila = this.node();
	            var tiposFila = String($(fila).data('seccion')).split(' ');

	            var mostrarFila = tiposFila.some(function(tipo) {
	                return opcionesSeleccionadas.includes(tipo);
	            });

	            if (mostrarFila) {
	                $(fila).show();
	            } else {
	                $(fila).hide();
	            }
	        });
	        tabla.order([1, 'asc']).draw();*/

		});
		$('.check_prod').click(function(){
			if($(this).is(':checked') ) {
				$('.prod_'+this.value).removeAttr('disabled').trigger("change");
				$('.tr_prod_'+this.value).addClass("table-success");
				//$('#causa_rechazo_'+this.value).addClass('requiredRechazo');
			}else{
				$('.prod_'+this.value).attr('disabled',true).trigger("change")
				$('.tr_prod_'+this.value).removeClass("table-success");
				//$('#causa_rechazo_'+this.value).removeClass('requiredRechazo');
			}
		})
		function fnShowVidaUtil(vida_util,id) {
			if(vida_util == 1){
				$('.vida_util').show();
				$('#fecha_elab_'+id).attr('required',true).addClass('required').removeAttr('disabled').trigger("change");			
				$('#fecha_venc_'+id).attr('required',true).addClass('required').removeAttr('disabled').trigger("change");
			}else{		
				$('#fecha_elab_'+id).removeAttr('required',true).removeClass('required').attr('disabled',true).trigger("change");
				$('#fecha_venc_'+id).removeAttr('required',true).removeClass('required').attr('disabled',true).trigger("change");
			}
		}
		$('#responsableBtn').click(function(){
			$('#action').val(1);
			$('#rechazoForm').submit();
		})
		$('#cerrarBtn').click(function(){
			$('#status').val('CERRADO');
			$('#rechazoForm').submit();
		})
    </script>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRechazos').addClass('show');
		});
	</script>
</x-layout>