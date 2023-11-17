<div class="col-lg-12">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-{{ $color_form }}">Formulario Reclamo Nuevo </h6>
        </div>
        <form method="POST" action="{{ route('guardarReclamoNuevo') }}" enctype="multipart/form-data">
        	@csrf        
	        <div class="card-body border-left-{{ $color_form }}">
	        	<input type="hidden" name="producto_mp" value="{{$producto->mp}}">
	        	<input type="hidden" name="id_producto" value="{{$producto->id}}">
	        	<input type="hidden" name="nombre_producto" value="{{$producto->nombre}}">
	        	<input type="hidden" name="ean_producto" value="{{$producto->ean}}">
	        	<input type="hidden" name="sap_producto" value="{{$producto->sap}}">
	        	<input type="hidden" name="marca_producto" value="{{$producto->marca}}">
	        	<input type="hidden" name="id_seccion" value="{{$producto->id_seccion}}">
	        	<input type="hidden" name="id_proveedor" value="{{$producto->id_proveedor}}">
	        	<input type="hidden" name="nombre_proveedor" value="{{$proveedor->nombre}}">
	        	<input type="hidden" name="rut_proveedor" value="{{$proveedor->rut}}">
	        	<input type="hidden" name="categoria" value="{{$categoria}}">
	        	<input type="hidden" name="id_frigorifico" value="{{(!empty($request['id_frigorifico'])) ? $request['id_frigorifico'] : ''}}">
	        	<input type="hidden" name="razon_social" value="{{(!empty($request['razon_social_frigorifico'])) ? $request['razon_social_frigorifico'] : ''}}">
	        	<input type="hidden" name="marca_frigorifico" value="{{(!empty($request['marca_frigorifico'])) ? $request['marca_frigorifico'] : ''}}">
	        	<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Información del producto</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Nombre del producto:</label> {{$producto->nombre}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">EAN 13:</label> {{$producto->ean}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Código SAP:</label> {{$producto->sap}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Marca del producto:</label> {{(!empty($request['marca_frigorifico'])) ? $request['marca_frigorifico'] : $producto->marca}}
	        		</div>
	        		@if(!empty($request['id_frigorifico']))
	        			<div class="col-md-12">
		        			<label class="font-weight-bold">Frigorifico:</label> {{$request['nombre_frigorifico']}}
		        		</div>
		        		<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">SIF/Planta:</label>
								<div class="col-sm-8">
									<select name="sif" class="form-control">
										<option value="">Seleccione</option>
								        @php $sif_array = (!empty($request['sif_frigorifico'])) ? explode(',',$request['sif_frigorifico']) : [] @endphp
								        @foreach($sif_array as $key => $val )
								        	<option value="{{$val}}">{{$val}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
	        		@endif
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{(!empty($request['nombre_razon_social_frigorifico'])) ? $request['nombre_razon_social_frigorifico'] : $producto->proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Rut del proveedor:</label> {{(!empty($request['rut_razon_social_frigorifico'])) ? $request['rut_razon_social_frigorifico'] : $producto->rut_proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Producto importado:</label> {{$request['es_importado']}}
	        			<input type="hidden" name="es_importado" value="{{$request['es_importado']}}">
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Cliente es:</label> {{$request['interno_externo']}}
	        			<input type="hidden" name="interno_externo" value="{{$request['interno_externo']}}">
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Tipo de despacho:</label> {{$request['despacho']}}
	        			<input type="hidden" name="despacho" value="{{$request['despacho']}}">
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">El cliente solicita respuesta a su reclamo:</label> {{$request['formal_informal']}}
	        			<input type="hidden" name="formal_informal" value="{{$request['formal_informal']}}">
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Área del reclamo:</label> <span class="text-{{$color_form }}">{{$categoria_text}}</span>
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
	        			<label class="font-weight-bold">Local:</label> {{session('u_codigo_tienda').' - '.session('u_nombre_tienda')}}	        			
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Sección:</label> {{$seccion->nombre}}
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Fecha de generación del reclamo en el local:</label>
							<div class="col-sm-8">
								<input type="date" name="fecha_local" class="form-control">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Formato del producto:</label>
							<div class="col-sm-8">
								<input type="text" name="formato" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Cantidad total con problemas en el local:</label>
								<div class="col-sm-8">
								<input type="text" name="cantidad_problema" class="form-control inputDecimal">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Unidad Cantidad total con problemas en el local:</label>
							<div class="col-sm-8">
								<select name="unidad_cantidad_problema" class="form-control">
							        <option value="">Seleccione</option>
									<option value="unidad">Unidad/es</option>
							        <option value="caja">Caja/s</option>
							        <option value="Kg">Kg</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Comentario Cantidad total con problemas en el local:</label>
							<div class="col-sm-8">
								<input type="text" name="comentario_cantidad_problema" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Lote:</label>
							<div class="col-sm-8">
								<input type="text" name="lote" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Elaboración:</label>
							<div class="col-sm-8">
								<input type="text" name="elaboracion" class="form-control">
								<small class="form-text text-muted">En caso de que no aplique, escribir N/A.</small>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Vencimiento:</label>
							<div class="col-sm-8">
								<input type="text" name="vencimiento" class="form-control">
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
								<select name="aplica_temperatura" id="aplica_temperatura" class="form-control">
							        <option value="">Seleccione</option>
							        <option value="sí">Sí</option>
							        <option value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="aplicaTemperaturaDiv" style="display: none;">
						<div class="col-md-12">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Registro de temperaturas</h6>
							<small class="form-text text-muted">En caso que aplique al reclamo.</small>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Recepción:</label>
								<div class="col-sm-8">
									<input type="date" name="recepcion" class="form-control">
								</div>
							</div>
		        		</div>
		        		<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Cámaras refrigeradas:</label>
								<div class="col-sm-8">
									<input type="text" name="camaras" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Vitrinas/Góndolas:</label>
								<div class="col-sm-8">
									<input type="text" name="vitrina" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Aplica Carnes y Fab. de Cecinas:</label>
							<div class="col-sm-8">
								<select name="aplica_carnes" id="aplica_carnes" class="form-control">
							        <option value="">Seleccione</option>
							        <option value="sí">Sí</option>
							        <option value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="aplicaCarneDiv" style="display:none;">
						<div class="col-md-12">
							<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Exclusivo Carnes y Fab. de Cecinas</h6>
							<small class="form-text text-muted">En caso que aplique al reclamo.</small>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre frigorifico y nacionalidad:</label>
								<div class="col-sm-8">
									<input type="text" name="frigorifico" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Fecha faena:</label>
								<div class="col-sm-8">
									<input type="date" name="fecha_faena" class="form-control">
								</div>
							</div>
		        		</div>
		        		<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Cantidad recibida:</label>
								<div class="col-sm-8">
									<input type="text" name="cantidad_recibida" class="form-control">
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
								<textarea class="form-control" style="resize: none;" name="descripcion_reclamo" id="validationTextarea" rows="5" placeholder=""></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Observaciones del cliente:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="observaciones_cliente" id="validationTextarea" rows="5" placeholder=""></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo del reclamo:</label>
							<div class="col-sm-8">
								<select class="form-control" name="motivo_reclamo">
							        <option value="">Seleccione</option>
									<option value="Producto en mal estado (mal olor, color atípico, ácido)">Producto en mal estado (mal olor, color atípico, ácido)</option>
									<option value="Contaminación Física (partículas extrañas)">Contaminación Física (partículas extrañas)</option>
									<option value="Desarrollo Fúngico (hongos)">Desarrollo Fúngico (hongos)</option>
									<option value="Otros (consistencia atípica, acuoso, ácido)">Otros (consistencia atípica, acuoso, ácido)</option>
									<option value="Vencimiento y/o rotulación">Vencimiento y/o rotulación</option>
									<option value="Sellado deficiente">Sellado deficiente</option>
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
									<option value="Calidad">Calidad / Leve - 5 Días</option>
									<option value="Legalidad">Legalidad / Medio - 24hrs</option>
									<option value="Inocuidad">Inocuidad / Alto - Inmediato</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Responsable:</label>
							<div class="col-sm-8">
								<span>{{session('u_nombre').' '.session('u_apellido')}} - {{session('u_email')}}</span>
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
								<select class="form-control" name="origen_venta" id="origen_venta">
									<option value="">Seleccione</option>
									<option value="Presencial">Presencial</option>
									<option value="Web">Web</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="tiendaPresencialDiv">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tienda presencial:</label>
							<div class="col-sm-8">
								<select class="form-control" name="origen_venta_tienda">
									<option value="">Seleccione</option>
							        @foreach($tiendas as $tienda)
							        	<option value="{{$tienda->id}}">{{$tienda->codigo.' - '.$tienda->nombre}}</option>
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
							        	<option value="{{$origen->id}}">{{$origen->nombre}}</option>
							        @endforeach
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">¿Existe información sobre el cliente?</label>
							<div class="col-sm-8">
								<select class="form-control" name="aplica_cliente" id="aplica_cliente">
							        <option value="">Seleccione</option>
							        <option value="sí">Sí</option>
							        <option value="no">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="datosClienteDiv">
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre del cliente:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nombre_cliente">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Télefono:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="telefono_cliente">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Dirección:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="direccion_cliente">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Rut:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control inputRut" name="rut_cliente">
								</div>
							</div>
						</div>
					</div>					
					<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12 mb-4">
		        		<h6 class="m-0 font-weight-bold text-{{ $color_form }}">Documentos e imágenes del reclamo.</h6>
		        		<small class="form-text text-muted">Usted podrá subir máximo 6 documentos y 6 imágenes.</small>
		        	</div>
	        		<div class="col-md-6 ">
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
		                <div class="documentos-div"></div>
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
		                <div class="imagenes-div"></div>
	        		</div>
	        	</div>
	        </div>
	        <div class="card-footer text-right">
	        	<button class="btn btn-primary btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fa fa-check"></i>
                    </span>
                    <span class="text">Ingresar Reclamo</span>
                </button>
	        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#tiendaPresencialDiv').hide();
		$('#datosClienteDiv').hide();
	});
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
	$('#origen_venta').change(function (e) { 
		$('#tiendaPresencialDiv').hide();
		if(this.value == 'Presencial'){
			$('#tiendaPresencialDiv').show();
		}else{
			$('#tiendaPresencialDiv').hide();
		}
	});
	$('#aplica_cliente').change(function (e) { 
		$('#datosClienteDiv').hide();
		if(this.value == 'sí'){
			$('#datosClienteDiv').show();
		}else{
			$('#datosClienteDiv').hide();
		}
	});
	$('#aplica_temperatura').change(function (e) { 
		$('#aplicaTemperaturaDiv').hide();
		if(this.value == 'sí'){
			$('#aplicaTemperaturaDiv').show();
		}else{
			$('#aplicaTemperaturaDiv').hide();
		}
	});
	$('#aplica_carnes').change(function (e) { 
		$('#aplicaCarneDiv').hide();
		if(this.value == 'sí'){
			$('#aplicaCarneDiv').show();
		}else{
			$('#aplicaCarneDiv').hide();
		}
	});
</script>