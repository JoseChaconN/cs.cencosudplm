<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Reclamo;
use App\Models\Rechazo;
use App\Models\Recall;
use App\Models\RecallRespuesta;
use App\Models\Seccion;
use App\Models\User;
use App\Models\CentroCompetencia;
use App\Models\UsuarioCentroCompetencia;
use App\Models\SeccionCentroCompetencia;
use App\Models\UsuarioTienda;
use App\Models\UsuarioSeccion;
use App\Models\ReclamoOld;
use App\Models\RecallOld;
use App\Models\ProveedorOld;
use Spatie\Permission\Models\Role;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\UserLoggedIn;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_role()
    {
        #Role::create(['name' => 'rechazos']);
        #$rol_reportes_todos_reclamos = Role::create(['name' => 'supervisor reportes reclamos']);
        #$rol_reportes_todos_recalls = Role::create(['name' => 'supervisor reportes recalls']);
        #$rol_reportes_todos_rechazos = Role::create(['name' => 'supervisor reportes rechazos']);
    }
    public function index()
    {
        #echo "AAAAAAAAAA";
        #$usuario->update(['ultima_conexion' => '2023-01-01 23:00:00']);
        #dd($usuario);
        #dd(event(new UserLoggedIn(Auth::user())));
        #echo 1;
        #die();
        $data['breadcrumb'] = 'Inicio';
        #$data['slot'] = '';
        #$data = ['breadcrumb' => 'Inicio' , 'slot' => ''];
        #return view('components.layout',$data);
        $ano = date('Y');
        $mes = date('m');
        $id_user = Auth::user()->id;
        
        $data['data_dashboard'] = $this->data_dashboard($ano,$mes,$id_user);
        #$data['top_5_proveedores'] = $this->top_5_proveedores($ano,$mes);        
        #$data['top_5_productos'] = $this->top_5_productos($ano,$mes);
        #$top_5_secciones = $this->top_5_secciones($ano,$mes);
        #$alertas_reclamos_cc = $this->alertas_reclamos_cc($ano,$mes,$id_user);
        #$mis_reclamos_sac = $this->mis_reclamos_sac($ano,$mes,$id_user);
        #$data_dashboard = $this->data_dashboard($ano,$mes);
        return view('dashboard.index',$data);
        #$data['usuarios'] = User::get();
        #return view('usuarios.list-usuarios',$data);
    }
    public function top_5_proveedores($ano,$mes)
    {


       /* $ProveedorOld = ProveedorOld::withCount('proveedor_reclamo')->latest('proveedor_reclamo_count')->take(5)->get();
        $ProveedorOld->transform(function($proveedor) {
            $proveedor->products = Product::whereHas('categories', function($q) use($proveedor) {
                $q->where('id', $category->id);
            })
            ->take(5)
            ->get();
            return $category;
        });*/

        /*$data['mis_prospectos'] = ReclamoOld::->where('status','proceso')
        ->where(function ($query) {
            $query->where('id_creador',Auth::user()->id)
                    ->orWhere('id_comercial',Auth::user()->id)
                    ->orWhere('id_calidad',Auth::user()->id);
        })->get();*/
        #$data = ProveedorOld::where('nombre','!=','')->where('rut_proveedor','!=','')->withCount('proveedor_reclamo')->latest('proveedor_reclamo_count')->take(5)->get();


       #$data = ProveedorOld::withCount('proveedor_reclamo')->orderBy('proveedor_reclamo_count','desc')->take(5)->get();


        #$data = ProveedorOld::withCount('proveedor_reclamo')->latest('proveedor_reclamo_count')->take(5)->get();
        
        $data['reclamos'] = DB::connection('cencosud_old')->table('db_jumbo_proveedor')
        ->join('reclamos_supermecados', 'db_jumbo_proveedor.rut_proveedor', '=', 'reclamos_supermecados.proveedor')
        ->select('db_jumbo_proveedor.nombre', DB::raw('COUNT(reclamos_supermecados.reclamo_ID) as total'))
        ->where('reclamos_supermecados.reclamo_fecha','LIKE','%/'.$mes.'/'.$ano.'%')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','')
        ->where('db_jumbo_proveedor.nombre','!=','')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','-1')
        ->where('db_jumbo_proveedor.nombre','!=','-1')
        ->groupBy('db_jumbo_proveedor.rut_proveedor',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();

        $data['reclamos_sac'] = DB::connection('cencosud_old')->table('db_jumbo_proveedor')
        ->join('reclamos_supermecados', 'db_jumbo_proveedor.rut_proveedor', '=', 'reclamos_supermecados.proveedor')
        ->select('db_jumbo_proveedor.nombre', DB::raw('COUNT(reclamos_supermecados.reclamo_ID) as total'))
        ->where('reclamos_supermecados.reclamo_fecha','LIKE','%/'.$mes.'/'.$ano.'%')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','')
        ->where('db_jumbo_proveedor.nombre','!=','')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','-1')
        ->where('db_jumbo_proveedor.nombre','!=','-1')
        ->where('reclamos_supermecados.caso_atento','si')
        #(caso_atento = 'si' OR tipo_reclamo='Servicio al cliente')
        ->groupBy('db_jumbo_proveedor.rut_proveedor',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();

        $data['recall'] = DB::connection('cencosud_old')->table('db_jumbo_proveedor')
        ->join('recall_supermecados', 'db_jumbo_proveedor.rut_proveedor', '=', 'recall_supermecados.proveedor')
        ->select('db_jumbo_proveedor.nombre', DB::raw('COUNT(recall_supermecados.recall_ID) as total'))
        ->where('recall_supermecados.momento_ingreso','LIKE','%'.$ano.'/'.$mes.'%')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','')
        ->where('db_jumbo_proveedor.nombre','!=','')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','-1')
        ->where('db_jumbo_proveedor.nombre','!=','-1')
        ->groupBy('db_jumbo_proveedor.rut_proveedor',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();
        return $data;
    }
    public function top_5_productos($ano,$mes)
    {
        $data['reclamos'] = DB::connection('cencosud_old')->table('bd_productos_supermercado')
        ->join('reclamos_supermecados', 'bd_productos_supermercado.producto_ID', '=', 'reclamos_supermecados.producto_ID')
        ->select('bd_productos_supermercado.nombre_producto', DB::raw('COUNT(reclamos_supermecados.reclamo_ID) as total'))
        ->where('reclamos_supermecados.reclamo_fecha','LIKE','%/'.$mes.'/'.$ano.'%')
        ->groupBy('bd_productos_supermercado.nombre_producto',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();

        $data['reclamos_sac'] = DB::connection('cencosud_old')->table('bd_productos_supermercado')
        ->join('reclamos_supermecados', 'bd_productos_supermercado.producto_ID', '=', 'reclamos_supermecados.producto_ID')
        ->select('bd_productos_supermercado.nombre_producto', DB::raw('COUNT(reclamos_supermecados.reclamo_ID) as total'))
        ->where('reclamos_supermecados.reclamo_fecha','LIKE','%/'.$mes.'/'.$ano.'%')
        ->where('reclamos_supermecados.caso_atento','si')
        #(caso_atento = 'si' OR tipo_reclamo='Servicio al cliente')
        ->groupBy('bd_productos_supermercado.nombre_producto',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();

        $data['recall'] = [];/*DB::connection('cencosud_old')->table('db_jumbo_proveedor')
        ->join('recall_supermecados', 'db_jumbo_proveedor.rut_proveedor', '=', 'recall_supermecados.proveedor')
        ->select('db_jumbo_proveedor.nombre', DB::raw('COUNT(recall_supermecados.recall_ID) as total'))
        ->where('recall_supermecados.momento_ingreso','LIKE','%'.$ano.'/'.$mes.'%')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','')
        ->where('db_jumbo_proveedor.nombre','!=','')
        ->where('db_jumbo_proveedor.rut_proveedor','!=','-1')
        ->where('db_jumbo_proveedor.nombre','!=','-1')
        ->groupBy('db_jumbo_proveedor.rut_proveedor',)
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();*/
        return $data;
    }
    public function top_5_secciones($ano,$mes)
    {

    }
    public function alertas_reclamos_cc($ano,$mes,$id_user)
    {

    }
    public function mis_reclamos_sac($ano,$mes,$id_user)
    {

    }
    public function data_dashboard($ano,$mes,$id_user)
    {

        #dd($this->top_5_productos(2023,10));
        $usuario = User::find($id_user);
        $tiendas_usuario = UsuarioTienda::where('id_usuario', $id_user)->where('tipo', 'USUARIO')->get();
        $tiendas_supervisor = UsuarioTienda::where('id_usuario', $id_user)->where('tipo', 'SUPERVISOR')->get();
        foreach ($tiendas_usuario as $item) {
            $id_local[$item->id_tienda]=$item->id_tienda;
        }
        foreach ($tiendas_supervisor as $item) {
            $id_local[$item->id_tienda]=$item->id_tienda;
        }
        $ccs_usuario = UsuarioCentroCompetencia::where('id_usuario', $id_user)->get();
        $ccs_usuario_q=[];
        if(!empty($ccs_usuario)){
            foreach ($ccs_usuario as $key => $value) {
                $ccs_usuario_q[]=$value['id_cc'];
            }
        }
        $ccs_usuario = SeccionCentroCompetencia::whereIn('id_cc', $ccs_usuario_q)->get();
        $secciones_ccs_usuario=[];
        if(!empty($ccs_usuario)){
            foreach ($ccs_usuario as $key => $value) {
                $secciones_ccs_usuario[$value['codigo_seccion']]=$value['codigo_seccion'];
            }
        }

        #RECLAMOS
        $data['resumen_mis_reclamos_proceso']=$usuario->reclamos()->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->count();
        $data['resumen_mis_reclamos_cerrados']=$usuario->reclamos()->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('status','CERRADO')->count();
        $data['resumen_mis_tiendas_reclamos_proceso'] = Reclamo::whereIn('id_local', $id_local)->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->count();
        $data['resumen_mis_tiendas_reclamos_cerrados'] = Reclamo::whereIn('id_local', $id_local)->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('status','CERRADO')->count();

        #RECALLS
        $data['resumen_mis_recall_proceso']=$usuario->recall()->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->count();
        $data['resumen_mis_recall_cerrados']=$usuario->recall()->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->where('status','CERRADO')->count();
        $data['resumen_mis_respuestas_recall'] = $usuario->respuesta_recall()->where('created_at','LIKE','%'.$ano.'-'.$mes.'%')->count();
        $data['resumen_mis_tiendas_respuestas_recall'] = RecallRespuesta::whereIn('id_local', $id_local)->where('created_at','LIKE','%'.$ano.'-'.$mes.'%')->count();

        #RECHAZOS
        $data['resumen_mis_rechazo_proceso']=$usuario->rechazos()->where('fecha_inicio','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->count();
        $data['resumen_mis_rechazo_cerrados']=$usuario->rechazos()->where('fecha_inicio','LIKE','%'.$ano.'-'.$mes.'%')->where('status','CERRADO')->count();
        $data['resumen_mis_tiendas_rechazo_proceso'] = $data['resumen_mis_rechazo_proceso'];#Rechazo::whereIn('id_local', $id_local)->where('fecha_inicio','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->count();
        $data['resumen_mis_tiendas_rechazo_cerrados'] =  $data['resumen_mis_rechazo_cerrados'];#Rechazo::whereIn('id_local', $id_local)->where('fecha_cerrado','LIKE','%'.$ano.'-'.$mes.'%')->where('status','CERRADO')->count();

        #ALERTAS RECLAMOS
        $data['resumen_alerta'] = Reclamo::whereIn('id_seccion', $secciones_ccs_usuario)->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('posible_recall','si')->where('status','PROCESO')->count();
        $data['alerta_reclamos'] = Reclamo::whereIn('id_seccion', $secciones_ccs_usuario)->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('posible_recall','si')->where('status','PROCESO')->get();

        #Reclamos SAC
        $data['reclamos_sac']=$usuario->reclamos()->where('caso_atento','si')->where('fecha_local','LIKE','%'.$ano.'-'.$mes.'%')->where('status','PROCESO')->get();
        #dd($data['reclamos_sac']);


        #Grafico
        $meses_array = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
        foreach ($meses_array as $key => $value) {
            $data['resumen_grafico_reclamos'][]=Reclamo::where('fecha_local','LIKE','%'.$ano.'-'.$key.'%')->count();
            $data['resumen_grafico_reclamos_sac'][]=Reclamo::where('fecha_local','LIKE','%'.$ano.'-'.$key.'%')->where('caso_atento','si')->count();
            $data['resumen_grafico_recall'][]=Recall::where('momento_ingreso','LIKE','%'.$ano.'-'.$key.'%')->count();
            $data['resumen_grafico_rechazos'][]=Rechazo::where('fecha_inicio','LIKE','%'.$ano.'-'.$key.'%')->count();
        }
        return $data;
    }
    public function set_tienda_usuario(Request $request)
    {
        $tienda = Tienda::find($request->input('tienda'));
        $request->session()->forget('u_id_tienda');
        $request->session()->forget('u_codigo_tienda');
        $request->session()->forget('u_nombre_tienda');
        session(['u_id_tienda' => $request->input('tienda')]);
        session(['u_codigo_tienda' => $tienda->codigo]);
        session(['u_nombre_tienda' => $tienda->nombre]);
        session(['u_area_tienda' => $tienda->area]);
        session(['u_categoria_tienda' => $tienda->categoria]);
        session(['u_zona_tienda' => $tienda->zona]);
        #print_r(session()->all());
        #session('u_id_tienda',$request->input('tienda'));
        return redirect()->intended();
        #return redirect()->route('home');
    }
}
    