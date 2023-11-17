<x-layout>
	<x-slot name="breadcrumb">
		Reclamo Nuevo
	</x-slot>
	<!--
		#Si producto es MP siempre mostrar form MP (General)
		#Si producto no es MP pero es Importado o Despacho: Centralizado MOSTRAR form logistica
		#Si producto no es MP y No es Importado y Despacho: Directo Mostrar From General
		#Si Usuario es SAC Mostrart From SAC NUEVO

		es_importado
		formal_informal
		interno_externo
		despacho
	-->

	@if($producto->mp == 1 && session('u_sac') != 1)
		@include('reclamos.templates.general-form')
	@elseif(($request['es_importado'] == 'Sí' || $request['despacho'] == 'Centralizado') && session('u_sac') != 1)
		@include('reclamos.templates.general-form')
		@php /*@include('reclamos.templates.logistica-form')*/ @endphp
	@elseif(($request['es_importado'] == 'no' || $request['despacho'] == 'Directo') && session('u_sac') != 1)
		@include('reclamos.templates.general-form')
	@elseif(session('u_sac') == 1)
		@include('reclamos.templates.general-form')
	@php /*@include('reclamos.templates.sac-form')*/ @endphp
	@endif
	<script>
		jQuery(document).ready(function(){
			$('#collapseReclamos').addClass('show');
		});
	</script>
</x-layout>