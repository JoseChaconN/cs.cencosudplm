<x-layout>
	<x-slot name="breadcrumb">
		Mes sin Rechazo
	</x-slot>
	<div class="col-lg-12">
		<div class="card shadow ">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Mes sin Rechazo LOCAL: {{session('u_codigo_tienda').' - '.session('u_nombre_tienda')}}</h6>
	        </div>
	        <form method="POST" action="{{route('guardarMesSinRechazo') }}">
	        	@csrf
	        	<div class="card-body border-left-primary">
		        	<div class="row">
		        		<div class="col-md-12">
				        	<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" {{ ($mes_sin_rechazo->respuesta == 1) ? 'checked' : '';}} id="inlineCheckbox1" name="respuesta" value="1">
								<label class="form-check-label" for="inlineCheckbox1"><strong>Declaro no haber tenido Rechazos registrados en mi local <span class="">{{session('u_codigo_tienda').' - '.session('u_nombre_tienda')}}</span> en el mes {{date('m/Y')}}</strong></label>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
		        	<button class="btn btn-primary btn-icon-split" type="submit">
	                    <span class="icon text-white-50">
	                        <i class="fa fa-check"></i>
	                    </span>
	                    <span class="text">Guardar Respuesta</span>
	                </button>
		        </div>	
	        </form>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseRechazos').addClass('show');
		});
	</script>
</x-layout>