<x-layout>
	<x-slot name="breadcrumb">
		Seccion
	</x-slot>
	<div class="col-lg-12">
		<div class="card shadow ">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Seccion</h6>
	        </div>
	        <form method="POST" action="{{ (!empty($seccion->id)) ? route('guardarEditSeccion',$seccion->id) : route('guardarNuevaSeccion') }}">
	        	@csrf
	        	@if(!empty($seccion->id))
	        		@method('PATCH')
	        	@endif
	        	<div class="card-body border-left-primary">
	        		<div class="row">
	        			<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Nombre:</label>
								<div class="col-sm-8">
									<input type="text" name="nombre" class="form-control" value="{{ old('nombre' , $seccion->nombre)}}" placeholder="Nombre">
								</div>
							</div>
						</div>
						<div class="col-md-12">
		        			<div class="form-group row">
								<label class="col-sm-4 col-form-label font-weight-bold">Código:</label>
								<div class="col-sm-8">
									<input type="text" name="codigo" class="form-control" value="{{ old('codigo' , $seccion->codigo)}}" placeholder="Código">
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