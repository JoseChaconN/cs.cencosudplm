<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\ExcelExport;
use App\Models\Recall;
use App\Models\Reclamo;
use App\Models\ReclamoOld;
use App\Models\RecallRespuesta;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tienda;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

use App\Services\AppServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesController extends BaseController
{
	use AuthorizesRequests, ValidatesRequests;

	public function __construct()
	{
		$this->middleware('auth');
		#$this->middleware('role:admin|administrador|tecnologo')->except('recall_proceso_respuesta','guardar_recall_respuesta','recall_PDF', 'respuesta_recall_PDF');
		#$this->middleware('role:admin|administrador|tecnologo|tienda')->except('recall_PDF', 'respuesta_recall_PDF');
	}
    public function reclamos(Request $request)
    {

        $data['mes'] = (!empty($request->input('mes'))) ? $request->input('mes') : date('m');
		$data['ano'] = (!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
        $data['area_reporte']= $request->input('area_reporte');
        $data['tipo_reporte']= $request->input('tipo_reporte');
        $data['seccion']= $request->input('seccion');
        $data['secciones'] = Seccion::orderBy('nombre')->get();

       #$data['area_reportes'][1]='Todos (Jumbo/SISA)';        
        $data['area_reportes'][]=['val' => 1, 'text' => 'Jumbo'];
        $data['area_reportes'][]=['val' => 2, 'text' => 'SISA'];
        $data['area_reportes'][]=['val' => 3, 'text' => 'Logística'];
        $data['area_reportes'][]=['val' => 4, 'text' => 'Servicio al Cliente'];
        $data['area_reportes'][]=['val' => 5, 'text' => 'MP'];

        $data['tipo_reportes'][]=['val' => 1, 'text' => 'Reporte General', 'grupo' => [1,2,3,4]];
        $data['tipo_reportes'][]=['val' => 2, 'text' => 'Reporte Comercial', 'grupo' => [1,2]];
        $data['tipo_reportes'][]=['val' => 3, 'text' => 'Reporte por Sección', 'grupo' => [1,2]];
        $data['tipo_reportes'][]=['val' => 4, 'text' => 'Reporte Ciclo 3', 'grupo' => [1,2]];
        $data['tipo_reportes'][]=['val' => 5, 'text' => 'Reporte Análisis de quejas SAC ', 'grupo' => [1,2]];
        $data['tipo_reportes'][]=['val' => 6, 'text' => 'Reporte Proveedores', 'grupo' => [1,2]];
        $data['tipo_reportes'][]=['val' => 7, 'text' => 'Reporte Tipo Logística', 'grupo' => [3]];
        $data['tipo_reportes'][]=['val' => 8, 'text' => 'Reporte por Sección Logística', 'grupo' => [3]];
        $data['tipo_reportes'][]=['val' => 9, 'text' => 'Reporte SAC', 'grupo' => [4]];
        $data['tipo_reportes'][]=['val' => 10, 'text' => 'Reporte General', 'grupo' => [5]];
        #$data['tipo_reportes'][6]='Reporte Personalizado';
        
        #REPORTES JUMBO | SISA
        if($request->input('tipo_reporte') == 2){
            $data['reporte_data'] = $this->reporte_comercial($data['mes'],$data['ano'],$data['seccion']);
        }
        if($request->input('tipo_reporte') == 3){
            $data['reporte_data'] = $this->reporte_seccion($data['mes'],$data['ano'],$data['seccion']);
        }
        if($request->input('tipo_reporte') == 4){
            $data['reporte_data'] = $this->reporte_ciclo3($data['mes'],$data['ano']);
        }
        if($request->input('tipo_reporte') == 5){
            $data['reporte_data'] = $this->reporte_analisis_quejas_sac($data['mes'],$data['ano'],$data['seccion']);
        }
        if($request->input('tipo_reporte') == 6){
            $data['reporte_data'] = $this->reporte_proveedores($data['mes'],$data['ano']);
        }

        #REPORTES LOGISTICA
        if($request->input('tipo_reporte') == 7){
            $data['reporte_data'] = $this->reporte_logistica($data['mes'],$data['ano']);
        }
        if($request->input('tipo_reporte') == 8){
            $data['reporte_data'] = $this->reporte_logistica_seccion($data['mes'],$data['ano'],$data['seccion']);
        }
        #REPORTES SAC
        if($request->input('tipo_reporte') == 9){
            $data['reporte_data'] = $this->reporte_sac($data['mes'],$data['ano']);
        }

        #REPORTES MP
        if($request->input('tipo_reporte') == 10){
            $data['reporte_data'] = $this->reporte_mp_general($data['mes'],$data['ano'],$data['seccion']);
        }
        return view('reportes.reclamos.index',$data);
    }
    public function reporte_seccion($mes,$ano,$seccion)
    {
        $query = Reclamo::with('seccion','tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };

        /* $data = DB::connection('cencosud_old')->table('bd_productos_supermercado')
        ->join('reclamos_supermecados', 'bd_productos_supermercado.producto_ID', '=', 'reclamos_supermecados.producto_ID')
        ->select('bd_productos_supermercado.*', 'reclamos_supermecados.*, reclamos_supermecados.reclamo_ID AS id')
        ->where('reclamos_supermecados.reclamo_fecha','LIKE','%/'.$mes.'/'.$ano.'%')
        ->get(); */
        $data = $query->get();
        return $data;
    }
    public function reporte_seccion_excel(Request $request)
    {
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Reclamo::with('seccion','tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data['reporte_data'] = $query->get();

        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('seccion', $data), 'nombre_archivo1.xlsx');
        /*return Excel::download(function() use ($data) {
            return view('reportes.excel.seccions', compact('data'));
        }, 'nombre_archivo.xlsx');*/
    }
    public function reporte_comercial($mes,$ano,$seccion)
    {
        $query = Reclamo::has('reclamos_local_problema')->with('seccion','reclamos_local_problema.responsable', 'reclamos_local_problema.tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        #$query = Reclamo::with('seccion','tienda','reclamos_local_problema')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        
        $data = $query->get();

        return $data;
    }
    public function reporte_comercial_excel(Request $request)
    {
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Reclamo::has('reclamos_local_problema')->with('seccion','reclamos_local_problema.responsable', 'reclamos_local_problema.tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        #$query = Reclamo::with('seccion','tienda','reclamos_local_problema')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data['reporte_data'] = $query->get();

        return Excel::download(new ExcelExport('comercial', $data), 'nombre_archivo1.xlsx');
       
    }
    public function reporte_ciclo3($mes,$ano)
    {   
        $proveedoresCiclo3 = Proveedor::where('ciclo3', 'SI')->pluck('id');
        $query = Reclamo::with('tienda')->whereIn('id_proveedor', $proveedoresCiclo3)->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')->get();
        $data = $query;        
        return $data;
    }
    public function reporte_ciclo3_excel(Request $request)
    {   
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $proveedoresCiclo3 = Proveedor::where('ciclo3', 'SI')->pluck('id');
        $query = Reclamo::with('tienda')->whereIn('id_proveedor', $proveedoresCiclo3)->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')->get();
        
        $data['reporte_data'] = $query;

        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('ciclo3', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_analisis_quejas_sac($mes,$ano,$seccion)
    {
        $query = Reclamo::with('responsable','responsable_cerrado','tienda','origen_reclamo','seccion')->where('interno_externo', 'Externo')
            ->where(function ($query) {
                $query->where('status', 'CERRADO')
                    ->orWhere(function ($query) {
                        $query->where('status', 'PROCESO')
                            ->where('caso_atento', 'SI');
                    });
            })
            ->where('reclamo_fecha', 'LIKE', '%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        
        $data = $query->get();
        return $data;
    }
    public function reporte_analisis_quejas_sac_excel(Request $request)
    {   
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Reclamo::with('responsable','responsable_cerrado','tienda','origen_reclamo','seccion')->where('interno_externo', 'Externo')
            ->where(function ($query) {
                $query->where('status', 'CERRADO')
                    ->orWhere(function ($query) {
                        $query->where('status', 'PROCESO')
                            ->where('caso_atento', 'SI');
                    });
            })
            ->where('reclamo_fecha', 'LIKE', '%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data['reporte_data'] = $query->get();
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('analisis-quejas-sac', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_proveedores($mes,$ano)
    {   
        #$proveedores = Proveedor::where('ciclo3', 'SI')->pluck('id');
        #$query = Proveedor::withCount('reclamos')->get()->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')->get();
        $query = Proveedor::has('reclamos')->withCount(['reclamos' => function ($query) use ($ano,$mes) {
            $query->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        }])->get();
        $data = $query;
        return $data;
    }
    public function reporte_proveedores_excel(Request $request)
    {   
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
       
        $query = Proveedor::has('reclamos')->withCount(['reclamos' => function ($query) use ($ano,$mes) {
            $query->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        }])->get();
        $data['reporte_data'] = $query;
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('proveedores', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_logistica($mes,$ano)
    {   
        #$proveedores = Proveedor::where('ciclo3', 'SI')->pluck('id');
        #$query = Proveedor::withCount('reclamos')->get()->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')->get();
        $query = Reclamo::with('responsable','tienda')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('despacho','Centralizado')
                            ->get();
        $data = $query;
        return $data;
    }
    public function reporte_logistica_excel(Request $request)
    {   
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
       
        $query = Reclamo::with('responsable','tienda')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('despacho','Centralizado')
                            ->get();
        $data['reporte_data'] = $query;
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('logistica', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_logistica_seccion($mes,$ano,$seccion)
    {
        $query = Reclamo::with('seccion','tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data = $query->get();
        return $data;
    }
    public function reporte_logistica_seccion_excel(Request $request)
    {
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Reclamo::with('seccion','tienda')->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data['reporte_data'] = $query->get();

        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('logistica-seccion', $data), 'nombre_archivo1.xlsx');
        /*return Excel::download(function() use ($data) {
            return view('reportes.excel.seccions', compact('data'));
        }, 'nombre_archivo.xlsx');*/
    }
    public function reporte_sac($mes,$ano)
    {   
        #$proveedores = Proveedor::where('ciclo3', 'SI')->pluck('id');
        #$query = Proveedor::withCount('reclamos')->get()->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')->get();
       $query_jumbo = Reclamo::with('tienda','origen_reclamo','seccion')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('interno_externo','Externo')
                            ->where('caso_atento','SI')
                            ->where('categoria','JUMBO')
                            ->get();
        $query_sisa = Reclamo::with('tienda','origen_reclamo','seccion')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('interno_externo','Externo')
                            ->where('caso_atento','SI')
                            ->where('categoria','SISA')
                            ->get();
        $data['jumbo'] = $query_jumbo;
        $data['sisa'] = $query_sisa;
        return $data;
    }
    public function reporte_sac_excel(Request $request)
    {   
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $tipo_excel = $request->input('tipo_excel');
        $query = [];
        if($tipo_excel == 1){
            $query = Reclamo::with('tienda','origen_reclamo','seccion')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('interno_externo','Externo')
                            ->where('caso_atento','SI')
                            ->where('categoria','JUMBO')
                            ->get();
        }
        if($tipo_excel == 2){
            $query = Reclamo::with('tienda','origen_reclamo','seccion')
                            ->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%')
                            ->where('interno_externo','Externo')
                            ->where('caso_atento','SI')
                            ->where('categoria','SISA')
                            ->get();
        }
        $data['reporte_data'] = $query;
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('sac', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_mp_general($mes,$ano,$seccion)
    {
        $query = Reclamo::with('seccion','tienda')->whereHas('producto', function ($query) {
            $query->where('mp', 1);
        })->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data = $query->get();
        return $data;
    }
    public function reporte_mp_general_excel(Request $request)
    {
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Reclamo::with('seccion','tienda')->whereHas('producto', function ($query) {
            $query->where('mp', 1);
        })->where('reclamo_fecha','LIKE','%'.$ano.'-'.$mes.'%');
        if(!empty($seccion)){
            $query->where('id_seccion',$seccion);
        };
        $data['reporte_data'] = $query->get();
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('mp-general', $data), 'nombre_archivo1.xlsx');
    }
    public function recalls(Request $request)
    {
        $data['mes'] = (!empty($request->input('mes'))) ? $request->input('mes') : date('m');
		$data['ano'] = (!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
        $data['area_reporte']= $request->input('area_reporte');
        $data['tipo_reporte']= $request->input('tipo_reporte');
        $data['seccion']= $request->input('seccion');
        $data['secciones'] = Seccion::orderBy('nombre')->get();

       #$data['area_reportes'][1]='Todos (Jumbo/SISA)';
        $data['area_reportes'][]=['val' => 1, 'text' => 'Jumbo'];
        $data['area_reportes'][]=['val' => 2, 'text' => 'SISA'];
        $data['area_reportes'][]=['val' => 3, 'text' => 'Logística'];
        $data['area_reportes'][]=['val' => 4, 'text' => 'Servicio al Cliente'];
        $data['area_reportes'][]=['val' => 5, 'text' => 'MP'];

        #$data['tipo_reportes'][]=['val' => 1, 'text' => 'Reporte General', 'grupo' => [1,2,3,4]];
        $data['tipo_reportes'][]=['val' => 2, 'text' => 'Reporte Respuesta de Recall', 'grupo' => [1,2,3]];
        $data['tipo_reportes'][]=['val' => 3, 'text' => 'Reporte Comercial', 'grupo' => [1,2,3]];

        if($request->input('tipo_reporte') == 2){
            $data['reporte_data'] = $this->reporte_respuesta_recall($data['mes'],$data['ano']);
        }
        if($request->input('tipo_reporte') == 3){
            $data['reporte_data'] = $this->reporte_comercial_recall($data['mes'],$data['ano']);
        }

        return view('reportes.recalls.index',$data);
    }
    public function reporte_respuesta_recall($mes,$ano)
    {
        $query = Recall::with('respuesta_recall')->where('cadena' , '!=' , 'NINGUNA')->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->get();
        foreach ($query as $key => $value) {
            $productosIds = json_decode($value['productos'],true);
            $productos = Producto::whereIn('id', $productosIds)->get();
            $productos_q[$value['id']] = $productos;
            if($value['cadena'] == 'JUMBO' || $value['cadena'] == 'SISA'){
                $tiendas = Tienda::where('area', $value['cadena'])->count();
            }
            if($value['cadena'] == 'AMBAS'){
                $tiendas = Tienda::where('area', 'JUMBO')
                            ->orWhere('area', 'SISA')
                            ->count();
            }
            foreach ($productosIds as $k => $v) {
                $producto_ID = $v;
                $local_cp=0;
                $local_sp=0;
                foreach ($value['respuesta_recall'] as $z => $x) {
                    $cantidad_unidad = json_decode($x['cantidad_unidad'],TRUE);
                    if($cantidad_unidad[$producto_ID] > 0 ){
                        $local_cp++;
                    }else{
                        $local_sp++;
                    }
                }
                $local_sr_producto=$tiendas-($local_cp+$local_sp);
                $datos_productos[$value['id']][$v] = ['local_cp' => $local_cp, 'local_sp' => $local_sp, 'local_sr_producto' => $local_sr_producto];
            }
            
        }
        $data['recalls'] = $query;
        $data['productos'] = $productos_q;
        $data['datos_productos'] = $datos_productos;
        #$data = #$query;
        return $data;
    }
    public function reporte_respuesta_recall_excel(Request $request)
    {
        $mes = (!empty($request->input('mes_excel'))) ? $request->input('mes_excel') : date('m');
        $ano = (!empty($request->input('ano_excel'))) ? $request->input('ano_excel') : date('Y');
        $seccion = $request->input('seccion_excel');
        $query = Recall::with('respuesta_recall')->where('cadena' , '!=' , 'NINGUNA')->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->get();
        foreach ($query as $key => $value) {
            $productosIds = json_decode($value['productos'],true);
            $productos = Producto::whereIn('id', $productosIds)->get();
            $productos_q[$value['id']] = $productos;
            if($value['cadena'] == 'JUMBO' || $value['cadena'] == 'SISA'){
                $tiendas = Tienda::where('area', $value['cadena'])->count();
            }
            if($value['cadena'] == 'AMBAS'){
                $tiendas = Tienda::where('area', 'JUMBO')
                            ->orWhere('area', 'SISA')
                            ->count();
            }
            foreach ($productosIds as $k => $v) {
                $producto_ID = $v;
                $local_cp=0;
                $local_sp=0;
                foreach ($value['respuesta_recall'] as $z => $x) {
                    $cantidad_unidad = json_decode($x['cantidad_unidad'],TRUE);
                    if($cantidad_unidad[$producto_ID] > 0 ){
                        $local_cp++;
                    }else{
                        $local_sp++;
                    }
                }
                $local_sr_producto=$tiendas-($local_cp+$local_sp);
                $datos_productos[$value['id']][$v] = ['local_cp' => $local_cp, 'local_sp' => $local_sp, 'local_sr_producto' => $local_sr_producto];
            }
            
        }
        $data['reporte_data'] = $query;
        $data['productos'] = $productos_q;
        $data['datos_productos'] = $datos_productos;
        #$data = #$query;
        #$data['reporte_data'] = $query;
        #$data = []; // Datos para la plantilla 1
        return Excel::download(new ExcelExport('respuesta-recall', $data), 'nombre_archivo1.xlsx');
    }
    public function reporte_comercial_recall($mes,$ano)
    {
        $query = Recall::with('respuesta_recall')->where('cadena' , '!=' , 'NINGUNA')->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->get();
        $data['n_recall_proceso'] = Recall::where('status','PROCESO')->where('cadena' , '!=' , 'NINGUNA')->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->count();
        $data['n_recall_cerrado'] = Recall::where('status','CERRADO')->where('cadena' , '!=' , 'NINGUNA')->where('momento_ingreso','LIKE','%'.$ano.'-'.$mes.'%')->count();
        foreach ($query as $key => $value) {
            $productosIds = json_decode($value['productos'],true);
            $productos = Producto::with('seccion')->whereIn('id', $productosIds)->get();
            
            $productos_q[$value['id']] = $productos;
            if($value['cadena'] == 'JUMBO' || $value['cadena'] == 'SISA'){
                $tiendas = Tienda::where('area', $value['cadena'])->count();
            }
            if($value['cadena'] == 'AMBAS'){
                $tiendas = Tienda::where('area', 'JUMBO')
                            ->orWhere('area', 'SISA')
                            ->count();
            }
            foreach ($productosIds as $k => $v) {
                $producto_ID = $v;
                $local_cp=0;
                $local_sp=0;
                foreach ($value['respuesta_recall'] as $z => $x) {
                    $cantidad_unidad = json_decode($x['cantidad_unidad'],TRUE);
                    if($cantidad_unidad[$producto_ID] > 0 ){
                        $local_cp++;
                    }else{
                        $local_sp++;
                    }
                }
                $local_sr_producto=$tiendas-($local_cp+$local_sp);
                $datos_productos[$value['id']][$v] = ['local_cp' => $local_cp, 'local_sp' => $local_sp, 'local_sr_producto' => $local_sr_producto];
            }
            
        }
        $data['recalls'] = $query;
        $data['productos'] = $productos_q;
        $data['datos_productos'] = $datos_productos;
        return $data;
    }
    public function reporte_comercial_recall_excel(Request $request)
    {
        $data = NULL;
        return Excel::download(new ExcelExport('comercial', $data), 'nombre_archivo1.xlsx');
       
    }
    public function reporte_comercial_recall_detalle($id)
    {
        /* 
            $query = Recall::with('respuesta_recall')->find($id);
            $data['id_recall'] = $id;
            #foreach ($query as $key => $value) {
                $productosIds = json_decode($query->productos,true);
                $productos = Producto::with('seccion')->whereIn('id', $productosIds)->get();
                
                $productos_q = $productos;
                if($query->cadena == 'JUMBO' || $query->cadena == 'SISA'){
                    $tiendas = Tienda::where('area', $query->cadena)->count();
                }
                if($query->cadena == 'AMBAS'){
                    $tiendas = Tienda::where('area', 'JUMBO')
                                ->orWhere('area', 'SISA')
                                ->count();
                }
                foreach ($productosIds as $k => $v) {
                    $producto_ID = $v;
                    $local_cp=0;
                    $local_sp=0;
                    foreach ($query->respuesta_recall as $z => $x) {
                        $cantidad_unidad = json_decode($x['cantidad_unidad'],TRUE);
                        if($cantidad_unidad[$producto_ID] > 0 ){
                            $local_cp++;
                        }else{
                            $local_sp++;
                        }
                    }
                    $local_sr_producto=$tiendas-($local_cp+$local_sp);
                    $datos_productos[$v] = ['local_cp' => $local_cp, 'local_sp' => $local_sp, 'local_sr_producto' => $local_sr_producto];
                }
                
            #}
            $data['recalls'] = $query;
            $data['productos'] = $productos_q;
            $data['datos_productos'] = $datos_productos; 
        */
        $recall = Recall::findOrFail($id);
		$responsable = User::findOrFail($recall->id_responsable);
		$ids = json_decode($recall->productos, TRUE);
		$productos = Producto::whereIn('id', $ids)->get();
		$fecha_recall = $recall->created_at;
		if ($recall->cadena == 'AMBAS') {
			$tiendas = Tienda::where('area', 'JUMBO')->orWhere('area', 'SISA')->where('status', 1)->where('show', 1)->orWhere(function ($query) use ($fecha_recall) {
				$query->where('status', 2)->where('fecha_eliminado', '>', $fecha_recall);
			})->orderBy('zona', 'asc')->orderBy('nombre', 'asc')->get();
		} else if ($recall->cadena == 'JUMBO' || $recall->cadena == 'SISA') {
			$tiendas = Tienda::where('area', $recall->cadena)->where('status', 1)->where('show', 1)->orWhere(function ($query) use ($fecha_recall) {
				$query->where('status', 2)->where('fecha_eliminado', '>=', $fecha_recall);
			})->orderBy('zona', 'asc')->orderBy('nombre', 'asc')->get();
		} else {
			$tiendas = [];
		}
		$respuesta_local = [];
		foreach ($tiendas as $tienda) {
			$respuesta_local_q = RecallRespuesta::where('id_recall', $recall->id)->where('id_local', $tienda->id)->orderBy('id', 'desc')->first();			
			if (!empty($respuesta_local_q)) {
				$respuesta_local[$tienda->id] = [];
				$fecha_respuesta = explode(' ', $respuesta_local_q->created_at);
				$cumple_tiempo = (strtotime($respuesta_local_q->created_at) > strtotime($recall->momento_ingreso)) ? 'N/C' : 'C';
				$respuesta_local[$tienda->id] = ['id' => $respuesta_local_q->id,'cumple_tiempo' => $cumple_tiempo, 'responsable' => $respuesta_local_q->responsable, 'fecha_respuesta' => $fecha_respuesta[0], 'hora_respuesta' => $fecha_respuesta[1], 'cantidad' => json_decode($respuesta_local_q->cantidad_unidad, TRUE), 'medio_retiro' => json_decode($respuesta_local_q->tipo_unidad, TRUE)];
			}
		}
		$lote_array = json_decode($recall->lote, TRUE);
		$fecha_array = json_decode($recall->fecha, TRUE);
		$fecha_vencimiento_array = json_decode($recall->fecha_vencimiento, TRUE);

		$data = ['breadcrumb' => 'Recall Proceso', 'recall' => $recall, 'responsable' => $responsable, 'productos' => $productos, 'lote' => $lote_array, 'fecha' => $fecha_array, 'fecha_vencimiento' => $fecha_vencimiento_array, 'tiendas' => $tiendas, 'respuesta_local' => $respuesta_local];
        return view('reportes.recalls.comercial-recall-detalle',$data);
    }
    public function rechazos()
    {

    }
}