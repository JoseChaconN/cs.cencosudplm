<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\ReclamosController;
use App\Http\Controllers\RecallsController;
use App\Http\Controllers\RechazosController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CentrosCompetenciaController;
use App\Http\Controllers\SeccionesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\TiendasController;
use App\Http\Controllers\FrigorificosController;
use App\Http\Controllers\ReportesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/


Route::get('/templates', function () {
    return view('test.template-email');
});


///////LOGIN BREEZE/////////
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/crearrol', [HomeController::class, 'create_role'])->name('rol.crear');
Route::post('/asignar_tienda', [HomeController::class, 'set_tienda_usuario'])->name('setTiendaUsuario');

///////RECLAMOS////////
Route::view('/reclamos/guardado', 'reclamos.index')->name('guardado');
Route::match(['get','post'],'/reclamos', [ReclamosController::class, 'reclamo'])->name('preReclamo');

#Route::match(['get','post'],'/reclamos', [ReclamosController::class, 'reclamo_nuevo'])->name('crearReclamo');
Route::post('/reclamos/nuevo', [ReclamosController::class, 'reclamo_nuevo'])->name('crearReclamo');
Route::post('/reclamos/nuevo/guardar', [ReclamosController::class, 'guardar_reclamo_nuevo'])->name('guardarReclamoNuevo');
#Route::post('/reclamos/proceso', [ReclamosController::class, 'reclamos_proceso'])->name('listProcesoReclamo');
Route::match(['get','post'],'/reclamos/aprobar', [ReclamosController::class, 'reclamos_aprobar'])->name('listAprobarReclamo');
Route::match(['get','post'],'/reclamos/proceso', [ReclamosController::class, 'reclamos_proceso'])->name('listProcesoReclamo');
#Route::get('/reclamos/cerrado', [ReclamosController::class, 'reclamos_cerrado'])->name('listCerradoReclamo');
Route::match(['get','post'],'/reclamos/cerrado', [ReclamosController::class, 'reclamos_cerrado'])->name('listCerradoReclamo');
Route::post('/reclamos/buscar/', [ReclamosController::class, 'reclamo_buscar'])->name('reclamos.buscar');
Route::patch('/reclamos/rechazar/{id}', [ReclamosController::class, 'reclamo_rechazar'])->name('reclamos.rechazar');

Route::get('/reclamos/proceso/{id}', [ReclamosController::class, 'reclamo_proceso'])->name('procesoReclamo');
Route::get('/reclamos/pdf/{id}', [ReclamosController::class, 'reclamo_pdf'])->name('pdfReclamo');
Route::get('/reclamos/respuestas-reclamo/{id}', [ReclamosController::class, 'respuestas_reclamo'])->name('reclamos.respuestas-local');
Route::patch('/reclamos/proceso/{id}', [ReclamosController::class, 'guardar_reclamo_proceso'])->name('guardarReclamoProceso');
Route::get('/reclamos/cerrado/{id}', [ReclamosController::class, 'reclamo_cerrado'])->name('cerradoReclamo');

Route::post('/reclamos/notificar/respuestas', [ReclamosController::class, 'reclamo_notificar_respuestas'])->name('reclamo.notificar.respuestas');




///////RECALLS//////////
Route::match(['get','post'],'/recalls', [RecallsController::class, 'recall'])->name('preRecall');

Route::match(['get','post'],'/recalls/listado', [RecallsController::class, 'recall_list'])->name('listRecalls');

Route::get('/recalls/nuevo/{id}', [RecallsController::class, 'recall_nuevo'])->name('nuevoRecall');
Route::post('/recalls/nuevo/guardar', [RecallsController::class, 'guardar_recall_nuevo'])->name('guardarRecallNuevo');
Route::post('/recalls/cerrar', [RecallsController::class, 'cerrar_recall'])->name('recall.cerrar');
Route::post('/recalls/abrir', [RecallsController::class, 'abrir_recall'])->name('recall.abrir');

Route::get('/recalls/proceso/{id}', [RecallsController::class, 'recall_proceso'])->name('procesoRecall');
Route::get('/recalls/pdf/{id}', [RecallsController::class, 'recall_pdf'])->name('pdfRecall');
Route::get('/recalls/pdf/respuesta/{id}', [RecallsController::class, 'respuesta_recall_pdf'])->name('pdfRespuestaRecall');
Route::patch('/recalls/proceso/guardar/{id}', [RecallsController::class, 'guardar_recall_proceso'])->name('guardarRecallProceso');
Route::get('/recalls/proceso/detalle/{id}', [RecallsController::class, 'recall_detalle_proceso'])->name('procesoDetalleRecall');
Route::get('/recalls/proceso/respuesta/{id}', [RecallsController::class, 'recall_proceso_respuesta'])->name('respuestaRecall');
Route::post('/recalls/notificar/nuevo', [RecallsController::class, 'recall_notificar_nuevo'])->name('recall.notificar.nuevo');
#ELIMINAR EDITAR RESPUESTA RECALL
Route::get('/recalls/proceso/respuesta/edit/{id}', [RecallsController::class, 'recall_proceso_respuesta_edit'])->name('respuestaRecallEdit');
Route::post('/recalls/proceso/respuesta/guardar', [RecallsController::class, 'guardar_recall_respuesta'])->name('guardarRespuestaRecall');



