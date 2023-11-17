<x-layout>
	<x-slot name="breadcrumb">
		Reclamo Cerrado
	</x-slot>
	@if(($reclamo->categoria == 'JUMBO' || $reclamo->categoria == 'SISA' || $reclamo->categoria == 'MP') && $reclamo->sac != 1 )
		@include('reclamos.templates.cerrado-general-form')
	@elseif($reclamo->categoria == 'LOGISTICA' && $reclamo->sac != 1)
	@php /*@include('reclamos.templates.cerrado-logistica-form')*/@endphp
		@include('reclamos.templates.cerrado-general-form')
	@elseif($reclamo->sac == 1)
		@php /*@include('reclamos.templates.cerrado-sac-form')*/@endphp
		@include('reclamos.templates.cerrado-general-form')
	@endif
	<script>
		jQuery(document).ready(function(){
			$('#collapseReclamos').addClass('show');
		});
	</script>
</x-layout>