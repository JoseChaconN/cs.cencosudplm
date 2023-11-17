<x-layout>
	<x-slot name="breadcrumb">
		Inicio
	</x-slot>
    @hasanyrole('supervisor|tienda|tecnólogo')
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardReclamos" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardReclamos">
                        <h6 class="m-0 font-weight-bold text-primary">Resumen Reclamos {{$meses_array[date('m')].' '.date('Y')}}</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardReclamos">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Reclamos en Proceso Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_tiendas_reclamos_proceso'])) ? $data_dashboard['resumen_mis_tiendas_reclamos_proceso'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Reclamos Cerrados Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_tiendas_reclamos_cerrados'])) ? $data_dashboard['resumen_mis_tiendas_reclamos_cerrados'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Mis Reclamos en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_reclamos_proceso'])) ? $data_dashboard['resumen_mis_reclamos_proceso'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Mis Reclamos Cerrados</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_reclamos_cerrados'])) ? $data_dashboard['resumen_mis_reclamos_cerrados'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (!empty(session('u_ccs')) || count(session('u_ccs')) > 0)
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Alertas de Recall</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_alerta'])) ? $data_dashboard['resumen_alerta'] : 0}}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->area == 'SISA' && auth()->user()->hasRole('tienda'))
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Mis Reclamos Rechazados</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->area == 'SISA' && auth()->user()->hasRole('supervisor'))
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">N° Reclamos por Aprobar Tiendas</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12 pull-rigth">
                                    <button class="btn btn-primary btn-sm" type="button">Ir a Reportes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardRecall" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardRecall">
                        <h6 class="m-0 font-weight-bold text-warning-800">Resumen Recalls {{$meses_array[date('m')].' '.date('Y')}}</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardRecall">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning-800 shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning-800 text-uppercase mb-1">N° Recall en Proceso Mi Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_recall_proceso'])) ? $data_dashboard['resumen_mis_recall_proceso'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning-800 shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning-800 text-uppercase mb-1">N° Recall Cerrados Mi Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_recall_cerrados'])) ? $data_dashboard['resumen_mis_recall_cerrados'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning-800 shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning-800 text-uppercase mb-1">N° Respuestas de Recall Tienda</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_tiendas_respuestas_recall'])) ? $data_dashboard['resumen_mis_tiendas_respuestas_recall'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning-800 shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning-800 text-uppercase mb-1">N° Mis Respuestas de Recall</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_respuestas_recall'])) ? $data_dashboard['resumen_mis_respuestas_recall'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pull-rigth">
                                    <button class="btn btn-warning-800 btn-sm" type="button">Ir a Reportes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endhasanyrole
    @hasrole('rechazos')
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardRechazos" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardRechazos">
                        <h6 class="m-0 font-weight-bold text-danger">Resumen Rechazos {{$meses_array[date('m')].' '.date('Y')}}</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardRechazos">
                        <div class="card-body">                            
                            <div class="row">
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos en Proceso Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_tiendas_rechazo_proceso'])) ? $data_dashboard['resumen_mis_tiendas_rechazo_proceso'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos Cerrados Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_tiendas_rechazo_cerrados'])) ? $data_dashboard['resumen_mis_tiendas_rechazo_cerrados'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Acciones Correctivas Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Mis N° Rechazos en Proceso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_rechazo_proceso'])) ? $data_dashboard['resumen_mis_rechazo_proceso'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Mis N° Rechazos Cerrados Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{(!empty($data_dashboard['resumen_mis_rechazo_cerrados'])) ? $data_dashboard['resumen_mis_rechazo_cerrados'] : 0}}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Mis N° Acciones Correctivas Mis Tiendas</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pull-rigth">
                                    <button class="btn btn-danger btn-sm" type="button">Ir a Reportes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @hasrole('inicio reportes rechazos')        
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardRechazosCadenas" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCardRechazosCadenas">
                            <h6 class="m-0 font-weight-bold text-danger">Resumen Rechazos Cadenas {{$meses_array[date('m')].' '.date('Y')}}</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardRechazosCadenas">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos en Proceso Cadena Sisa</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos Cerrados Cadena Sisa</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Acciones Correctivas Cadena Sisa</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos en Proceso Cadena Jumbo</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos Cerrados Cadena Jumbo</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Acciones Correctivas Cadena Jumbo</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos en Proceso Cadena Total</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Rechazos Cerrados Cadena Total</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">N° Acciones Correctivas Cadena Total</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole
    @endhasrole
    @hasanyrole('supervisor|tecnólogo')
        <div class="row">
            <div class="col-md-6">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <div class="d-block card-header py-3" >
                        <h6 class="m-0 font-weight-bold text-primary">Alerta de Reclamos Centro de Competencia</h6>
                </div>
                    <!-- Card Content - Collapse -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table-sm table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>N° Reclamo</th>
                                            <th>Fecha de ingreso</th>
                                            <th>Producto</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_dashboard['alerta_reclamos'] as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->fecha_local}}</td>
                                                <td>{{$item->nombre_producto}}</td>
                                                <td>-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <div class="d-block card-header py-3" >
                        <h6 class="m-0 font-weight-bold text-primary">Reclamos SAC en proceso como Responsable o Supervisor</h6>
                    </div>
                    <!-- Card Content - Collapse -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table-sm table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>N° Reclamo</th>
                                            <th>Fecha de ingreso</th>
                                            <th>Producto</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_dashboard['reclamos_sac'] as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->fecha_local}}</td>
                                                <td>{{$item->nombre_producto}}</td>
                                                <td>-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endhasanyrole
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reclamos, Reclamos SAC, Recalls {{date('Y')}}</h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="myChart" style="max-height:400px"></canvas>
                        </div>
                        <div class="col-md-12 mt-2 ml-4">
                            <small class="text-body-secondary">*Nota: Este gráfico refleja una combinación de registros en proceso y registros cerrados. Es importante considerar ambos conjuntos de datos al interpretar los resultados.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script type="module" > 
        const ctx = document.getElementById('myChart');
        console.log(@json($data_dashboard['resumen_grafico_reclamos']))
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [
                {
                    label: 'Reclamos',
                    data: @json($data_dashboard['resumen_grafico_reclamos']),//[10,4,13,12,13,27,52,75,30,23,0,0],
                    borderWidth: 3,
                    borderColor: '#4e73df',
                    backgroundColor: '#4e73df',
                },
                {
                    label: 'Reclamos SAC',
                    data: @json($data_dashboard['resumen_grafico_reclamos_sac']),//[0,32,3,22,3,7,5,5,3,2,0,0],
                    borderWidth: 3,
                    borderColor: '#36b9cc',
                    backgroundColor: '#36b9cc',
                },
                {
                    label: 'Recalls',
                    data: @json($data_dashboard['resumen_grafico_recall']),//[14,11,2,25,33,17,12,45,10,23,0,0],
                    borderWidth: 3,
                    borderColor: '#EF6C00',
                    backgroundColor: '#EF6C00',
                },
                {
                    label: 'Rechazos',
                    data: @json($data_dashboard['resumen_grafico_rechazos']),//[13,1,23,14,23,37,42,45,12,13,0,0],
                    borderWidth: 3,
                    borderColor: '#e74a3b',
                    backgroundColor: '#e74a3b',
                }
        ]
          },
          options: {
            plugins: {
                filler: {
                    propagate: false,
                },
                title: {
                    display: true,
                    text: 'Reclamos, Reclamos SAC y Recalls {{date("Y")}}',//(ctx) => 'Fill: ' + ctx.chart.data.datasets[0].fill
                }
            },
            interaction: {
                intersect: false,
            },
            elements:{
                line:{
                    tension: 0.4,
                },
            }
        },
        });
    </script>
</x-layout>