//////////RECHAZOS///////////

Route::match(['get','post'],'/rechazos', [RechazosController::class, 'rechazo'])->name('preRechazo');
Route::get('/rechazos/nuevo/{id_proveedor}/{id_producto?}', [RechazosController::class, 'rechazo_nuevo'])->name('nuevoRechazo');

Route::get('/rechazos/proceso/{id}', [RechazosController::class, 'rechazo_edit'])->name('procesoRechazo');
Route::get('/rechazos/cerrado/{id}', [RechazosController::class, 'rechazo_edit'])->name('cerradoRechazo');

Route::get('/rechazos/mes_sin_rechazos/', [RechazosController::class, 'mes_sin_rechazos'])->name('mesSinRechazo');
Route::post('/rechazos/mes_sin_rechazos/guardar', [RechazosController::class, 'guardar_mes_sin_rechazos'])->name('guardarMesSinRechazo');



Route::post('/rechazos/nuevo/guardar', [RechazosController::class, 'guardar_rechazo'])->name('guardarRechazo');
Route::patch('/rechazos/nuevo/guardar/{id}', [RechazosController::class, 'guardar_rechazo'])->name('guardarEditRechazo');


Route::match(['get','post'],'/rechazos/proceso', [RechazosController::class, 'rechazos_proceso'])->name('listProcesoRechazo');
Route::match(['get','post'],'/rechazos/cerrado', [RechazosController::class, 'rechazos_cerrado'])->name('listCerradoRechazo');





////////////LOGIN////////////////
#Route::view('/login/', 'login.login')->name('login')->middleware('guest');
#Route::view('/login/recuperar_clave', 'login.recuperar_clave')->name('recuperar_clave')->middleware('guest');
#Route::post('/login/loggear', [LoginController::class, 'loggear'])->name('loggear');
#Route::post('/login/logout', [LoginController::class, 'logout'])->name('logout');

//////USUARIOS////////
Route::match(['get','post'],'/usuarios/listado', [UsuariosController::class, 'usuarios_list'])->name('listUsuarios');
Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'usuario_edit'])->name('editUsuario');
Route::get('/usuarios/nuevo/', [UsuariosController::class, 'usuario_nuevo'])->name('nuevoUsuario');
Route::get('/usuarios/perfil', [UsuariosController::class, 'usuario_perfil'])->name('perfilUsuario');

Route::post('/usuarios/nuevo/guardar', [UsuariosController::class, 'guardar_usuario'])->name('guardarNuevoUsuario');
Route::patch('/usuarios/edit/guardar/{id}', [UsuariosController::class, 'guardar_usuario'])->name('guardarEditUsuario');
Route::post('/usuarios/notificaciones/alert', [UsuariosController::class, 'usuario_notificaciones'])->name('usuario.notificaciones.alert');

//////PRODUCTOS////////
Route::match(['get','post'],'/productos/listado', [ProductosController::class, 'productos_list'])->name('listProductos');
Route::get('/productos/edit/{id}', [ProductosController::class, 'producto_edit'])->name('editProducto');
Route::get('/productos/nuevo/', [ProductosController::class, 'producto_nuevo'])->name('nuevoProducto');

Route::post('/productos/nuevo/guardar', [ProductosController::class, 'guardar_producto'])->name('guardarNuevoProducto');
Route::patch('/productos/edit/guardar/{id}', [ProductosController::class, 'guardar_producto'])->name('guardarEditProducto');
Route::get('/bbdd', [ProductosController::class, 'cargar_bbdd'])->name('cargarBBDD');


//////TIENDAS////////
Route::match(['get','post'],'/tiendas/listado', [TiendasController::class, 'tiendas_list'])->name('listTiendas');
Route::get('/tiendas/nueva/', [TiendasController::class, 'tienda_nuevo'])->name('nuevaTienda');
Route::get('/tiendas/edit/{id}', [TiendasController::class, 'tienda_edit'])->name('editTienda');
Route::post('/tiendas/nueva/guardar', [TiendasController::class, 'guardar_tienda'])->name('guardarNuevaTienda');
Route::patch('/tiendas/edit/guardar/{id}', [TiendasController::class, 'guardar_tienda'])->name('guardarEditTienda');

//////PROVEEDORES////////
Route::match(['get','post'],'/proveedores/listado', [ProveedoresController::class, 'proveedores_list'])->name('listProveedores');
Route::get('/proveedores/edit/{id}', [ProveedoresController::class, 'proveedor_edit'])->name('editProveedor');
Route::get('/proveedores/nuevo/', [ProveedoresController::class, 'proveedor_nuevo'])->name('nuevoProveedor');

Route::post('/proveedores/nuevo/guardar', [ProveedoresController::class, 'guardar_proveedor'])->name('guardarNuevoProveedor');
Route::patch('/proveedores/edit/guardar/{id}', [ProveedoresController::class, 'guardar_proveedor'])->name('guardarEditProveedor');


