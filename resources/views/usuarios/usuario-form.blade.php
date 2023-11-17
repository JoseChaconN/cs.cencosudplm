<x-layout>
	<x-slot name="breadcrumb">
		Usuario
	</x-slot>
	<div class="col-lg-12">
		<div class="card shadow ">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Usuario</h6>
	        </div>
	        <form method="POST" action="{{ (!empty($usuario->id)) ? route('guardarEditUsuario',$usuario->id) : route('guardarNuevoUsuario') }}">
	        	@csrf
	        	@if(!empty($usuario->id))
	        		@method('PATCH')
	        	@endif
	        	<div class="card-body border-left-primary">
	        		<div class="row">
	        			<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombres:</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control" value="{{ old('name' , $usuario->name)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Apellidos:</label>
								<div class="col-sm-8">
									<input type="text" name="last_name" class="form-control" value="{{ old('last_name' , $usuario->last_name)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Email:</label>
								<div class="col-sm-8">
									<input type="text" name="email" class="form-control" value="{{ old('email' , $usuario->email)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Área Usuario:</label>
								<div class="col-sm-8">
									<select name="area" class="form-control">
										<option value="">Seleccione un Área</option>
									    <option {{ (old('area' , $usuario->area) == 'PROPIA') ? 'selected' : ''}} value="PROPIA">Marcas Propias</option>
									    <option {{ (old('area' , $usuario->area) == 'JUMBO') ? 'selected' : ''}} value="JUMBO">Jumbo</option>
									    <option {{ (old('area' , $usuario->area) == 'SISA') ? 'selected' : ''}} value="SISA">SISA</option>
									    <!--option {{ (old('area' , $usuario->area) == 'COMERCIAL') ? 'selected' : ''}} value="COMERCIAL">Comercial</option-->
									    <!--option {{ (old('area' , $usuario->area) == 'ATENTO') ? 'selected' : ''}} value="ATENTO">Servicio al cliente</option-->
									    <option {{ (old('area' , $usuario->area) == 'SAC') ? 'selected' : ''}} value="SAC">SAC Local</option>
									    <option {{ (old('area' , $usuario->area) == 'LOGISTICA') ? 'selected' : ''}} value="LOGISTICA">Logística</option>
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Tienda:</label>
								<div class="col-sm-8">
									<select name="tiendas[]" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($tiendas as $tienda)
								        	<option {{ in_array($tienda->id, old('tiendas', $tiendas_usuario)) ? 'selected' : '' }} value="{{$tienda->id}}">{{$tienda->codigo.' - '.$tienda->nombre}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Tienda Supervisor:</label>
								<div class="col-sm-8">
									<select name="tiendas_supervisor[]" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($tiendas as $tienda)
								        	<option {{ in_array($tienda->id, old('tiendas_supervisor', $tiendas_sup_usuario)) ? 'selected' : '' }} value="{{$tienda->id}}">{{$tienda->codigo.' - '.$tienda->nombre}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Centro de Competencia:</label>
								<div class="col-sm-8">
									<select name="cc[]" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($ccs as $cc)
								        	<option {{ in_array($cc->id, old('cc', $ccs_usuario)) ? 'selected' : '' }} value="{{$cc->id}}">{{$cc->nombre}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Cargo:</label>
								<div class="col-sm-8">
									<input type="text" name="cargo" class="form-control" value="{{ old('cargo' , $usuario->cargo)}}">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Roles para Usuarios:</label>
								<div class="col-sm-8">
									<div class="row">
										@foreach ($roles as $rol)
											<div class="col-md-4">
												<div class="form-group">
													<div class="custom-control custom-checkbox small">
														<input type="checkbox" class="custom-control-input" {{(in_array($rol->id,$roles_usuario)) ? 'checked' : ''}} value="{{$rol->id}}" name="rol_cs[]" id="rol_{{$rol->id}}">
														<label class="custom-control-label" for="rol_{{$rol->id}}">{{Str::ucfirst($rol->name)}}</label>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Secciones ACA:</label>
								<div class="col-sm-8">
									<select name="secciones_aca[]" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($secciones as $seccion)
								        	<option {{ in_array($seccion->id, old('secciones_aca', $secciones_usuario)) ? 'selected' : '' }} value="{{$seccion->id}}">{{$seccion->nombre}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
	        		</div>
	        	</div>
	        	<div class="card-footer text-right">
		        	<button class="btn btn-primary btn-icon-split" type="submit">
	                    <span class="icon text-white-50">
	                        <i class="fa fa-check"></i>
	                    </span>
	                    <span class="text">Guardar</span>
	                </button>
		        </div>
	        </form>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseAdministracion').addClass('show');
		});
	</script>
</x-layout>