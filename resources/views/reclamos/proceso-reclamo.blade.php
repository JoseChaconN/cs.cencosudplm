<x-layout>
	<x-slot name="breadcrumb">
		Reclamo en Proceso
	</x-slot>
	@if(($reclamo->categoria == 'JUMBO' || $reclamo->categoria == 'SISA' || $reclamo->categoria == 'MP') && $reclamo->sac != 1 )
		@include('reclamos.templates.proceso-general-form')
	@elseif($reclamo->categoria == 'LOGISTICA' && $reclamo->sac != 1)
		@include('reclamos.templates.proceso-general-form')
		@php /* @include('reclamos.templates.proceso-logistica-form')	*/@endphp
	@elseif($reclamo->sac == 1)
	@php /*@include('reclamos.templates.proceso-sac-form')*/ @endphp
	@endif
	<script>
		jQuery(document).ready(function(){
			$('#collapseReclamos').addClass('show');
		});
	</script>
</x-layout>