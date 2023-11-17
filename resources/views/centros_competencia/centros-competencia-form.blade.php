<x-layout>
	<x-slot name="breadcrumb">
		Centro de Competencia
	</x-slot>
	<div class="col-lg-12">
		<div class="card shadow ">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Centro de Competencia</h6>
	        </div>
	        <form method="POST" action="{{ (!empty($centro_competencia->id)) ? route('guardarEditCentroCompetencia',$centro_competencia->id) : route('guardarNuevoCentroCompetencia') }}">
	        	@csrf
	        	@if(!empty($centro_competencia->id))
	        		@method('PATCH')
	        	@endif
				<input type="hidden" name="id_cc" value="{{(!empty($centro_competencia->id)) ? $centro_competencia->id : 0}}">
	        	<div class="card-body border-left-primary">
	        		<div class="row">
	        			<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre:</label>
								<div class="col-sm-8">
									<input type="text" name="nombre" class="form-control" value="{{ old('nombre' , $centro_competencia->nombre)}}" placeholder="Nombre">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Secciones Asociadas:</label>
								<div class="col-sm-8">
									<select name="secciones[]" id="secciones[]" multiple class="selectpicker" data-live-search="true" data-width="100%" title="Seleccione">
								        @foreach($secciones as $seccion)
								        	<option {{ in_array($seccion->codigo, old('secciones', $secciones_cc)) ? 'selected' : '' }} value="{{$seccion->codigo}}">{{$seccion->nombre}}</option>
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