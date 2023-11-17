<?php

namespace App\Http\Controllers;

use App\Models\Rechazo;
use App\Models\RechazoProducto;
use App\Models\Reclamo;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tienda;
use App\Models\Seccion;
use App\Models\User;
use App\Models\OrigenesReclamos;
use App\Models\ProveedorSeccion;
use App\Models\MotivoRechazo;
use App\Models\TiendaMesSinRechazo;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RechazosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rechazo()
    {

        #BUSCAR PRODUCTOS

            $nombreProd=request()->input('nombreProd');
            $eanProd=request()->input('eanProd');
            $sapProd=request()->input('sapProd');
            $productos = NULL;
            if(!empty($nombreProd) || !empty($eanProd) || !empty($sapProd)){
                $productos = Producto::where('nombre', 'LIKE', "%$nombreProd%")
                                        ->where('ean', 'LIKE', "%$eanProd%")
                                        ->where('sap', 'LIKE', "%$sapProd%")
                                        ->where('id_proveedor', '>', 0)
                                        ->get();
            }
            $nombreProv=request()->input('nombreProv');
            $rutProv=request()->input('rutProv');
            $proveedores = NULL;
            if(!empty($nombreProv) || !empty($rutProv)){
                $proveedores = Proveedor::where('nombre', 'LIKE', "%$nombreProv%")
                                        ->where('rut', 'LIKE', "%$rutProv%")
                                        ->get();
            }

        $data = ['breadcrumb' => 'Nuevo Rechazo' , 'productos' => $productos, 'proveedores' => $proveedores , 'request' => request()->input()];
        return view('rechazos.pre-rechazo',$data);
        
        #return to_route('nombre_ruta');
    }
    public function rechazo_nuevo(Request $request,$id_proveedor,$id_producto = NULL)
    {
        #$producto = Producto::findOrFail($id);
        
        $proveedor = Proveedor::with('productos.seccion')->findOrFail($id_proveedor);
        $productos = Producto::where('id_proveedor',$id_proveedor)->where('productos.status', 1)
                                                                    ->join('secciones', 'productos.id_seccion', '=', 'secciones.codigo')
                                                                    ->select('productos.*', 'secciones.nombre AS nombre_seccion')
                                                                    ->get();
        $secciones=$proveedor->productos->pluck('seccion')->unique();#Seccion::where('id_proveedor', $id_proveedor)->join('proveedores_secciones', 'secciones.codigo', '=', 'proveedores_secciones.codigo_seccion')->get();
        #dd($secciones);
        $motivos_rechazos = MotivoRechazo::where('status', 1)->get();
        foreach ($secciones as $key => $value) {
            $secciones_q[]=$value['codigo'];
        }
        $seccion_producto=[];
        if(!empty($id_producto)){
            $producto_q = Producto::findOrFail($id_producto);
            $seccion_producto[] = $producto_q->id_seccion;
        }
        $data = ['breadcrumb' => 'Nuevo Rechazo' , 'proveedor' => $proveedor , 'productos' => $productos , 'secciones' => $secciones , 'request' => request()->input() , 'id_producto' => $id_producto , 'seccion_producto' => $seccion_producto , 'secciones_q' => $secciones_q ,'motivos_rechazos' => $motivos_rechazos];
        return view('rechazos.nuevo-rechazo',$data);
    }
    public function guardar_rechazo(Request $request,$id=0)
    {
        $request->validate([
            'producto' => 'required|array|min:1', // Validación del campo 'nombres'
            'secciones_rechazo' => 'required|array|min:1',
        ]);

        $producto=request()->input('producto');
        $seccion_producto=request()->input('seccion_producto');       
        
        $cant_cajas=(!empty(request()->input('cant_cajas'))) ? request()->input('cant_cajas') : [];
        $un_cant_cajas=(!empty(request()->input('un_cant_cajas'))) ? request()->input('un_cant_cajas') : [];
        $cant_cajas_rechz=(!empty(request()->input('cant_cajas_rechz'))) ? request()->input('cant_cajas_rechz') : [];
        $un_cant_cajas_rechz=(!empty(request()->input('un_cant_cajas_rechz'))) ? request()->input('un_cant_cajas_rechz') : [];
        $cant_cajas_solicitadas=(!empty(request()->input('cant_cajas_solicitadas'))) ? request()->input('cant_cajas_solicitadas') : [];
        $cant_cajas_entregadas=(!empty(request()->input('cant_cajas_entregadas'))) ? request()->input('cant_cajas_entregadas') : [];
        $num_fact=(!empty(request()->input('num_fact'))) ? request()->input('num_fact') : [];
        $fecha_elab=(!empty(request()->input('fecha_elab'))) ? request()->input('fecha_elab') : [];
        $fecha_venc=(!empty(request()->input('fecha_venc'))) ? request()->input('fecha_venc') : [];
        $causa_rechazo=(!empty(request()->input('causa_rechazo'))) ? request()->input('causa_rechazo') : [];
        $folio_rechazo=(!empty(request()->input('folio_rechazo'))) ? request()->input('folio_rechazo') : [];
        $especificaciones=(!empty(request()->input('especificaciones'))) ? request()->input('especificaciones') : [];
        $orden_compra_entrega=(!empty(request()->input('orden_compra_entrega'))) ? request()->input('orden_compra_entrega') : [];
        $fotos_prod_rechz=(!empty(request()->file('fotos_prod_rechz'))) ? request()->file('fotos_prod_rechz') : [];
        
        $rechazo_data=[
            'fecha_inicio' => request()->input('fecha_inicio'),
            'tipo_rechazo' => request()->input('tipo_rechazo'),
            'motivo_total' => request()->input('motivo_total'),
            'estado_carga' => request()->input('estado_carga'),
            'auto_especial' => request()->input('auto_especial'),
            'seccion' => json_encode(request()->input('secciones_rechazo')),
            'auto_responsable' => request()->input('auto_responsable'),
            'auto_motivo' => request()->input('auto_motivo'),
            'obs_rechazo' => request()->input('obs_rechazo'),            
        ];
        if($id == 0){
            $rechazo_data['id_responsable'] = Auth::user()->id;
            $rechazo_data['id_proveedor'] = request()->input('id_proveedor');
            $rechazo_data['status'] = (request()->input('tipo_rechazo') == 'Total') ? 'CERRADO' : 'PROCESO';
            $rechazo_data['id_usuario'] = Auth::user()->id;
            $rechazo_data['categoria'] = (session('u_tienda_zona') == 'BODEGAS') ? 'logistica' : session('u_area');
            $rechazo_data['tipo_tienda'] = (session('u_tienda_zona') == 'BODEGAS') ? 'BODEGAS' : NULL;
            $rechazo = Rechazo::create($rechazo_data);
            $id = $rechazo->id;
        }else{
            if(request()->input('action') == 1){
                $rechazo_data['id_responsable'] = Auth::user()->id;
            }
            $rechazo_data['status'] = request()->input('status');
            $rechazo=Rechazo::find($id);
            $rechazo->update($rechazo_data);
        }
        RechazoProducto::where('id_rechazo',$id)->delete();
        $allowedTypes = app('filetypes')['image'];
        foreach ($producto as $key => $value) {
            $fotos_prod_array[$value]=[];
            if(!empty($fotos_prod_rechz[$value])){
               foreach ($fotos_prod_rechz[$value] as $foto) {
                    if (!$foto->extension() || !in_array($foto->extension(), $allowedTypes)) {
                        #return response()->json(['error' => 'Archivo inválido.'], 400);
                    }else{
                        $name=$id.'_'.$value.'_'.date('YmdHis').rand(0,1000).'.'.$foto->extension();
                        $foto->storeAs('',$name,'rechazos');
                        $fotos_prod_array[$value][]=[
                            'name' => $name,
                            'extension' => $foto->extension(),
                        ];
                    }
                } 
            }
            
            $rechazo_producto_data=[
                'id_rechazo' => $id,
                'id_producto' => $value,
                'id_seccion' => $seccion_producto[$value],
                'cant_cajas' => (!empty($cant_cajas[$value])) ? $cant_cajas[$value] : NULL,
                'un_cant_cajas' => (!empty($un_cant_cajas[$value])) ? $un_cant_cajas[$value] : NULL,
                'cant_cajas_rechz' => (!empty($cant_cajas_rechz[$value])) ? $cant_cajas_rechz[$value] : NULL,
                'un_cant_cajas_rechz' => (!empty($un_cant_cajas_rechz[$value])) ? $un_cant_cajas_rechz[$value] : NULL,
                'cant_cajas_solicitadas' => (!empty($cant_cajas_solicitadas[$value])) ? $cant_cajas_solicitadas[$value] : NULL,
                'cant_cajas_entregadas' => (!empty($cant_cajas_entregadas[$value])) ? $cant_cajas_entregadas[$value] : NULL,
                'num_fact' => (!empty($num_fact[$value])) ? $num_fact[$value] : NULL,
                'fecha_elaboracion' => (!empty($fecha_elab[$value])) ? $fecha_elab[$value] : NULL,
                'fecha_vencimiento' => (!empty($fecha_venc[$value])) ? $fecha_venc[$value] : NULL,
                'causa_rechazo' => (!empty($causa_rechazo[$value])) ? $causa_rechazo[$value] : NULL,
                'folio_rechazo' => (!empty($folio_rechazo[$value])) ? $folio_rechazo[$value] : NULL,
                'especificaciones' => (!empty($especificaciones[$value])) ? $especificaciones[$value] : NULL,
                'orden_compra_entrega' => (!empty($orden_compra_entrega[$value])) ? $orden_compra_entrega[$value] : NULL,
                'fotos_prod_rechz' => (!empty($fotos_prod_array[$value])) ? json_encode($fotos_prod_array[$value]) : NULL,
            ];
            RechazoProducto::create($rechazo_producto_data);
        }

        if($rechazo->status == 'PROCESO'){
            return redirect()->route('procesoRechazo', ['id' => $id])->with('notification_type', 'success')->with('notification_message', 'Rechazo guardado correctamente!');
        }else{
            return redirect()->route('cerradoRechazo', ['id' => $id])->with('notification_type', 'success')->with('notification_message', 'Rechazo guardado correctamente!');
        }
    }
    public function rechazo_edit($id)
    {
        $data['rechazo'] = Rechazo::findOrFail($id);
        $data['productos_rechazo'] = RechazoProducto::where('id_rechazo',$id)->get();
        $data['proveedor'] = Proveedor::with('productos.seccion')->findOrFail($data['rechazo']->id_proveedor);#Proveedor::findOrFail($data['rechazo']->id_proveedor);
        $data['productos'] = Producto::where('id_proveedor',$data['rechazo']->id_proveedor)->where('productos.status', 1)
                                                                    ->join('secciones', 'productos.id_seccion', '=', 'secciones.codigo')
                                                                    ->select('productos.*', 'secciones.nombre AS nombre_seccion')
                                                                    ->get();
        $data['secciones']= $data['proveedor']->productos->pluck('seccion')->unique();#Seccion::join('proveedores_secciones', 'secciones.codigo', '=', 'proveedores_secciones.codigo_seccion')->where('proveedores_secciones.id_proveedor', $data['rechazo']->id_proveedor)->get();
        $data['motivos_rechazos'] = MotivoRechazo::where('status', 1)->get();
        $data['secciones_q']=[];
        foreach ($data['secciones'] as $key => $value) {
            $data['secciones_q'][]=$value['codigo'];
        }
        $data['id_producto'] = NULL;
        $data['seccion_producto']=[];
        if(!empty($data['productos_rechazo'])){
            foreach ($data['productos_rechazo'] as $producto_rechazo) {
                $data['seccion_producto'][] = $producto_rechazo->id_seccion;
                $data['id_producto'][] = $producto_rechazo->id_producto;
                $data['cant_cajas'][$producto_rechazo->id_producto]=$producto_rechazo->cant_cajas;
                $data['un_cant_cajas'][$producto_rechazo->id_producto]=$producto_rechazo->un_cant_cajas;
                $data['cant_cajas_rechz'][$producto_rechazo->id_producto]=$producto_rechazo->cant_cajas_rechz;
                $data['un_cant_cajas_rechz'][$producto_rechazo->id_producto]=$producto_rechazo->un_cant_cajas_rechz;
                $data['cant_cajas_solicitadas'][$producto_rechazo->id_producto]=$producto_rechazo->cant_cajas_solicitadas;
                $data['cant_cajas_entregadas'][$producto_rechazo->id_producto]=$producto_rechazo->cant_cajas_entregadas;
                $data['num_fact'][$producto_rechazo->id_producto]=$producto_rechazo->num_fact;
                $data['fecha_elab'][$producto_rechazo->id_producto]=$producto_rechazo->fecha_elaboracion;
                $data['fecha_venc'][$producto_rechazo->id_producto]=$producto_rechazo->fecha_vencimiento;
                $data['causa_rechazo'][$producto_rechazo->id_producto]=$producto_rechazo->causa_rechazo;
                $data['folio_rechazo'][$producto_rechazo->id_producto]=$producto_rechazo->folio_rechazo;
                $data['especificaciones'][$producto_rechazo->id_producto]=$producto_rechazo->especificaciones;
                $data['orden_compra_entrega'][$producto_rechazo->id_producto]=$producto_rechazo->orden_compra_entrega;
                $data['fotos_prod_rechz'][$producto_rechazo->id_producto]=$producto_rechazo->fotos_prod_rechz;
            }
            #$producto_q = Producto::findOrFail($id_producto);
            
        }
        return view('rechazos.proceso-rechazo',$data);
    }
    public function rechazos_proceso(Request $request)
    {
        $data=[];
        $data['mes']=(!empty($request->input('mes'))) ? $request->input('mes') : date('m');
        $data['ano']=(!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
       
        $data['mis_rechazos'] = Rechazo::join('proveedores', 'rechazos.id_proveedor', '=', 'proveedores.id')
                                        ->join('users', 'rechazos.id_responsable', '=', 'users.id')
                                        ->select('rechazos.*', 'proveedores.nombre as nombre_proveedor', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , Auth::user()->id)
                                        ->where('rechazos.status' , 'PROCESO')
                                        #->where('fecha_inicio' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        ->get();
        $data['rechazos'] = Rechazo::join('proveedores', 'rechazos.id_proveedor', '=', 'proveedores.id')
                                        ->join('users', 'rechazos.id_responsable', '!=', 'users.id')
                                        ->select('rechazos.*', 'proveedores.nombre as nombre_proveedor', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , Auth::user()->id)
                                        ->where('rechazos.status' , 'PROCESO')
                                        #->where('fecha_inicio' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        ->get();
        return view('rechazos.list-proceso-rechazo',$data);
    }
    public function rechazos_cerrado(Request $request)
    {
        $data=[];
        $data['mes']=(!empty($request->input('mes'))) ? $request->input('mes') : date('m');
        $data['ano']=(!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
       
        $data['mis_rechazos'] = Rechazo::join('proveedores', 'rechazos.id_proveedor', '=', 'proveedores.id')
                                        ->join('users', 'rechazos.id_responsable', '=', 'users.id')
                                        ->select('rechazos.*', 'proveedores.nombre as nombre_proveedor', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , Auth::user()->id)
                                        ->where('rechazos.status' , 'CERRADO')
                                        ->where('fecha_inicio' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        ->get();
        $data['rechazos'] = Rechazo::join('proveedores', 'rechazos.id_proveedor', '=', 'proveedores.id')
                                        ->join('users', 'rechazos.id_responsable', '!=', 'users.id')
                                        ->select('rechazos.*', 'proveedores.nombre as nombre_proveedor', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , Auth::user()->id)
                                        ->where('rechazos.status' , 'CERRADO')
                                        ->where('fecha_inicio' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        ->get();
        #$productos = Producto::where('nombre', 'LIKE', "%$nombreProd%")
                                        #->where('ean', 'LIKE', "%$eanProd%")
                                        #->where('sap', 'LIKE', "%$sapProd%")
                                        #->get();        
        return view('rechazos.list-cerrado-rechazo',$data);
    }
    public function mes_sin_rechazos()
    {
        $query = TiendaMesSinRechazo::where('id_tienda' , session('u_id_tienda'))->latest()->first();
        $data['mes_sin_rechazo']=(!empty($query->id)) ? $query : new TiendaMesSinRechazo;
        return view('rechazos.mes-sin-rechazo',$data);
        
        #return to_route('nombre_ruta');
    }
    public function guardar_mes_sin_rechazos(Request $request)
    {
        #$data['mes_sin_rechazo']=TiendaMesSinRechazo::where('id_tienda' , Auth::user()->id)->latest()->first();
        $respuesta_data=['id_responsable' => Auth::user()->id,'id_tienda' => session('u_id_tienda') ,'fecha_respuesta' => date('Y-m-d') ,'respuesta' => (empty(request()->input('respuesta')) ? 0 : request()->input('respuesta')) ];
        TiendaMesSinRechazo::create($respuesta_data);
        return redirect()->route('mesSinRechazo')->with('notification_type', 'success')->with('notification_message', 'Respuesta guardada correctamente!');        
        
        #return to_route('nombre_ruta');
    }

}