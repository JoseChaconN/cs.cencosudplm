<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3" href="index.html">
            <!--div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div-->
            <div class="sidebar-brand-text mx-3 ">Cencosud Calidad Supermercados</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Inicio</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestión
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReclamos"
                aria-expanded="true" aria-controls="collapseReclamos">
                <i class="fas fa-fw fa-cog"></i>
                <span>Reclamos</span>
            </a>
            <div id="collapseReclamos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('preReclamo') }}">Reclamos Nuevos</a>
                    @hasanyrole('admin|supervisor|tienda')
                        <a class="collapse-item" href="{{ route('listAprobarReclamo') }}">Reclamos por Aprobar</a>
                    @endhasanyrole
                    @hasanyrole('admin|administrador|tecnólogo|supervisor')
                        <a class="collapse-item" href="{{ route('listProcesoReclamo') }}">Reclamos en Proceso</a>
                        <a class="collapse-item" href="{{ route('listCerradoReclamo') }}">Reclamos Cerrados</a>
                    @endhasanyrole
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        @hasanyrole('admin|administrador|tecnólogo|supervisor')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRecall"
                    aria-expanded="true" aria-controls="collapseRecall">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Recalls</span>
                </a>
                <div id="collapseRecall" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('preRecall') }}">Nuevo Recall</a>
                        <a class="collapse-item" href="{{ route('listRecalls') }}">Informe de Gestión</a>
                    </div>
                </div>
            </li>
        @endhasanyrole
        <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRechazos"
                    aria-expanded="true" aria-controls="collapseRechazos">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Rechazos</span>
                </a>
                <div id="collapseRechazos" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rechazos:</h6>
                        <a class="collapse-item" href="{{route('preRechazo')}}">Nuevo Rechazo</a>
                        <a class="collapse-item" href="{{route('listProcesoRechazo')}}">Rechazos Proceso</a>
                        <a class="collapse-item" href="{{route('listCerradoRechazo')}}">Rechazos Cerrados</a>
                        <a class="collapse-item" href="{{route('mesSinRechazo')}}">Mes sin Rechazo</a>
                        <!--a class="collapse-item" href="#">Acciones Correctivas</a>
                        <a class="collapse-item" href="#">Reporte Especial</a>
                        <a class="collapse-item" href="#">Sincronizar Excel</a-->
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReporte"
                    aria-expanded="true" aria-controls="collapseReporte">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reportes</span>
                </a>
                <div id="collapseReporte" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Reportes:</h6>
                        <a class="collapse-item" href="{{ route('reporte.reclamos') }}">Reclamos</a>
                        <a class="collapse-item" href="{{ route('reporte.recalls') }}">Recalls</a>
                        <a class="collapse-item" href="{{ route('reporte.rechazos') }}">Rechazos</a>
                    </div>
                </div>
            </li>
        @hasanyrole('admin')
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdministracion"
                    aria-expanded="true" aria-controls="collapseAdministracion">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Administración</span>
                </a>
                <div id="collapseAdministracion" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administración:</h6>
                        @role('admin')
                            <a class="collapse-item" href="{{route('listUsuarios')}}">Usuarios</a>
                        @endrole                        
                        <a class="collapse-item" href="{{route('listTiendas')}}">Tiendas</a>
                        <a class="collapse-item" href="{{route('listProductos')}}">Productos</a>
                        <a class="collapse-item" href="{{route('listProveedores')}}">Proveedores</a>
                        <a class="collapse-item" href="{{route('listCentrosCompetencia')}}">Centros de Competencia</a>
                        <a class="collapse-item" href="{{route('listSecciones')}}">Secciones</a>
                        <a class="collapse-item" href="{{route('cargarBBDD')}}">Subir Base de Datos <br> Productos/Proveedores</a>
                        
                    </div>
                </div>
            </li>
        @endhasanyrole
    </ul>
    <!-- End of Sidebar -->