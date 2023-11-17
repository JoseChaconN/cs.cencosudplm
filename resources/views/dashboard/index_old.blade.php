<x-layout>
	<x-slot name="breadcrumb">
		Inicio
	</x-slot>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Reclamos en Proceso</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Alertas de Recall</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Recalls en Proceso </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-search fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Reclamos por Aprobar </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <div class="d-block card-header py-3" >
                    <h6 class="m-0 font-weight-bold text-primary">Alerta de Reclamos Centro Competencia</h6>
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
                    <h6 class="m-0 font-weight-bold text-primary">Reclamos SAC en proceso como Responsable ó Supervisor</h6>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Collapsable Card Example -->
        <div class="col-md-4">
            <div class="card border-left-primary shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Proveedores con más Reclamos {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach ($top_5_proveedores['reclamos'] as $item)
                                            <tr>
                                                <td>{{$item->nombre}}</td>
                                                <td>{{$item->total}}</td>
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
        <div class="col-md-4">
            <div class="card border-left-primary shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Productos con más Reclamos {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach ($top_5_productos['reclamos'] as $item)
                                            <tr>
                                                <td>{{$item->nombre_producto}}</td>
                                                <td>{{$item->total}}</td>
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
        <div class="col-md-4">
            <div class="card border-left-primary shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Secciones con más Reclamos {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Sección 1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 2</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 3</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 4</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 5</td>
                                            <td>22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Collapsable Card Example -->
        <div class="col-md-4">
            <div class="card border-left-info shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleSAC" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleSAC">
                    <h6 class="m-0 font-weight-bold text-info">Top 5 Proveedores con más Reclamos SAC {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleSAC">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach ($top_5_proveedores['reclamos_sac'] as $item)
                                            <tr>
                                                <td>{{$item->nombre}}</td>
                                                <td>{{$item->total}}</td>
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
        <div class="col-md-4">
            <div class="card border-left-info shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleSAC" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleSAC">
                    <h6 class="m-0 font-weight-bold text-info">Top 5 Productos con más Reclamos SAC {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleSAC">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach ($top_5_productos['reclamos_sac'] as $item)
                                            <tr>
                                                <td>{{$item->nombre_producto}}</td>
                                                <td>{{$item->total}}</td>
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
        <div class="col-md-4">
            <div class="card border-left-info shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleSAC" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleSAC">
                    <h6 class="m-0 font-weight-bold text-info">Top 5 Secciones con más Reclamos SAC {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleSAC">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Sección 1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 2</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 3</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 4</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 5</td>
                                            <td>22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Collapsable Card Example -->
        <div class="col-md-4">
            <div class="card border-left-warning-800 shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleRecall" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleRecall">
                    <h6 class="m-0 font-weight-bold text-warning-800">Top 5 Proveedores con más Recalls {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleRecall">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach ($top_5_proveedores['recall'] as $item)
                                            <tr>
                                                <td>{{$item->nombre}}</td>
                                                <td>{{$item->total}}</td>
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
        <div class="col-md-4">
            <div class="card border-left-warning-800 shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleRecall" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleRecall">
                    <h6 class="m-0 font-weight-bold text-warning-800">Top 5 Productos con más Recalls {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleRecall">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Producto 1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 2</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 3</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 4</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 5</td>
                                            <td>22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-left-warning-800 shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExampleRecall" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExampleRecall">
                    <h6 class="m-0 font-weight-bold text-warning-800">Top 5 Secciones con más Recalls {{$meses_array[date('m')]}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExampleRecall">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Sección 1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 2</td>
                                            <td>70</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 3</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 4</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Sección 5</td>
                                            <td>22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
      
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [
                {
                    label: 'Reclamos',
                    data: [10,4,13,12,13,27,52,75,30,23,42,41],
                    borderWidth: 3,
                    borderColor: '#4e73df',
                    backgroundColor: '#4e73df',
                },
                {
                    label: 'Reclamos SAC',
                    data: [0,32,3,22,3,7,5,5,3,2,4,1],
                    borderWidth: 3,
                    borderColor: '#36b9cc',
                    backgroundColor: '#36b9cc',
                },
                {
                    label: 'Recalls',
                    data: [14,11,2,25,33,17,12,45,10,23,12,43],
                    borderWidth: 3,
                    borderColor: '#EF6C00',
                    backgroundColor: '#EF6C00',
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