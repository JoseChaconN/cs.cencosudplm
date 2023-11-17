<!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 nav-item">
           <img src="https://www.cencosud.com/cencosud/site/artic/20211220/imag/foto_0000001720211220181659/1-Jumbo-400x400px.jpg" class="img-profile rounded-circle" style="height: auto;width:70px">
           <img src="https://www.cencosud.com/cencosud/site/artic/20211221/imag/foto_0000001420211221111706/2-SantaIsabel-400x400px.jpg" class="img-profile rounded-circle" style="height: auto;width:70px">
           <img src="https://www.cencosud.com/cencosud/site/artic/20211221/imag/foto_0000001420211221111715/3-Spid-400x400px.jpg" class="img-profile rounded-circle" style="height: auto;width:70px">
        </div>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown no-arrow mx-1 text-left">
                
                    <b><span class="nav-link dropdown-toggle text-{{(session('u_categoria_tienda') == 'JUMBO') ? 'primary' : 'danger'}}">Local Actual: {{session('u_codigo_tienda').' - '.session('u_nombre_tienda')}}</span></b>
                
                
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter" id="alertCounter"></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alertas
                    </h6>
                    <a class="dropdown-item align-items-center d-none alertLink" style="display: none;" href="#" id="alert_0">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500 alertDate">December 12, 2019</div>
                            <span class="font-weight-bold alertText">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <div id="alertContentDiv">
                    </div>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas mis alertas</a>
                </div>
            </li>
           {{--  <!-- Nav Item - Alerts -->
            

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="/img/undraw_profile_1.svg"
                                alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="/img/undraw_profile_2.svg"
                                alt="">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="/img/undraw_profile_3.svg"
                                alt="">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li> --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{session('u_nombre').' '.session('u_apellido')}}</span>
                    <img class="img-profile rounded-circle"
                        src="/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('perfilUsuario')}}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#selectTiendaModal">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cambiar Tienda
                    </a>
                    <!--a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a-->
                    <!--a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a-->
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </li>

        </ul>
        <form id="notificationAlertForm">
            @csrf
        </form>
    </nav>
    <script>
        $(document).ready(function () {
            fnGetNotificationsUser();
        });
        function fnGetNotificationsUser() {
            $('#alertContentDiv').html('')
            counter=0;
            $.post("{{ route('usuario.notificaciones.alert') }}", $("#notificationAlertForm").serialize(), function(response) {
                number= Math.round(Math.random()*(9999999999-1)+parseInt(1));
                $.each(response.data, function(key, value) {
                    //data_a = JSON.parse(value.data);
                    var fechaFormateada = moment(value.created_at).format('DD-MM-YYYY HH:mm:ss');                    
                    clone = $("#alert_0").clone().removeClass("d-none").addClass('d-flex');
                    clone.attr("id", "alert_"+number).attr('href',value.data.url);
                    clone.find('.alertDate').html(fechaFormateada);
                    clone.find('.alertText').html(value.data.tittle);  
                    $('#alertContentDiv').append(clone.show());
                    console.log(value.read_at)
                    if(value.read_at == null){
                        counter++
                    }
                });
                //$alertLink
                //$alertText
                
                $('#alertCounter').html(counter);
            });
            // Coloca aquí el código que deseas ejecutar cada 5 minutos
        }
        setInterval(fnGetNotificationsUser, 300000);
    </script>
<!-- End of Topbar -->