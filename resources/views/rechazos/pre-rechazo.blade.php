<x-layout>

	<x-slot name="breadcrumb">
		Reclamo Nuevo
	</x-slot>

<div class="row">
	<div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buscar Proveedor / Producto</h6>
            </div>
            <div class="card-body">
               	<form method="POST" action="{{ route('preRechazo')}}">
               		@csrf
					<div class="row">
               			<div class="col-md-4">
							<div class="form-group">
								<label for="nombreProv">Nombre Proveedor:</label>
								<input type="text" class="form-control" id="nombreProv" name="nombreProv" placeholder="Nombre Proveedor" value="{{ empty($request['nombreProv']) ? '' : $request['nombreProv'] }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="rutProv">Rut del proveedor:</label>
								<input type="text" class="form-control" id="rutProv" name="rutProv" placeholder="Rut del proveedor" value="{{ empty($request['rutProv']) ? '' : $request['rutProv'] }}">
							</div>
						</div>
					</div>
					<div class="row">
               			<div class="col-md-12">
		        			<hr class="sidebar-divider">
		        		</div>
               			<div class="col-md-4">
							<div class="form-group">
								<label for="nombreProd">Nombre producto:</label>
								<input type="text" class="form-control" id="nombreProd" name="nombreProd" placeholder="Nombre producto" value="{{ empty($request['nombreProd']) ? '' : $request['nombreProd'] }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="eanProd">Código EAN:</label>
								<input type="text" class="form-control" id="eanProd" name="eanProd" placeholder="Código EAN" value="{{ empty($request['eanProd']) ? '' : $request['eanProd'] }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="sapProd">Código SAP:</label>
								<input type="text" class="form-control" id="sapProd" name="sapProd" placeholder="Código SAP" value="{{ empty($request['sapProd']) ? '' : $request['sapProd'] }}">
							</div>
						</div>
					</div>
				  	<button class="btn btn-primary btn-icon-split" type="submit">
	                    <span class="icon text-white-50">
	                        <i class="fas fa-search"></i>
	                    </span>
	                    <span class="text">Buscar Proveedor / Producto</span>
	                </button>
               	</form>
            </div>
        </div>
    </div>
    @if(!empty($productos))
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Productos Encontrados</h6>
	            </div>
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Tipo Producto</th>
	                                <th>Nombre</th>
	                                <th>EAN</th>
	                                <th>SAP</th>
	                                <th>Proveedor</th>
	                                <th>Marca</th>
	                                <th>-</th>
	                            </tr>
	                        </thead>                       
	                        <tbody>
	                        	@foreach($productos as $producto)
	                        		<tr>
		                                <td>{{$producto->mp == 1 ? 'Marcas Propias' : 'Supermercado'}}</td>
		                                <td>{{$producto->nombre}}</td>
		                                <td>{{$producto->ean}}</td>
		                                <td>{{$producto->sap}}</td>
		                                <td>{{$producto->proveedor}}</td>
		                                <td>{{$producto->marca}}</td>
		                                <td>
		                                	<a class="btn btn-primary btn-circle btn-sm" href="{{route('nuevoRechazo',['id_proveedor' => $producto->id_proveedor, 'id_producto' =>$producto->id])}}"><i class="fa fa-check"></i></a>
		                                </td>
		                            </tr>
	                        	@endforeach	                        	
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
    @endif
    @if(!empty($proveedores))
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Proveedores Encontrados</h6>
	            </div>
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Nombre Proveedor</th>
	                                <th>Rut del proveedor</th>
	                                <th>-</th>
	                            </tr>
	                        </thead>                       
	                        <tbody>
	                        	@foreach($proveedores as $proveedor)
	                        		<tr>
		                                <td>{{$proveedor->nombre}}</td>
		                                <td>{{$proveedor->rut}}</td>
		                                <td>
		                                	<a class="btn btn-primary btn-circle btn-sm" href="{{route('nuevoRechazo',['id_proveedor' => $proveedor->id])}}"><i class="fa fa-check"></i></a>
		                                </td>
		                            </tr>
	                        	@endforeach	                        	
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
    @endif
</div>
<script>
	jQuery(document).ready(function(){
		$('#collapseRechazos').addClass('show');
	});
</script>
</x-layout>