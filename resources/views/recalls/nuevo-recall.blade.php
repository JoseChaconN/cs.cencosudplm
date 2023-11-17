<x-layout>
	<x-slot name="breadcrumb">
		Recall Nuevo
	</x-slot>
	<div class="col-lg-12">
	<div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario Recall Nuevo</h6>
        </div>
        <form method="POST" action="{{ route('guardarRecallNuevo') }}" enctype="multipart/form-data">
        	@csrf
        	<input type="hidden" name="id_proveedor" value="{{$producto->id_proveedor}}">
        	<input type="hidden" name="nombre_proveedor" value="{{$proveedor->nombre}}">
        	<input type="hidden" name="rut_proveedor" value="{{$proveedor->rut}}">
        	<input type="hidden" name="id_seccion" value="{{$producto->id_seccion}}">
        	<input type="hidden" name="seccion" value="{{$seccion->nombre}}">
        	<input type="hidden" name="id_responsable" value="{{session('usuario_id')}}">
        	<input type="hidden" name="id_local" value="{{session('usuario_id_local')}}">
        	<div class="card-body border-left-primary">
        		<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Información del proveedor</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{$producto->proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Rut del proveedor:</label> {{$producto->rut_proveedor}}
	        		</div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Tipo de recall:</label>
							<div class="col-sm-8">
								<select name="recall" id="recall" class="form-control">
							        <option value="">Seleccione</option>
							        <option value="Calidad">Calidad 24hrs.</option>
							        <option value="Legalidad">Legalidad 24hrs.</option>
							        <option value="Inocuidad">Inocuidad 12hrs.</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
	        				<label class="col-sm-4 col-form-label font-weight-bold">Fecha de recall:</label>
	        				<div class="col-sm-8">{{date('d-m-Y')}}</div>
	        			</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Motivo de recall:</label>
							<div class="col-sm-8">
								<select name="motivo" id="motivo" class="form-control">
							        <option value="">Seleccione</option>
									<option value="cliente">Por reclamo de cliente.</option>
									<option value="sanitaria">Notificación de autoridad sanitaria.</option>
									<option value="interno">Reclamo interno.</option>
									<option value="proveedor">Solicitud de proveedor.</option>
									<option value="simulacro">Simulacro</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Descripción del problema:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="problema" id="problema" rows="5" placeholder="Descripción del problema"></textarea>
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
								<input type="text" name="accion" id="accion" class="form-control">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">¿Locales ingresan lotes?:</label>
							<div class="col-sm-8">
								<select name="locales_lotes" id="locales_lotes" class="form-control">
							        <option value="">Seleccione</option>
									<option value="1">Sí</option>
									<option value="0">No</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">El Recall, en que tiendas se realizará:</label>
							<div class="col-sm-8">
								<select name="cadena" id="cadena" class="form-control">
									<option value="">Seleccione</option>
									<option value="JUMBO">Jumbo</option>
									<option value="SISA">SISA</option>
									<option value="AMBAS">Jumbo y Sisa</option>
									<option value="NINGUNA">Ninguna</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 1:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input" name="imagen_recall[]">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 2:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input" name="imagen_recall[]">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 3:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input" name="imagen_recall[]">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 4:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input" name="imagen_recall[]">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	                <div class="col-md-12 ">
						<div class="form-group row">
		                	<label class="col-sm-4 col-form-label font-weight-bold">Imagen 5:</label>
		                	<div class="col-sm-8 custom-file">
							  <input type="file" class="custom-file-input" name="imagen_recall[]">
							  <label class="custom-file-label" >Subir Imagen</label>
							</div>
						</div>
	                </div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Productos asociados al proveedor: {{$producto->proveedor}}</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="table-responsive">
		                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
		                        <thead>
		                            <tr>
		                            	<th>Marcar</th>
		                                <th>Producto</th>
		                                <th>EAN</th>
		                                <th>SAP</th>
		                                <th>Marca</th>
		                                <th>Lote</th>
		                                <th>Fecha elaboración</th>
		                                <th>Fecha vencimiento</th>
		                            </tr>
		                        </thead>                       
		                        <tbody>
		                        	@foreach($productos as $producto)
			                        	<tr id="tr_prod_{{$producto->id}}" class="{{($producto->id == $id) ? 'table-success' : ''}}">
			                        		<td data-order="{{($producto->id == $id) ? 0 : 1}}"><input class="check-prod" type="checkbox" {{($producto->id == $id) ? 'checked' : ''}} name="producto[{{$producto->id}}]" value="{{$producto->id}}"></td>
			                                <td>{{$producto->nombre}}</td>
			                                <td>{{$producto->ean}}</td>
			                                <td>{{$producto->sap}}</td>
			                                <td>{{$producto->marca}}</td>
			                                <td><input type="text" placeholder="Lote" name="lote[{{$producto->id}}]"></td>
			                                <td><input type="text" placeholder="Fecha elaboración" name="fecha[{{$producto->id}}]"></td>
			                                <td><input type="text" placeholder="Fecha vencimiento" name="fecha_vencimiento[{{$producto->id}}]"></td>
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
                    <span class="text">Ingresar Recall</span>
                </button>
	        </div>	       
        </form>
    </div>
    <script type="text/javascript">
    	$(".check-prod").change(function() {
	        if (this.checked && this.value > 0) {
	            $('#tr_prod_'+this.value).addClass("table-success");
	        } else {
	            $('#tr_prod_'+this.value).removeClass("table-success");
	        }
	    });
    </script>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRecall').addClass('show');
		});
	</script>
</x-layout>