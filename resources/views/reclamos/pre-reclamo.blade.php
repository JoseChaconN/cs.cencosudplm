<x-layout>

	<x-slot name="breadcrumb">
		Reclamo Nuevo
	</x-slot>

<div class="row">
	<div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buscar Producto</h6>
            </div>
            <div class="card-body">
               	<form method="POST" action="{{ route('preReclamo')}}">
               		@csrf
               		<div class="row">
               			<div class="col-md-4">
							<div class="form-group">
								<label for="nombreProd">Nombre producto:</label>
								<input type="text" class="form-control" id="nombreProd" name="nombreProd" placeholder="Nombre producto" value="{{ empty($request['nombreProd']) ? '' : $request['nombreProd'] }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="eanProd">Código EAN:</label>
								<input type="text" class="form-control" id="eanProd" name="eanProd" placeholder="Código EAN" value="{{ empty($request['eanProd']) ? '' : $request['eanProd'] }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="sapProd">Código SAP:</label>
								<input type="text" class="form-control" id="sapProd" name="sapProd" placeholder="Código SAP" value="{{ empty($request['sapProd']) ? '' : $request['sapProd'] }}">
							</div>
						</div>
					</div>
				  	<button class="btn btn-primary btn-icon-split" type="submit">
	                    <span class="icon text-white-50">
	                        <i class="fas fa-search"></i>
	                    </span>
	                    <span class="text">Buscar Producto</span>
	                </button>
               	</form>
            </div>
        </div>
    </div>
    @if(!empty($productos))
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Productos Encontrados</h6>
	            </div>
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                            	<th>Pais</th>
	                                <th>Tipo Producto</th>
	                                <th>Nombre</th>
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
	                        			<td>{{$producto->nombre_pais}}</td>
		                                <td>{{$producto->mp == 1 ? 'Marcas Propias' : 'Supermercado'}}</td>
		                                <td>{{$producto->nombre}}</td>
		                                <td>{{$producto->ean}}</td>
		                                <td>{{$producto->sap}}</td>
		                                <td>{{(empty($producto->frigorifico_switch)) ? $producto->proveedor : 'El Proveedor sera definido en la siguiente etapa'}}</td>
		                                <td>{{$producto->marca}}</td>
		                                <td>
		                                	<button type="button" class="btn btn-primary btn-circle btn-sm" onclick="fnSelectProducto({{$producto->id}},'{{$producto->nombre}}',{{$producto->frigorifico_switch}})">
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


	    <!-- Modal -->
		<div class="modal fade" id="preReclamoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="{{ route('crearReclamo')}}">
						<div class="modal-body">
		               		@csrf
		               		<input type="hidden" name="id_producto" id="id_producto" value="">
		               		<div class="row">
		               			<div class="col-md-12">
									<div class="form-group">
										<label>¿Producto es importado por Cencosud?:</label>
										<select name="es_importado" class="form-control" id="es_importado">
											<option value="">Seleccione</option>
											<option value="Sí">Sí</option>
											<option value="no">No</option>											
										</select>
										@error('es_importado')
											<small class="form-text text-danger">{{$message}}</small>
										@enderror
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>¿El cliente solicita respuesta a su reclamo?:</label>
										<select class="form-control" name="formal_informal" id="formal_informal">
											<option value="">Seleccione</option>
											<option value="Sí (Formal)">Sí (Formal)</option>
											<option value="No (Informal)">No (Informal)</option>
										</select>
										@error('formal_informal')
											<small class="form-text text-danger">{{$message}}</small>
										@enderror
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>¿El cliente es Interno o Externo?:</label>
										<select class="form-control" name="interno_externo" id="interno_externo">
											<option value="">Seleccione</option>
											<option value="Interno">Interno</option>
											<option value="Externo">Externo</option>
										</select>
										@error('interno_externo')
											<small class="form-text text-danger">{{$message}}</small>
										@enderror
									</div>
								</div>
								<div class="col-md-12 despacho">
									<div class="form-group">
										<label>Tipo de despacho:</label>
										<select class="form-control" name="despacho" id="despacho">
											<option value="">Seleccione</option>
											<option value="Directo">Directo</option>
											<option value="Centralizado">Centralizado</option>
										</select>
										@error('despacho')
											<small class="form-text text-danger">{{$message}}</small>
										@enderror
									</div>
								</div>
								<div class="col-md-12 numero_entrega">
									<div class="form-group">
										<label>Si seleccionó Centralizado favor de indicar el Número de entrega:</label>
										<input type="text" class="form-control" id="numero_entrega" name="numero_entrega" placeholder="Número de entrega" value="">
									</div>
								</div>
									<div class="col-md-12 d-none frigorificos_div">
										<div class="form-group">
											<label>Frigorificos:</label>
											<select class="form-control" name="id_frigorifico" id="id_frigorifico">
											</select>
											<input type="hidden" name="nombre_frigorifico" id="nombre_frigorifico" value="">
										</div>
									</div>
									<div class="col-md-12 d-none frigorificos_div">
										<div class="form-group">
											<label>Razón Social:</label>
											<select class="form-control" name="razon_social_frigorifico" id="razon_social_frigorifico">
											</select>
											<input type="hidden" name="nombre_razon_social_frigorifico" id="nombre_razon_social_frigorifico" value="">
											<input type="hidden" name="rut_razon_social_frigorifico" id="rut_razon_social_frigorifico" value="">
											<input type="hidden" name="sif_frigorifico" id="sif_frigorifico" value="">
										</div>
									</div>
									<div class="col-md-12 d-none frigorificos_div">
										<div class="form-group">
											<label>Marcas:</label>
											<select class="form-control" name="marca_frigorifico" id="marca_frigorifico">
											</select>
										</div>
									</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Iniciar Reclamo</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function fnSelectProducto(id,nombre,frigorifico_switch) {
				$('#es_importado').val('').trigger('change');
				$('#formal_informal').val('').trigger('change');
				$('#interno_externo').val('').trigger('change');
				$('#despacho').val('').trigger('change');
				$('#numero_entrega').val('').trigger('change');
				$('#exampleModalTitle').html('Reclamo - '+nombre)
				$('#id_producto').val(id);
				$('#preReclamoModal').modal('show');

				if(frigorifico_switch > 0){
					$('.frigorificos_div').removeClass('d-none');
					$.post('{{route("listaJsonFrigorificos")}}',{_token: $('input[name=_token]').val(),code_pais:frigorifico_switch},function(data){
						$('#id_frigorifico').html('<option value="">Seleccione</option>');
						$('#razon_social_frigorifico').html('<option value="">Seleccione</option>');
						$('#marca_frigorifico').html('<option value="">Seleccione</option>');
						$.each(data.frigorificos,function(index,value){
							$('#id_frigorifico').append('<option value="'+value.id+'" data-nombre="'+value.nombre+'">'+value.nombre+'</option>');

							$.each(value.razones_sociales,function(i,v){
								//$('#id_frigorifico').append('<option value="'+value.id+'">'+value.nombre+'</option>');
								$('#razon_social_frigorifico').append('<option data-rut="'+v.rut+'" data-sif="'+v.sif+'" data-nombre="'+v.razon_social+'" data-group="frig_'+value.id+'" value="'+v.id+'">'+v.rut+' '+v.razon_social+'</option>');
								$('#marca_frigorifico').append('<option data-group="razon_'+v.id+'" value="'+v.marca+'">'+v.marca+'</option>');
							});
							//$('#razon_social_frigorifico').append('<option value="'+value.id_razon_social+'">'+value.rut+' '+value.razon_social+'</option>');
							//$('#marca_frigorifico').append('<option value="'+value.marca+'">'+value.marca+'</option>');
						});
						
					}, 'json');
				}else{
					$('.frigorificos_div').addClass('d-none');
				}
			}
			$('#es_importado').change(function(){
				if($(this).val() == 'no' || $(this).val() == ''){
					$('.despacho').show();
					$('.numero_entrega').hide();
				}
				if($(this).val() == 'Sí'){
					$('.despacho').hide();
					$('.numero_entrega').show();
				}
			})
			$('#despacho').change(function(){
				if($(this).val() == 'Directo' || $(this).val() == ''){					
					$('.numero_entrega').hide();
				}
				if($(this).val() == 'Centralizado'){
					$('.numero_entrega').show();
				}				
			})

			$('#id_frigorifico').change(function(){
				//var selectedOption = $(this).find('option:selected'); // Obtener el <option> seleccionado
            	//var dataInfo = selectedOption.data('info');
				$('#nombre_frigorifico').val($(this).find('option:selected').data('nombre'))
				var selectedValue = $(this).val();
				$('#razon_social_frigorifico option').hide(); // Oculta todas las opciones en el select2            
				$('#marca_frigorifico option').hide(); // Oculta todas las opciones en el select2            
	            // Muestra solo las opciones con el data-group igual al valor seleccionado en select1
	            $('#razon_social_frigorifico option[data-group="frig_' + selectedValue + '"]').show();
	            
	            // Si deseas mostrar una opción predeterminada, puedes hacerlo así
	            $('#razon_social_frigorifico').val($('#razon_social_frigorifico option[data-group="frig_' + selectedValue + '"]:visible:first').val());
			})
			$('#razon_social_frigorifico').change(function(){
				$('#rut_razon_social_frigorifico').val($(this).find('option:selected').data('rut'))
				$('#nombre_razon_social_frigorifico').val($(this).find('option:selected').data('nombre'))
				$('#sif_frigorifico').val($(this).find('option:selected').data('sif'))
				var selectedValue = $(this).val();
				$('#marca_frigorifico option').hide(); // Oculta todas las opciones en el select2            
	            // Muestra solo las opciones con el data-group igual al valor seleccionado en select1
	            $('#marca_frigorifico option[data-group="razon_' + selectedValue + '"]').show();
	            
	            // Si deseas mostrar una opción predeterminada, puedes hacerlo así
	            $('#marca_frigorifico').val($('#marca_frigorifico option[data-group="razon_' + selectedValue + '"]:visible:first').val());		
			})
		</script>

    @endif
</div>
<script>
	jQuery(document).ready(function(){
		$('#collapseReclamos').addClass('show');
	});
</script>
</x-layout>