<x-layout>
	<x-slot name="breadcrumb">
		Tienda
	</x-slot>
	<div class="col-lg-12">
		<div class="card shadow ">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Tienda</h6>
	        </div>
	        <form method="POST" action="{{ (!empty($tienda->id)) ? route('guardarEditTienda',$tienda->id) : route('guardarNuevaTienda') }}">
	        	@csrf
	        	@if(!empty($tienda->id))
	        		@method('PATCH')
	        	@endif
	        	<div class="card-body border-left-primary">
	        		<div class="row">
	        			<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre:</label>
								<div class="col-sm-8">
									<input type="text" name="nombre" class="form-control" value="{{ old('nombre' , $tienda->nombre)}}" placeholder="Nombre">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Código:</label>
								<div class="col-sm-8">
									<input type="text" name="codigo" class="form-control" value="{{ old('codigo' , $tienda->codigo)}}" placeholder="Código">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Dirección:</label>
								<div class="col-sm-8">
									<input type="text" name="direccion" class="form-control" value="{{ old('direccion' , $tienda->direccion)}}" placeholder="Dirección">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Teléfono:</label>
								<div class="col-sm-8">
									<input type="text" name="telefono" class="form-control" value="{{ old('telefono' , $tienda->telefono)}}" placeholder="Teléfono">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Área Tienda:</label>
								<div class="col-sm-8">
									<select name="area" class="form-control">
										<option value="">Seleccione un Área</option>
									    <option {{ (old('area' , $tienda->area) == 'JUMBO') ? 'selected' : ''}} value="JUMBO">Jumbo</option>
									    <option {{ (old('area' , $tienda->area) == 'SISA') ? 'selected' : ''}} value="SISA">SISA</option>
										<option {{ (old('area' , $tienda->area) == 'SPID') ? 'selected' : ''}} value="SPID">SPID</option>
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Tipo:</label>
								<div class="col-sm-8">
									<select name="tipo" class="form-control">
										<option value="">Seleccione un Tipo</option>
									    <option {{ (old('tipo' , $tienda->tipo) == 'TIENDA') ? 'selected' : ''}} value="TIENDA">Tienda</option>
									    <option {{ (old('tipo' , $tienda->tipo) == 'BODEGAS') ? 'selected' : ''}} value="BODEGAS">BODEGAS</option>
								    </select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Zona:</label>
								<div class="col-sm-8">
									<select name="zona" class="selectpicker" multiple data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($zonas_tienda as $index => $value)
								        	<option class="zona_tienda zonas_{{$value['area']}}" {{ (old('zona' , $tienda->zona) == $value['val']) ? 'selected' : ''}} value="{{$value['val']}}">{{$value['text']}}</option>
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