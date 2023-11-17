<x-layout>
	<x-slot name="breadcrumb">
		Recall en proceso
	</x-slot>
	<div class="col-lg-12">
	<div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recall en proceso</h6>
        </div>
        <form method="POST" action="{{ route('guardarRecallProceso',$recall->id) }}">
        	@csrf
        	@method('PATCH')
        	<input type="hidden" name="id_recall" value="{{$recall->id}}">
        	<div class="card-body border-left-primary">
        		<div class="row">
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Información del proveedor</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<label class="font-weight-bold">Proveedor:</label> {{$recall->nombre_proveedor}}
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
								<select name="recall" id="recall" class="form-control">
							        <option value="">Seleccione</option>
							        <option  {{ $recall->recall == 'Calidad' ? 'selected' : '' }} value="Calidad">Calidad 24hrs.</option>
							        <option  {{ $recall->recall == 'Legalidad' ? 'selected' : '' }} value="Legalidad">Legalidad 24hrs.</option>
							        <option  {{ $recall->recall == 'Inocuidad' ? 'selected' : '' }} value="Inocuidad">Inocuidad 12hrs.</option>
							    </select>
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
								<select name="motivo" id="motivo" class="form-control">
							        <option value="">Seleccione</option>
									<option {{ $recall->motivo == 'cliente' ? 'selected' : '' }} value="cliente">Por reclamo de cliente.</option>
									<option {{ $recall->motivo == 'sanitaria' ? 'selected' : '' }} value="sanitaria">Notificación de autoridad sanitaria.</option>
									<option {{ $recall->motivo == 'interno' ? 'selected' : '' }} value="interno">Reclamo interno.</option>
									<option {{ $recall->motivo == 'proveedor' ? 'selected' : '' }} value="proveedor">Solicitud de proveedor.</option>
									<option {{ $recall->motivo == 'simulacro' ? 'selected' : '' }} value="simulacro">Simulacro</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Descripción del problema:</label>
							<div class="col-sm-8">
								<textarea class="form-control" style="resize: none;" name="problema" id="problema" rows="5" placeholder="Descripción del problema">{{$recall->problema}}</textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
		        			<label class="col-sm-4 col-form-label font-weight-bold">Sección:</label> 
		        			<div class="col-sm-8">{{$recall->seccion}}</div>
		        		</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">Acción correctiva inmediata:</label>
							<div class="col-sm-8">
								<input type="text" name="accion" id="accion" class="form-control" value="{{$recall->accion}}">
							</div>
						</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="form-group row">
							<label class="col-sm-4 col-form-label font-weight-bold">¿Locales ingresan lotes?:</label>
							<div class="col-sm-8">
								<select name="locales_lotes" id="locales_lotes" class="form-control">
							        <option value="">Seleccione</option>
									<option {{ $recall->locales_lotes == '1' ? 'selected' : '' }} value="1">Sí</option>
									<option {{ $recall->locales_lotes == '0' ? 'selected' : '' }} value="0">No</option>
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
									<option {{ $recall->cadena == 'JUMBO' ? 'selected' : '' }} value="JUMBO">Jumbo</option>
									<option {{ $recall->cadena == 'SISA' ? 'selected' : '' }} value="SISA">SISA</option>
									<option {{ $recall->cadena == 'AMBAS' ? 'selected' : '' }} value="AMBAS">Jumbo y Sisa</option>
									<option {{ $recall->cadena == 'NINGUNA' ? 'selected' : '' }} value="NINGUNA">Ninguna</option>
							    </select>
							</div>
						</div>
					</div>
					<div class="col-md-12 ">
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
	                </div>
	        		<div class="col-md-12">
	        			<hr class="sidebar-divider">
	        		</div>
	        		<div class="col-md-12 mb-4">
	        			<h6 class="m-0 font-weight-bold text-primary">Productos asociados al proveedor: {{$recall->nombre_proveedor}}</h6>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="table-responsive">
		                    <table class="table table-bordered" width="100%" cellspacing="0">
		                        <thead>
		                            <tr>
		                                <th>Producto</th>
		                                <th>EAN</th>
		                                <th>SAP</th>
		                                <th>Marca</th>
		                                <th>Lote</th>
		                                <th>Fecha elaboración</th>
		                                <th>Fecha vencimiento</th>
		                                <th>Marcar</th>
		                            </tr>
		                        </thead>                       
		                        <tbody>
		                        	@foreach($productos as $producto)
			                        	<tr>
			                                <td>{{$producto->nombre}}</td>
			                                <td>{{$producto->ean}}</td>
			                                <td>{{$producto->sap}}</td>
			                                <td>{{$producto->marca}}</td>
			                                <td><input type="text" placeholder="Lote" name="lote[{{$producto->id}}]" value="{{$lote[$producto->id]}}"></td>
			                                <td><input type="text" placeholder="Fecha elaboración" name="fecha[{{$producto->id}}]" value="{{$fecha[$producto->id]}}"></td>
			                                <td><input type="text" placeholder="Fecha vencimiento" name="fecha_vencimiento[{{$producto->id}}]" value="{{$fecha_vencimiento[$producto->id]}}"></td>
			                                <td><input type="checkbox" checked name="producto[{{$producto->id}}]" value="{{$producto->id}}"></td>
			                            </tr>
		                        	@endforeach	
		                        </tbody>
		                    </table>
	                	</div>
	        		</div>
	        	</div>
	        </div>
	        <div class="card-footer text-right">
				<a class="btn btn-success btn-icon-split" type="button" href="{{route('pdfRecall',$recall->id)}}">
					<span class="icon text-white-50">
						<i class="fa fa-times"></i>
					</span>
					<span class="text">Descargar PDF Recall</span>
				</a>
	        	<button class="btn btn-primary btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fa fa-check"></i>
                    </span>
                    <span class="text">Actualizar Recall</span>
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