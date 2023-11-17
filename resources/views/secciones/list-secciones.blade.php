<x-layout>
	<x-slot name="breadcrumb">
		Secciones
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
	        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Listado de Secciones <a class="btn btn-primary" href="{{route('nuevaSeccion')}}">Nuevo Seccion</a></h6>
	            </div>
	            <div class="card-body">
	            	<div class="col-md-12">
	            		<label class="m-0 font-weight-bold text-black">Buscador</label>
	            	</div>
	            	<div class="col-md-12">
	            		<form method="POST" action="{{ route('listSecciones')}}">
		               		@csrf
		               		
			            	<div class="col-md-12">
			            		<table class="table table-bordered table-striped table-hover dataTable" width="100%" cellspacing="0">
			                        <thead>
			                            <tr>
			                                <th>Sección</th>
			                                <th>Código</th>
			                                <th>Estado</th>
			                                <th>Ver</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($secciones as $seccion)
			                        		<tr>
				                                <td>{{$seccion->nombre}}</td>
				                                <td>{{$seccion->codigo}}</td>
				                                <td>{{($seccion->status == 1) ? 'Activo' : 'Inactivo'}}</td>
				                                <td>
				                                	<a class="btn btn-primary btn-circle btn-sm" href="{{route('editSeccion',$seccion->id)}}">
				                                        <i class="fa fa-check"></i>
				                                    </a>
				                                </td>
				                            </tr>
			                        	@endforeach
			                        </tbody>
			                    </table>
			            	</div>
	               		</form>
	            	</div>
	            	<div class="col-md-12">
	            		<hr class="sidebar-divider">
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#collapseAdministracion').addClass('show');
		});
	</script>
</x-layout>