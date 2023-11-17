<x-layout>
	<x-slot name="breadcrumb">
		Tiendas
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
	        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Listado de Tiendas <a class="btn btn-primary" href="{{route('nuevaTienda')}}">Nueva Tienda</a></h6>
	            </div>
	            <div class="card-body">
	            	<div class="col-md-12">
	            		<label class="m-0 font-weight-bold text-black">Buscador</label>
	            	</div>
	            	<div class="col-md-12">
	            		<form method="POST" action="{{ route('listTiendas')}}">
		               		@csrf
		               		
			            	<div class="col-md-12">
			            		<table class="table table-bordered table-striped table-hover dataTable"width="100%" cellspacing="0">
			                        <thead>
			                            <tr>
			                            	<th>Área Tienda</th>
			                                <th>Tienda</th>
			                                <th>Código</th>
			                                <th>Zona</th>
			                                <th>Estado</th>
			                                <th>Ver</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($tiendas as $tienda)
			                        		<tr>			                        			
				                                <td>{{$tienda->area}}</td>
				                                <td>{{$tienda->nombre}}</td>
				                                <td>{{$tienda->codigo}}</td>
				                                <td>{{$tienda->zona}}</td>
				                                <td>{{($tienda->status == 1) ? 'Activo' : 'Inactivo'}}</td>
				                                <td>
				                                	<a class="btn btn-primary btn-circle btn-sm" href="{{route('editTienda',$tienda->id)}}">
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