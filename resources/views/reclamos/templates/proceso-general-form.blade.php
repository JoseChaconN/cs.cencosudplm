<div class="col-lg-12">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-{{ $color_form }}">Formulario Reclamo en Proceso N° {{$reclamo->id}} <button class="btn btn-secondary btn-sm" type="button" data-toggle="modal" data-target="#notificarReclamoModal">Notificar reclamo a locales</button></h6>
        </div>
        <form method="POST" action="{{ route('guardarReclamoProceso',$reclamo->id) }}" id="reclamoForm" enctype="multipart/form-data">
        	@csrf
        	@method('PATCH')
        	<input type="hidden" name="status" id="status" value="{{$reclamo->status}}">
	        <div class="card-body border-left-{{ $color_form }}">
	        	<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Información del producto</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Nombre del producto:</label> {{$reclamo->nombre_producto}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">EAN 13:</label> {{$reclamo->ean_producto}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Código SAP:</label> {{$reclamo->sap_producto}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Marca del producto:</label> {{(!empty($reclamo->marca_frigorifico)) ? $reclamo->marca_frigorifico : $reclamo->marca_producto}}
	        		</div>
	        		@if(!empty($reclamo->id_frigorifico))
		        		<div class="col-md-12">
		        			<label class="font-weight-bold">Frigorifico:</label> {{$frigorifico->nombre}}
		        		</div>
		        		<div class="col-md-12">
		        			<label class="font-weight-bold">SIF/Planta:</label> {{$reclamo->sif}}
		        		</div>
	        		@endif
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{ (!empty($razon_social_frigo->razon_social)) ? $razon_social_frigo->razon_social : $reclamo->nombre_proveedor }}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Rut del proveedor:</label> {{ (!empty($razon_social_frigo->rut)) ? $razon_social_frigo->rut : $reclamo->rut_proveedor }}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Producto importado:</label> {{$reclamo->es_importado}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Cliente es:</label> {{$reclamo->interno_externo}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Tipo de despacho:</label> {{$reclamo->despacho}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">El cliente solicita respuesta a su reclamo:</label> {{$reclamo->formal_informal}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Área del reclamo:</label> <span class="text-{{$color_form }}">{{$reclamo->categoria}}</span>
	        		</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Detalle del problema</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Local:</label> {{$tienda->nombre.' - '.$tienda->codigo}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Sección:</label> {{$seccion->nombre}}
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Fecha de generación del reclamo en el local:</label>
							<div class="col-sm-8">
								<input type="date" name="fecha_local" class="form-control" value="{{ old('fecha_local' , $reclamo->fecha_local)}}">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Formato del producto:</label>
							<div class="col-sm-8">
								<input type="text" name="formato" class="form-control" value="{{ old('formato' , $reclamo->formato)}}">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Cantidad total con problemas en el local:</label>
								<div class="col-sm-8">
								<input type="text" name="cantidad_problema" class="form-control inputDecimal" value="{{ old('cantidad_problema' , $reclamo->cantidad_problema)}}">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Unidad Cantidad total con problemas en el local:</label>
							<div class="col-sm-8">
								<select name="unidad_cantidad_problema" class="form-control">
							        <option value="">Seleccione</option>
							        <option {{ $reclamo->unidad_cantidad_problema == 'unidad' ? 'selected' : '' }} value="unidad">Unidad/es</option>
							        <option {{ $reclamo->unidad_cantidad_problema == 'caja' ? 'selected' : '' }} value="caja">Caja/s</option>
							        <option {{ $reclamo->unidad_cantidad_problema == 'Kg' ? 'selected' : '' }} value="Kg">Kg</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Comentario Cantidad total con problemas en el local:</label>
							<div class="col-sm-8">
								<input type="text" name="comentario_cantidad_problema" class="form-control" value="{{ old('comentario_cantidad_problema' , $reclamo->comentario_cantidad_problema)}}">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Lote:</label>
							<div class="col-sm-8">
								<input type="text" name="lote" class="form-control" value="{{ old('lote' , $reclamo->lote)}}">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Elaboración:</label>
							<div class="col-sm-8">
								<input type="text" name="elaboracion" class="form-control" value="{{ old('elaboracion' , $reclamo->elaboracion)}}">
								<small class="form-text text-muted">En caso de que no aplique, escribir N/A.</small>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Vencimiento:</label>
							<div class="col-sm-8">
								<input type="text" name="vencimiento" class="form-control" value="{{ old('vencimiento' , $reclamo->vencimiento)}}">
								<small class="form-text text-muted">En caso de que no aplique, escribir N/A.</small>
							</div>
						</div>
					</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Aplica registro de temperaturas:</label>
							<div class="col-sm-8">
								<select name="aplica_temperatura" class="form-control selectChange" onchange="(this.value == 'sí') ? $('.aplica_temperatura').show() : $('.aplica_temperatura').hide()">
							        <option value="">Seleccione</option>
							        <option {{ $reclamo->aplica_temperatura == 'sí' ? 'selected' : '' }} value="sí">Sí</option>
							        <option {{ $reclamo->aplica_temperatura == 'no' ? 'selected' : '' }} value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12 aplica_temperatura" style="display: none;">
						<div class="col-md-12">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Registro de temperaturas</h6>
							<small class="form-text text-muted">En caso que aplique al reclamo.</small>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Recepción:</label>
								<div class="col-sm-8">
									<input type="date" name="recepcion" class="form-control" value="{{ old('recepcion' , $reclamo->recepcion)}}">
								</div>
							</div>
		        		</div>
		        		<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Cámaras refrigeradas:</label>
								<div class="col-sm-8">
									<input type="text" name="camaras" class="form-control" value="{{ old('camaras' , $reclamo->camaras)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Vitrinas/Góndolas:</label>
								<div class="col-sm-8">
									<input type="text" name="vitrina" class="form-control" value="{{ old('vitrina' , $reclamo->vitrina)}}">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Aplica Carnes y Fab. de Cecinas:</label>
							<div class="col-sm-8">
								<select name="aplica_carnes" class="form-control selectChange" onchange="(this.value == 'sí') ? $('.aplica_carnes').show() : $('.aplica_carnes').hide()">
							        <option value="">Seleccione</option>
							        <option {{ $reclamo->aplica_carnes == 'sí' ? 'selected' : '' }} value="sí">Sí</option>
							        <option {{ $reclamo->aplica_carnes == 'no' ? 'selected' : '' }} value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12 aplica_carnes" style="display:none;">
						<div class="col-md-12">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Exclusivo Carnes y Fab. de Cecinas</h6>
							<small class="form-text text-muted">En caso que aplique al reclamo.</small>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre frigorifico y nacionalidad:</label>
								<div class="col-sm-8">
									<input type="text" name="frigorifico" class="form-control" value="{{ old('frigorifico' , $reclamo->frigorifico)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Fecha faena:</label>
								<div class="col-sm-8">
									<input type="date" name="fecha_faena" class="form-control" value="{{ old('fecha_faena' , $reclamo->fecha_faena)}}">
								</div>
							</div>
		        		</div>
		        		<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Cantidad recibida:</label>
								<div class="col-sm-8">
									<input type="text" name="cantidad_recibida" class="form-control inputDecimal" value="{{ old('cantidad_recibida' , $reclamo->cantidad_recibida)}}">
								</div>
							</div>
		        		</div>
					</div>
					<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Descripción del reclamo:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="descripcion_reclamo" rows="3" placeholder="">{{ old('descripcion_reclamo' , $reclamo->descripcion_reclamo)}}</textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Observaciones del cliente:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="observaciones_cliente" rows="3" placeholder="">{{ old('observaciones_cliente' , $reclamo->observaciones_cliente)}}</textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo del reclamo:</label>
							<div class="col-sm-8">
								<select class="form-control" name="motivo_reclamo">
							        <option value="">Seleccione</option>
									<option {{ $reclamo->motivo_reclamo == 'Producto en mal estado (mal olor, color atípico, ácido)' ? 'selected' : '' }} value="Producto en mal estado (mal olor, color atípico, ácido)">Producto en mal estado (mal olor, color atípico, ácido)</option>
									<option {{ $reclamo->motivo_reclamo == 'Contaminación Física (partículas extrañas)' ? 'selected' : '' }} value="Contaminación Física (partículas extrañas)">Contaminación Física (partículas extrañas)</option>
									<option {{ $reclamo->motivo_reclamo == 'Desarrollo Fúngico (hongos)' ? 'selected' : '' }} value="Desarrollo Fúngico (hongos)">Desarrollo Fúngico (hongos)</option>
									<option {{ $reclamo->motivo_reclamo == 'Otros (consistencia atípica, acuoso, ácido)' ? 'selected' : '' }} value="Otros (consistencia atípica, acuoso, ácido)">Otros (consistencia atípica, acuoso, ácido)</option>
									<option {{ $reclamo->motivo_reclamo == 'Vencimiento y/o rotulación' ? 'selected' : '' }} value="Vencimiento y/o rotulación">Vencimiento y/o rotulación</option>
									<option {{ $reclamo->motivo_reclamo == 'Sellado deficiente' ? 'selected' : '' }} value="Sellado deficiente">Sellado deficiente</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tipo del reclamo:</label>
							<div class="col-sm-8">
								<select class="form-control" name="tipo_reclamo">
									<option value="">Seleccione</option>
									<option {{ $reclamo->tipo_reclamo == 'Calidad' ? 'selected' : '' }} value="Calidad">Calidad / Leve - 5 Días</option>
									<option {{ $reclamo->tipo_reclamo == 'Legalidad' ? 'selected' : '' }} value="Legalidad">Legalidad / Medio - 24hrs</option>
									<option {{ $reclamo->tipo_reclamo == 'Inocuidad' ? 'selected' : '' }} value="Inocuidad">Inocuidad / Alto - Inmediato</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Responsable:</label>
							<div class="col-sm-8">
								<span>{{$responsable->name.' '.$responsable->last_name.' - '.$responsable->email}}</span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Origen de venta:</label>
							<div class="col-sm-8">
								<select class="form-control" name="origen_venta">
									<option value="">Seleccione</option>
									<option {{ $reclamo->origen_venta == 'Presencial' ? 'selected' : '' }} value="Presencial">Presencial</option>
									<option {{ $reclamo->origen_venta == 'Web' ? 'selected' : '' }} value="Web">Web</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tienda presencial:</label>
							<div class="col-sm-8">
								<select class="form-control" name="origen_venta_tienda">
							        @foreach($tiendas as $tienda)
							        	<option {{ $reclamo->origen_venta_tienda == $tienda->id ? 'selected' : '' }} value="{{$tienda->id}}">{{$tienda->codigo.' - '.$tienda->nombre}}</option>
							        @endforeach
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Origen del reclamo:</label>
							<div class="col-sm-8">
								<select class="form-control" name="origen">
							        <option value="">Seleccione</option>
							        @foreach($origenes_reclamo as $origen)
							        	<option {{ $reclamo->origen == $origen->id ? 'selected' : '' }} value="{{$origen->id}}">{{$origen->nombre}}</option>
							        @endforeach
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">¿Existe información sobre el cliente?</label>
							<div class="col-sm-8">
								<select class="form-control" name="aplica_cliente">
							        <option value="">Seleccione</option>
							        <option {{ $reclamo->aplica_cliente == 'sí' ? 'selected' : '' }} value="sí">Sí</option>
							        <option {{ $reclamo->aplica_cliente == 'no' ? 'selected' : '' }} value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12 datos_cliente">
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre del cliente:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nombre_cliente" value="{{ old('nombre_cliente' , $reclamo->nombre_cliente)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Télefono:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="telefono_cliente" value="{{ old('telefono_cliente' , $reclamo->telefono_cliente)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Dirección:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="direccion_cliente" value="{{ old('direccion_cliente' , $reclamo->direccion_cliente)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Rut:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control inputRut" name="rut_cliente" value="{{ old('rut_cliente' , $reclamo->rut_cliente)}}">
								</div>
							</div>
						</div>
					</div>
					@if ($reclamo->status != 'APROBAR')
						<div class="col-md-12">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Contacto con cliente</h6>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Primer contacto:</label>
								<div class="col-sm-8">
									<textarea class="form-control" style="resize: none;" name="obs_cliente" rows="3" placeholder="">{{ old('obs_cliente' , $reclamo->obs_cliente)}}</textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Segundo contacto:</label>
								<div class="col-sm-8">
									<textarea class="form-control" style="resize: none;" name="obs_cliente_2" rows="3" placeholder="">{{ old('obs_cliente_2' , $reclamo->obs_cliente_2)}}</textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Tercer contacto:</label>
								<div class="col-sm-8">
									<textarea class="form-control" style="resize: none;" name="obs_cliente_3" rows="3" placeholder="">{{ old('obs_cliente_3' , $reclamo->obs_cliente_3)}}</textarea>
								</div>
							</div>
						</div>
						@if(session('u_area') == 'ATENTO')
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Mensaje de Alerta Servicio al cliente:</label>
									<div class="col-sm-8">
										<textarea class="form-control" style="resize: none;" name="mensaje_atento" id="mensaje_atento" rows="3" placeholder="">{{ old('mensaje_atento' , $reclamo->mensaje_atento)}}</textarea>
									</div>
								</div>
							</div>
						@endif
						@if(session('u_area') != 'ATENTO' && !empty($reclamo->mensaje_atento))
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Mensaje de Alerta Servicio al cliente:</label>
									<div class="col-sm-8">
										<p>{{ $reclamo->mensaje_atento}}<input type="hidden" name="mensaje_atento" value="{{ $reclamo->mensaje_atento}}"></p>
									</div>
								</div>
							</div>
						@endif
						<div class="col-md-12">
								<hr class="sidebar-divider">
							</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">¿Derivar a proveedor?</label>
								<div class="col-sm-8">
									<select class="form-control selectChange" name="aplica_proveedor_derivar" onchange="(this.value == 'sí') ? $('.datos_proveedor').show() : $('.datos_proveedor').hide()">
										<option value="">Seleccione</option>
										<option {{ $reclamo->aplica_proveedor_derivar == 'sí' ? 'selected' : '' }} value="sí">Sí</option>
										<option {{ $reclamo->aplica_proveedor_derivar == 'no' ? 'selected' : '' }} value="no">No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12 datos_proveedor">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Contacto con Proveedor</h6>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Fecha de contacto:</label>
									<div class="col-sm-8">
										<input type="date" name="fecha_contacto_prov" class="form-control" value="{{ old('fecha_contacto_prov' , $reclamo->fecha_contacto_prov)}}">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Observaciones:</label>
									<div class="col-sm-8">
										<textarea class="form-control" style="resize: none;" name="observaciones_prov" rows="3" placeholder="">{{ old('observaciones_prov' , $reclamo->obs_prov)}}</textarea>
									</div>
								</div>
							</div>
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Respuesta o Informe</h6>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Fecha de respuesta:</label>
									<div class="col-sm-8">
										<input type="date" name="fecha_respuesta_prov" class="form-control" value="{{ old('fecha_respuesta_prov' , $reclamo->fecha_respuesta_prov)}}">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Acciones Correctivas Implementadas:</label>
									<div class="col-sm-8">
										<input type="text" name="acciones_prov" class="form-control" value="{{ old('acciones_prov' , $reclamo->acciones_prov)}}">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">¿Responsabilidad de proveedor:?</label>
									<div class="col-sm-8">
										<select class="form-control" name="aplica_proveedor">
											<option value="">Seleccione</option>
											<option {{ $reclamo->aplica_proveedor == 'sí' ? 'selected' : '' }} value="sí">Sí</option>
											<option {{ $reclamo->aplica_proveedor == 'no' ? 'selected' : '' }} value="no">No</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold">Observación de por qué no aplica:</label>
									<div class="col-sm-8">
										<input type="text" name="no_observacion" class="form-control" value="{{ old('no_observacion' , $reclamo->no_obs)}}">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<hr class="sidebar-divider">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Investigación Técnica de Aseguramiento de Calidad:</label>
								<div class="col-sm-8">
									<textarea class="form-control" style="resize: none;" name="obs_general"  rows="3" placeholder="">{{ old('obs_general' , $reclamo->obs_general)}}</textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Observaciones Logística / Importados:</label>
								<div class="col-sm-8">
									<textarea class="form-control" style="resize: none;" name="msj_log_imp" rows="3" placeholder="">{{ old('msj_log_imp' , $reclamo->msj_log_imp)}}</textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Gestión presencial:</label>
								<div class="col-sm-8">
									<select class="form-control" name="doble_garantia">
										<option value="">Seleccione</option>
										<option {{ $reclamo->doble_garantia == 'Doble Garantía' ? 'selected' : '' }} value="Doble Garantía">Doble Garantía</option>
										<option {{ $reclamo->doble_garantia == 'Cambio Simple' ? 'selected' : '' }} value="Cambio Simple">Cambio Simple</option>
										<option {{ $reclamo->doble_garantia == 'Devolución de Dinero' ? 'selected' : '' }} value="Devolución de Dinero">Devolución de Dinero</option>
										<option {{ $reclamo->doble_garantia == 'Otro' ? 'selected' : '' }} value="Otro">Otro</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12 mb-4">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Documentos e imágenes del reclamo.</h6>
							<small class="form-text text-muted">Usted podrá subir máximo 6 documentos y 6 imágenes.</small>
						</div>
						<div class="col-md-6">
							<h6>Documentos</h6>
							<button class="btn btn-primary btn-icon-split btn-sm" type="button" onclick="fnAddMoreDocumentos()">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">Agregar Documentos</span>
							</button>
							<div class="col-md-12">
								<hr class="sidebar-divider">
							</div>
							<div class="col-md-12 mb-4" id="documento_" style="display:none;">
								<label>Documento:</label>
								<button class="btn-danger btn-circle btn-sm btn-delete-documento"><i class="fas fa-trash"></i></button>
								<div class="custom-file">
								<input type="file" class="custom-file-input documento_reclamo">
								<label class="custom-file-label" >Buscar Archivo</label>
								</div>
							</div>
							<div class="documentos-div">
								@if(!empty($reclamo->getMedia('documentos_reclamos')))
									@foreach ($reclamo->getMedia('documentos_reclamos') as $item)
										<div class="col-md-12 mb-4" >
											<a class="btn btn-success" href="{{$item->getUrl()}}">Descargar Documento</a>
											<!--button class="btn-danger btn-circle btn-sm btn-delete-documento" onclick="$('#divDoc_').remove()"><i class="fas fa-trash"></i></button-->
										</div>
									@endforeach
								@endif
							</div>
						</div>
						<div class="col-md-6 border-left-dark">
							<h6>Imágenes</h6>
							<button class="btn btn-primary btn-icon-split btn-sm" type="button" onclick="fnAddMoreImagenes()">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">Agregar Imágenes</span>
							</button>
							<div class="col-md-12">
								<hr class="sidebar-divider">
							</div>
							<div class="col-md-12 mb-4" id="imagen_" style="display:none;">
								<label>Imagen:</label>
								<button class="btn-danger btn-circle btn-sm btn-delete-imagen"><i class="fas fa-trash"></i></button>
								<div class="custom-file">
								<input type="file" class="custom-file-input imagen_reclamo">
								<label class="custom-file-label" >Subir Imagen</label>
								</div>
							</div>
							<div class="imagenes-div">
								@if(!empty($reclamo->getMedia('imagenes_reclamos')))
									@foreach ($reclamo->getMedia('imagenes_reclamos') as $item)
										<div class="col-md-12 mb-4" >
											<a class="btn btn-success" target="_blank" href="{{$item->getUrl()}}" download="">Descargar Imagen</a>
											<!--button class="btn-danger btn-circle btn-sm btn-delete-documento" onclick="$('#divDoc_').remove()"><i class="fas fa-trash"></i></button-->
										</div>
									@endforeach
								@endif
							</div>
						</div>
						<div class="col-md-12 mt-4">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-warning">Otros locales con mismo problema 
										@if($reclamo->id_responsable == Auth::user()->id || in_array($reclamo->id_local,session('u_tiendas_sup'))) 
											<button class="btn btn-primary" type="button" onclick="fnAddMoreProblemaTienda()">Agregar Respuesta</button> - 
										@endif 
										<a class="btn btn-success" href="{{route('reclamos.respuestas-local',$reclamo->id)}}" target="_blank">Descargar Respuestas</a></h6>
								</div>
								<div class="card-body border-left-warning" id="localesConProblemaDiv">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-sm table-bordered table-striped table-hover" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>Nombre de usuario</th>
														<th>Fecha de respuesta</th>
														<th>Tienda</th>					                                
														<th>Resultado</th>
														<th>Lote</th>
														<th>Fecha elaboración</th>
														<th>Fecha vencimiento</th>
														<th>Cantidad</th>
														<th>Unidad de medida</th>
														<th>Medio de retiro</th>
														<th>X</th>
													</tr>
												</thead>
												<tbody class="tiendasProblemaTBody">
													<tr id="tr_" class="d-none">
														<td>
															{{session('u_nombre').' '.session('u_apellido')}}
															<input type="hidden" class="form-control input-sm usuario_problema_tienda" value="{{Auth::user()->id}}">
														</td>
														<td>{{date('d-m-Y')}}</td>
														<td>{{session('u_codigo_tienda').' - '.session('u_nombre_tienda')}}
															<input type="hidden" class="form-control input-sm id_tienda_problema_tienda" value="{{Auth::user()->id}}">
														</td>
														<td>
															<select class="form-control form-control-sm resultado_problema_tienda">
																<option value="">Seleccione Problema</option>
																<option value="Con Problema">Con Problema</option>
																<option value="Sin Problema">Sin Problema</option>
																<option value="Sin Stock">Sin Stock</option>
															</select>
														</td>
														<td><input type="text" class="form-control form-control-sm lote_problema_tienda"></td>
														<td><input type="text" class="form-control form-control-sm fecha_elab_problema_tienda"></td>
														<td><input type="text" class="form-control form-control-sm fecha_venc_problema_tienda"></td>
														<td><input type="number" class="form-control form-control-sm cantidad_problema_tienda inputDecimal"></td>
														<td>
															<select class="form-control form-control-sm unidad_cantidad_problema_tienda">
																<option value="">Seleccione</option>
																<option value="unidad">Unidad/s</option>
																<option value="caja">Caja/s</option>
																<option value="Kg">Kg</option>
															</select>
														</td>
														<td>
															<select class="form-control form-control-sm retiro_problema_tienda">
																<option value="">Seleccione</option>
																<option value="Directo">Directo</option>
																<option value="Centralizado">Centralizado</option>
															</select>
														</td>
														<td>
															<button class="btn-danger btn-circle btn-sm btn-delete-problema-tienda"><i class="fas fa-trash"></i></button>
														</td>
													</tr>
													@foreach($locales_problemas as $row)
														<tr>
															<td>{{$row->name.' '.$row->last_name}}</td>
															<td>{{date('d-m-Y',strtotime($row->created_at))}}</td>
															<td>{{$row->nombre.' '.$row->codigo}}</td>
															<td>{{$row->resultado}}</td>
															<td>{{$row->lote}}</td>
															<td>{{$row->fecha_elab}}</td>
															<td>{{$row->fecha_venc}}</td>
															<td>{{$row->cantidad}}</td>
															<td>{{$row->unidad_cantidad}}</td>
															<td>{{$row->retiro}}</td>
															<td></td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
	        	</div>
	        </div>
	        <div class="card-footer">
				@if ($reclamo->status == 'PROCESO')
					<div class="row">
						<div class="col-md-6">
						<button class="btn btn-primary btn-icon-split" type="button" onclick="$('#status').val('PROCESO');$('#reclamoForm').submit();">
							<span class="icon text-white-50">
								<i class="fa fa-check"></i>
							</span>
							<span class="text">Actualizar Reclamo</span>
						</button>
						</div>
						<div class="col-md-6 text-right">
							<a class="btn btn-success btn-icon-split" type="button" href="{{route('pdfReclamo',$reclamo->id)}}">
								<span class="icon text-white-50">
									<i class="fa fa-times"></i>
								</span>
								<span class="text">Descargar PDF Reclamo</span>
							</a>
						</div>
						<div class="col-md-6 text-right">
							<button class="btn btn-danger btn-icon-split" type="button" onclick="$('#status').val('CERRADO');$('#reclamoForm').submit();">
								<span class="icon text-white-50">
									<i class="fa fa-times"></i>
								</span>
								<span class="text">Cerrar Reclamo</span>
							</button>
						</div>
					</div>
				@endif
				@if ($reclamo->status == 'APROBAR')
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-primary btn-icon-split" type="button" onclick="$('#status').val('APROBADO');$('#reclamoForm').submit();">
								<span class="icon text-white-50">
									<i class="fa fa-check"></i>
								</span>
								<span class="text">Aprobar Reclamo</span>
							</button>
						</div>
						<div class="col-md-6 text-right">
							<button class="btn btn-danger btn-icon-split" type="button" data-toggle="modal" data-target="#rechazarReclamoModal">
								<span class="icon text-white-50">
									<i class="fa fa-times"></i>
								</span>
								<span class="text">Rechazar Reclamo</span>
							</button>
						</div>
					</div>
				@endif
	        </div>
        </form>
    </div>
</div>
@if ($reclamo->status == 'APROBAR')
	@include('reclamos.components.rechazar-reclamo-modal')
@endif
@include('reclamos.components.notificar-reclamo-modal')
<script type="text/javascript">
	@if(session('status'))
		Swal.fire(
			'{{ session("status") }}',
			'',
			'success'
		)
	@endif
	function fnAddMoreDocumentos() {
		number= Math.round(Math.random()*(9999999999-1)+parseInt(1));
        clone = $("#documento_").clone().removeClass("hide");
        clone.attr("id", "documento_"+number).removeClass("hide");
        //clone.find('.res_sanitaria_importacion_')
		clone.find('.documento_reclamo').attr('name','documento_reclamo[]');
        clone.find('.btn-delete-documento').attr("onclick","$('#documento_"+number+"').remove()");        
        //clone.find('.idInvo').attr('name','idInvo[]').val('');
        $('.documentos-div').append(clone.show());
	}
	function fnAddMoreImagenes() {
		number= Math.round(Math.random()*(9999999999-1)+parseInt(1));
        clone = $("#imagen_").clone().removeClass("hide");
        clone.attr("id", "imagen_"+number).removeClass("hide");
        //clone.find('.res_sanitaria_importacion_')
		clone.find('.imagen_reclamo').attr('name','imagen_reclamo[]');
        clone.find('.btn-delete-imagen').attr("onclick","$('#imagen_"+number+"').remove()");        
        //clone.find('.idInvo').attr('name','idInvo[]').val('');
        $('.imagenes-div').append(clone.show());
	}
	function fnAddMoreProblemaTienda() {
		number= Math.round(Math.random()*(9999999999-1)+parseInt(1));
        clone = $("#tr_").clone().removeClass("d-none");
        clone.attr("id", "tr_"+number).removeClass("d-none");
        //clone.find('.res_sanitaria_importacion_')
		clone.find('.imagen_reclamo').attr('name','imagen_reclamo[]');
		clone.find('.usuario_problema_tienda').attr('name','usuario_problema_tienda[]');
		clone.find('.id_tienda_problema_tienda').attr('name','id_tienda_problema_tienda[]');
		clone.find('.resultado_problema_tienda').attr('name','resultado_problema_tienda[]');
		clone.find('.lote_problema_tienda').attr('name','lote_problema_tienda[]');
		clone.find('.fecha_elab_problema_tienda').attr('name','fecha_elab_problema_tienda[]');
		clone.find('.fecha_venc_problema_tienda').attr('name','fecha_venc_problema_tienda[]');
		clone.find('.cantidad_problema_tienda').attr('name','cantidad_problema_tienda[]');
		clone.find('.unidad_cantidad_problema_tienda').attr('name','unidad_cantidad_problema_tienda[]');
		clone.find('.retiro_problema_tienda').attr('name','retiro_problema_tienda[]');
        clone.find('.btn-delete-problema-tienda').attr("onclick","$('#tr_"+number+"').remove()");        
        //clone.find('.idInvo').attr('name','idInvo[]').val('');
        $('.tiendasProblemaTBody').append(clone.show());
	}	
</script>