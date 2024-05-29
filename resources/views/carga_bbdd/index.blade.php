<x-layout>
	<x-slot name="breadcrumb">
		Subir cargas masivas en excel Productos/Proveedores
	</x-slot>

	<div class="row">
		<div class="col-lg-12">
        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Carga masiva excel de PRODUCTOS</h6>
	            </div>
	            <div class="card-body">
	               	<form method="POST" action="#">
	               		@csrf               		
						<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Área</label>
                                    <select class="form-control" name="tienda">
                                        <option value="">Seleccione</option>
                                        <option value="">Supermercado</option>
                                        <option value="">Marcas Propias</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
								<div class="form-group">
									<label for="nombreProv">Excel:</label>
									<input type="file" class="form-control" id="nombreProv" name="nombreProv" placeholder="Nombre Proveedor" value="{{ empty($request['nombreProv']) ? '' : $request['nombreProv'] }}">
								</div>
							</div>
						</div>
						<div class="row">
	               			<div class="col-md-12">
			        			<hr class="sidebar-divider">
			        		</div>
	               			<div class="col-md-12">
                                <label>Notas!:</label><br>
                                <label>1) Sí el producto pertenece a frigorifico debe de colocar 1 en la columna frigorífico (K)</label><br>
                                <label>2) Para que la plataforma reconozca los piases deben de colocarlos en letras y mayusculas
                                    ejemplo: CHILE , ARGENTINA</label><br>
                                <label for="nombreProd">En caso de tener el Pais codificado debe de cambiarlo al nombre del país respectivo</label>
							</div>
						</div>
                        <a class="btn btn-secondary" href="https://cencosudplm.com/cs/formato_productos.xlsx">Descargar formato excel</a>
					  	<button class="btn btn-primary" type="button">
                            <span class="text">Cargar excel</span>
		                </button>
	               	</form>
	            </div>
	        </div>
	    </div>
	</div>
    <div class="row">
		<div class="col-lg-12">
        <!-- Basic Card Example -->
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Carga masiva excel de PROVEEDORES</h6>
	            </div>
	            <div class="card-body">
	               	<form method="POST" action="#">
	               		@csrf               		
						<div class="row">
                            <div class="col-md-4">
								<div class="form-group">
									<label for="nombreProv">Excel:</label>
									<input type="file" class="form-control" id="nombreProv" name="nombreProv" placeholder="Nombre Proveedor" value="{{ empty($request['nombreProv']) ? '' : $request['nombreProv'] }}">
								</div>
							</div>
						</div>
                        <a class="btn btn-secondary" href="https://cencosudplm.com/cs/formato_proveedor.xlsx">Descargar formato excel</a>
					  	<button class="btn btn-primary" type="button">
                            <span class="text">Cargar excel</span>
		                </button>
	               	</form>
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