Route::get('/proveedores/asignar_secciones/', [ProveedoresController::class, 'set_secciones_proveedor']);
//////CENTROS COMPETENCIA////////
Route::match(['get','post'],'/centros_competencia/listado', [CentrosCompetenciaController::class, 'centro_competencia_list'])->name('listCentrosCompetencia');
Route::get('/centros_competencia/nueva/', [CentrosCompetenciaController::class, 'centro_competencia_nuevo'])->name('nuevoCentroCompetencia');
Route::get('/centros_competencia/edit/{id}', [CentrosCompetenciaController::class, 'centro_competencia_edit'])->name('editCentroCompetencia');
Route::post('/centros_competencia/nueva/guardar', [CentrosCompetenciaController::class, 'guardar_centro_competencia'])->name('guardarNuevoCentroCompetencia');
Route::patch('/centros_competencia/edit/guardar/{id}', [CentrosCompetenciaController::class, 'guardar_centro_competencia'])->name('guardarEditCentroCompetencia');


//////SECCIONES////////
Route::match(['get','post'],'/secciones/listado', [SeccionesController::class, 'secciones_list'])->name('listSecciones');
Route::get('/secciones/nueva/', [SeccionesController::class, 'seccion_nueva'])->name('nuevaSeccion');
Route::get('/secciones/edit/{id}', [SeccionesController::class, 'seccion_edit'])->name('editSeccion');
Route::post('/secciones/nueva/guardar', [SeccionesController::class, 'guardar_seccion'])->name('guardarNuevaSeccion');
Route::patch('/secciones/edit/guardar/{id}', [SeccionesController::class, 'guardar_seccion'])->name('guardarEditSeccion');


//////CHART//////
//Route::get('/chartPdf', [ChartController::class, 'index']);
//Route::get('/chartPdf/ver', [ChartController::class, 'ver']);

//////FRIGORIFICOS////////
#Route::match(['get','post'],'/proveedores/listado', [ProveedoresController::class, 'proveedores_list'])->name('listProveedores');
#Route::get('/proveedores/edit/{id}', [ProveedoresController::class, 'proveedor_edit'])->name('editProveedor');
#Route::get('/proveedores/nuevo/', [ProveedoresController::class, 'proveedor_nuevo'])->name('nuevoProveedor');

Route::post('/frigorificos/lista-json', [FrigorificosController::class, 'frigorificos_list_json'])->name('listaJsonFrigorificos');
#Route::patch('/proveedores/edit/guardar/{id}', [ProveedoresController::class, 'guardar_proveedor'])->name('guardarEditProveedor');


/////////////REPORTES RECLAMOS///////////////////////
Route::match(['get','post'],'/reportes/reclamos', [ReportesController::class, 'reclamos'])->name('reporte.reclamos');
Route::get('/reportes/recalls', [ReportesController::class, 'recalls'])->name('reporte.recalls');
Route::get('/reportes/rechazos', [ReportesController::class, 'rechazos'])->name('reporte.rechazos');
Route::post('/reportes/reclamos/excel/seccion/', [ReportesController::class, 'reporte_seccion_excel'])->name('reporte.reclamos.excel.seccion');
Route::post('/reportes/reclamos/excel/comercial/', [ReportesController::class, 'reporte_comercial_excel'])->name('reporte.reclamos.excel.comercial');
Route::post('/reportes/reclamos/excel/ciclo-3/', [ReportesController::class, 'reporte_ciclo3_excel'])->name('reporte.reclamos.excel.ciclo-3');
Route::post('/reportes/reclamos/excel/analisis-quejas-sac/', [ReportesController::class, 'reporte_analisis_quejas_sac_excel'])->name('reporte.reclamos.excel.analisis-quejas-sac');
Route::post('/reportes/reclamos/excel/proveedores/', [ReportesController::class, 'reporte_proveedores_excel'])->name('reporte.reclamos.excel.proveedores');
Route::post('/reportes/reclamos/excel/logistica/', [ReportesController::class, 'reporte_logistica_excel'])->name('reporte.reclamos.excel.logistica');
Route::post('/reportes/reclamos/excel/sac/', [ReportesController::class, 'reporte_sac_excel'])->name('reporte.reclamos.excel.sac');
Route::post('/reportes/reclamos/excel/mp-general/', [ReportesController::class, 'reporte_mp_general_excel'])->name('reporte.reclamos.excel.mp-general');

/////////////REPORTES RECALLS///////////////////////
Route::match(['get','post'],'/reportes/recalls', [ReportesController::class, 'recalls'])->name('reporte.recalls');
Route::post('/reportes/recalls/excel/respuesta-recall/', [ReportesController::class, 'reporte_respuesta_recall_excel'])->name('reporte.recalls.excel.respuesta-recall');
Route::get('/reportes/recalls/excel/respuesta-recall/detalle/{id}', [ReportesController::class, 'reporte_comercial_recall_detalle'])->name('reporte.recalls.comercial-recall-detalle');

/////////////REPORTES RECHAZOS///////////////////////
Route::match(['get','post'],'/reportes/rechazos', [ReportesController::class, 'recalls'])->name('reporte.rechazos');