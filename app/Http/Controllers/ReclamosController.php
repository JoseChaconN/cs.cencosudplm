<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tienda;
use App\Models\Seccion;
use App\Models\User;
use App\Models\OrigenesReclamos;
use App\Models\ReclamoLocalProblema;
use App\Models\Frigorifico;
use App\Models\FrigorificoRazonSocial;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;




use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Exports\RespuestasReclamoExport;
use App\Notifications\ReclamosRespuestasNotification;
use Maatwebsite\Excel\Facades\Excel;

class ReclamosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        #$this->middleware('role:admin|administrador|tecnologo')->except('reclamo','reclamo_nuevo','guardar_reclamo_nuevo','reclamo_PDF');
        #$this->middleware('role:admin|administrador|tecnologo|tienda')->except('reclamo_PDF');
    }

    /*public function index()
    {
        return view('reclamos.index');
    }*/
    public function reclamo()
    {

        #BUSCAR PRODUCTOS
        
            $nombreProd=request()->input('nombreProd');
            $eanProd=request()->input('eanProd');
            $sapProd=request()->input('sapProd');
            $productos = NULL;
            if(!empty($nombreProd) || !empty($eanProd) || !empty($sapProd)){
                $productos = Producto::where('productos.nombre', 'LIKE', "%$nombreProd%")
                                        ->where('ean', 'LIKE', "%$eanProd%")
                                        ->where('sap', 'LIKE', "%$sapProd%")
                                        ->where('id_proveedor', '>', 0)
                                        ->leftJoin('paises', 'productos.pais', '=', 'paises.code')
                                        ->select('productos.*','paises.nombre as nombre_pais')
                                        ->get();
            }

        $data = ['breadcrumb' => 'Nuevo Reclamo' , 'productos' => $productos , 'request' => request()->input()];
        return view('reclamos.pre-reclamo',$data);
        
        #return to_route('nombre_ruta');
    }
    public function reclamo_nuevo(Request $request)
    {
        $producto = Producto::findOrFail($request->input('id_producto'));
        $proveedor = Proveedor::findOrFail($producto->id_proveedor);
        $seccion = Seccion::where('codigo', $producto->id_seccion)->first();
        $origenes_reclamo = OrigenesReclamos::where('status', 1)->get();
        $tiendas = Tienda::where('status', 1)->get();
       
        ///SI EL PRODUCTO ES MP EL RECLAMO ES MP
        ///SI EL PRODUCTO NO ES MP PERO ES CENTRALIZADO EL RECLAMO ES LOGISTICA
        ///SI NO EL RECLAMO ES JUMBO/SISA
        $categoria='NO_DEFINIDA';
        $color_form = 'primary';
        if($producto->mp == 1){
            $categoria = 'PROPIA';
            $categoria_text='MARCAS PROPIAS';
        }elseif($request->input('despacho') == 'Centralizado'){
            $categoria = 'LOGISTICA';
            $categoria_text = $categoria;
            $color_form = 'info';
        }else{
            $categoria = session('u_area_tienda');
            $categoria_text = session('u_area_tienda');
            if(session('u_area_tienda') == 'JUMBO'){
                $color_form = 'success';
            }else if(session('u_area_tienda') == 'SISA'){
                $color_form = 'danger';
            }else if(session('u_area_tienda') == 'SPID'){
                $color_form = 'danger';
            }
        }
        
        $data = ['color_form' => $color_form,'breadcrumb' => 'Nuevo Reclamo' , 'producto' => $producto , 'proveedor' => $proveedor ,'seccion' => $seccion , 'origenes_reclamo' => $origenes_reclamo, 'request' => $request->input() , 'categoria' => $categoria , 'categoria_text' => $categoria_text , 'tiendas' => $tiendas];
        return view('reclamos.nuevo-reclamo',$data);
    }
    public function guardar_reclamo_nuevo(Request $request)
    {
        #$reclamo = new Reclamo;

        /*$validatedData = $request->validate([
            'fecha_local' => 'required',            
        ]);
        return redirect()->route('crearReclamo')
                     ->withErrors(['msg' => 'Hubo un error al registrar al usuario'])
                     ->withInput();*/
        /** @var \App\Models\User */
        $user = Auth::user();
        $status = $user->hasRole('tienda') ? 'APROBAR' :'PROCESO';
        $reclamoNuevo = Reclamo::create([
            'status' => $status,
            'categoria' => $request->input('categoria'),
            'id_responsable' => Auth::user()->id,#VARIABLE DE SESION DEL USUARIO
            'id_local' => session('u_id_tienda'),#VARIABLE DE SESION DEL USUARIO
            'id_producto' => $request->input('id_producto'),
            'nombre_producto' => $request->input('nombre_producto'),
            'ean_producto' => $request->input('ean_producto'),
            'sap_producto' => $request->input('sap_producto'),
            'marca_producto' => $request->input('marca_producto'),
            'id_seccion' => $request->input('id_seccion'),
            'id_proveedor' => $request->input('id_proveedor'),
            'nombre_proveedor' => $request->input('nombre_proveedor'),
            'rut_proveedor' => $request->input('rut_proveedor'),
            'es_importado' => $request->input('es_importado'),
            'interno_externo' => $request->input('interno_externo'),
            'despacho' => $request->input('despacho'),
            'formal_informal' => $request->input('formal_informal'),
            'fecha_local' => $request->input('fecha_local'),
            'reclamo_fecha' => $request->input('fecha_local'),
            'formato' => $request->input('formato'),
            'cantidad_problema' => $request->input('cantidad_problema'),
            'unidad_cantidad_problema' => $request->input('unidad_cantidad_problema'),
            'comentario_cantidad_problema' => $request->input('comentario_cantidad_problema'),
            'lote' => $request->input('lote'),
            'elaboracion' => $request->input('elaboracion'),
            'vencimiento' => $request->input('vencimiento'),
            'aplica_temperatura' => $request->input('aplica_temperatura'),
            'recepcion' => $request->input('recepcion'),
            'camaras' => $request->input('camaras'),
            'vitrina' => $request->input('vitrina'),
            'aplica_carnes' => $request->input('aplica_carnes'),
            'frigorifico' => $request->input('frigorifico'),
            'fecha_faena' => $request->input('fecha_faena'),
            'cantidad_recibida' => $request->input('cantidad_recibida'),
            'descripcion_reclamo' => $request->input('descripcion_reclamo'),
            'observaciones_cliente' => $request->input('observaciones_cliente'),
            'motivo_reclamo' => $request->input('motivo_reclamo'),
            'tipo_reclamo' => $request->input('tipo_reclamo'),
            'origen_venta' => $request->input('origen_venta'),
            'origen_venta_tienda' => $request->input('origen_venta_tienda'),
            'origen' => $request->input('origen'),
            'aplica_cliente' => $request->input('aplica_cliente'),
            'nombre_cliente' => $request->input('nombre_cliente'),
            'telefono_cliente' => $request->input('telefono_cliente'),
            'direccion_cliente' => $request->input('direccion_cliente'),
            'rut_cliente' => str_replace('.','',$request->input('rut_cliente')),
            'sac' => session('u_sac'),
            'id_frigorifico' => $request->input('id_frigorifico'),
            'razon_social' => $request->input('razon_social'),
            'marca_frigorifico' => $request->input('marca_frigorifico'),
            'sif' => $request->input('sif'),
        ]);
        
        #ADJUNTOS CON SPATIE
        $documento_reclamo = $request->file('documento_reclamo');
        if(!empty($documento_reclamo)){
            foreach ($documento_reclamo as $doc) {
                if ($doc->isValid()) {
                    // Guarda la imagen en la librería de medios del producto
                    $reclamoNuevo->addMedia($doc)->toMediaCollection('documentos_reclamos');
                }
            }
        }
        $imagen_reclamo = $request->file('imagen_reclamo');
        if(!empty($imagen_reclamo)){
            foreach ($imagen_reclamo as $imagen) {
                if ($imagen->isValid()) {
                    // Guarda la imagen en la librería de medios del producto
                    $reclamoNuevo->addMedia($imagen)->toMediaCollection('imagenes_reclamos');
                }
            }
        }
        #$reclamoNuevo->update(['documento_adjunto' => json_encode($docs_prod_array) , 'imagen_adjunto' => json_encode($imagen_adjunto_array)]);
        #session()->flash('status','Reclamo guardado exitosamente');
        #SI EL RECLAMO VIENE DE USUARIO TIENDA SE DEBE GUARDAR COMO RECLAMO APROBAR Y DEB ENVIAR A UNA VISTA DIFERENTE
        #SI EL RECLAMO VIENE DE CUALQUIER USUARIO NO TIENDA DEBE ENVIAR LA VISTA DE RECLAMO EN PROCESO
        
        if($status == 'APROBAR'){
            return to_route('guardado')->with('status','¡Reclamo guardado correctamente!');
        }
        return redirect()->route('procesoReclamo', ['id' => $reclamoNuevo->id])->with('status', '¡Reclamo guardado correctamente!');
    }
    public function reclamos_proceso(Request $request)
    {
        $data=[];
        $data['mes']=(!empty($request->input('mes'))) ? $request->input('mes') : date('m');
        $data['ano']=(!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
        $data['tipoReclamo']=(!empty($request->input('tipoReclamo'))) ? $request->input('tipoReclamo') : '';
        
        $data['nombreProd'] = (!empty($request->input('nombreProd'))) ? $request->input('nombreProd') : '';
        $data['eanProd'] = (!empty($request->input('eanProd'))) ? $request->input('eanProd') : '';
        $data['sapProd'] = (!empty($request->input('sapProd'))) ? $request->input('sapProd') : '';

        $data['rutCliente'] = (!empty($request->input('rutCliente'))) ? $request->input('rutCliente') : '';
        $data['nomApeCliente'] = (!empty($request->input('nomApeCliente'))) ? $request->input('nomApeCliente') : '';
       
        $data['mis_reclamos'] = Reclamo::join('tiendas', 'reclamos.id_local', '=', 'tiendas.id')
                                        ->join('users', 'reclamos.id_responsable', '=', 'users.id')
                                        ->select('reclamos.*', 'tiendas.nombre as nombre_tienda', 'tiendas.codigo as codigo_tienda', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , Auth::user()->id)
                                        ->where('reclamos.status' , 'PROCESO')
                                        ->where('reclamo_fecha' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        #->where('interno_externo' , 'LIKE' , '%'.$data['tipoReclamo'].'%')
                                        #->where('nombre_producto' , 'LIKE' , '%'.$data['nombreProd'].'%')
                                        #->where('ean_producto' , 'LIKE' , '%'.$data['eanProd'].'%')
                                        #->where('sap_producto' , 'LIKE' , '%'.$data['sapProd'].'%')
                                        #->where('rut_cliente' , 'LIKE' , '%'.$data['rutCliente'].'%')
                                        #->where('nombre_cliente' , 'LIKE' , '%'.$data['nomApeCliente'].'%')
                                        ->get();
        $data['reclamos'] = Reclamo::join('tiendas', 'reclamos.id_local', '=', 'tiendas.id')
                                        ->join('users', 'reclamos.id_responsable', '=', 'users.id')
                                        ->select('reclamos.*', 'tiendas.nombre as nombre_tienda', 'tiendas.codigo as codigo_tienda', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('reclamos.status' , 'PROCESO')
                                        ->where('id_responsable' , '!=' ,  Auth::user()->id)
                                        ->where('reclamo_fecha' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        #->where('interno_externo' , 'LIKE' , '%'.$data['tipoReclamo'].'%')
                                        #->where('nombre_producto' , 'LIKE' , '%'.$data['nombreProd'].'%')
                                        #->where('ean_producto' , 'LIKE' , '%'.$data['eanProd'].'%')
                                        #->where('sap_producto' , 'LIKE' , '%'.$data['sapProd'].'%')
                                        #->where('rut_cliente' , 'LIKE' , '%'.$data['rutCliente'].'%')
                                        #->where('nombre_cliente' , 'LIKE' , '%'.$data['nomApeCliente'].'%')
                                        ->get();
        #$productos = Producto::where('nombre', 'LIKE', "%$nombreProd%")
                                        #->where('ean', 'LIKE', "%$eanProd%")
                                        #->where('sap', 'LIKE', "%$sapProd%")
                                        #->get();
        return view('reclamos.list-proceso-reclamo',$data);
    }
    public function reclamos_cerrado(Request $request)
    {
        $data=[];
        $data=[];
        $data['mes']=(!empty($request->input('mes'))) ? $request->input('mes') : date('m');
        $data['ano']=(!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
        $data['tipoReclamo']=(!empty($request->input('tipoReclamo'))) ? $request->input('tipoReclamo') : '';
        
        $data['nombreProd'] = (!empty($request->input('nombreProd'))) ? $request->input('nombreProd') : '';
        $data['eanProd'] = (!empty($request->input('eanProd'))) ? $request->input('eanProd') : '';
        $data['sapProd'] = (!empty($request->input('sapProd'))) ? $request->input('sapProd') : '';

        $data['rutCliente'] = (!empty($request->input('rutCliente'))) ? $request->input('rutCliente') : '';
        $data['nomApeCliente'] = (!empty($request->input('nomApeCliente'))) ? $request->input('nomApeCliente') : '';
       
        $data['mis_reclamos'] = Reclamo::join('tiendas', 'reclamos.id_local', '=', 'tiendas.id')
                                        ->join('users', 'reclamos.id_responsable', '=', 'users.id')
                                        ->select('reclamos.*', 'tiendas.nombre as nombre_tienda', 'tiendas.codigo as codigo_tienda', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' ,  Auth::user()->id)
                                        ->where('reclamos.status' , 'CERRADO')
                                        ->where('fecha_local' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        #->where('interno_externo' , 'LIKE' , '%'.$data['tipoReclamo'].'%')
                                        #->where('nombre_producto' , 'LIKE' , '%'.$data['nombreProd'].'%')
                                        #->where('ean_producto' , 'LIKE' , '%'.$data['eanProd'].'%')
                                        #->where('sap_producto' , 'LIKE' , '%'.$data['sapProd'].'%')
                                        #->where('rut_cliente' , 'LIKE' , '%'.$data['rutCliente'].'%')
                                        #->where('nombre_cliente' , 'LIKE' , '%'.$data['nomApeCliente'].'%')
                                        ->get();
        $data['reclamos'] = Reclamo::join('tiendas', 'reclamos.id_local', '=', 'tiendas.id')
                                        ->join('users', 'reclamos.id_responsable', '=', 'users.id')
                                        ->select('reclamos.*', 'tiendas.nombre as nombre_tienda', 'tiendas.codigo as codigo_tienda', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('id_responsable' , '!=' ,  Auth::user()->id)
                                        ->where('reclamos.status' , 'CERRADO')
                                        ->where('fecha_local' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        #->where('interno_externo' , 'LIKE' , '%'.$data['tipoReclamo'].'%')
                                        #->where('nombre_producto' , 'LIKE' , '%'.$data['nombreProd'].'%')
                                        #->where('ean_producto' , 'LIKE' , '%'.$data['eanProd'].'%')
                                        #->where('sap_producto' , 'LIKE' , '%'.$data['sapProd'].'%')
                                        #->where('rut_cliente' , 'LIKE' , '%'.$data['rutCliente'].'%')
                                        #->where('nombre_cliente' , 'LIKE' , '%'.$data['nomApeCliente'].'%')
                                        ->get();
        return view('reclamos.list-cerrado-reclamo',$data);
    }
    public function reclamos_aprobar(Request $request)
    {
        $data=[];
        /*$data['reclamos'] = Reclamo::join('tiendas', 'reclamos.id_local', '=', 'tiendas.id')
                                        ->join('users', 'reclamos.id_responsable', '=', 'users.id')
                                        ->select('reclamos.*', 'tiendas.nombre as nombre_tienda', 'tiendas.codigo as codigo_tienda', 'users.name as nombre_usuario', 'users.last_name as apellido_usuario')
                                        ->where('reclamos.status' , 'PROCESO')
                                        ->where('id_responsable' , '!=' ,  Auth::user()->id)
                                        ->where('fecha_local' , 'LIKE' , $data['ano'].'-'.$data['mes'].'%')
                                        #->where('interno_externo' , 'LIKE' , '%'.$data['tipoReclamo'].'%')
                                        #->where('nombre_producto' , 'LIKE' , '%'.$data['nombreProd'].'%')
                                        #->where('ean_producto' , 'LIKE' , '%'.$data['eanProd'].'%')
                                        #->where('sap_producto' , 'LIKE' , '%'.$data['sapProd'].'%')
                                        #->where('rut_cliente' , 'LIKE' , '%'.$data['rutCliente'].'%')
                                        #->where('nombre_cliente' , 'LIKE' , '%'.$data['nomApeCliente'].'%')
                                        ->get();*/
        $reclamos = Reclamo::with('tienda','responsable')->where('reclamos.status' , 'APROBAR')->whereIn('id_local',session('u_tiendas_sup'))->get();
        $data['reclamos'] = $reclamos;
        
        return view('reclamos.list-aprobar-reclamo',$data);
    }
    public function reclamo_proceso($id)
    {
        $reclamo = Reclamo::findOrFail($id);
        $frigorifico = (!empty($reclamo->id_frigorifico)) ? Frigorifico::find($reclamo->id_frigorifico) : [];
        $razon_social_frigo = (!empty($reclamo->razon_social)) ? FrigorificoRazonSocial::find($reclamo->razon_social) : [];
        $seccion = Seccion::where(['codigo' => $reclamo->id_seccion])->first();
        $tienda = Tienda::findOrFail($reclamo->id_local);
        $responsable = User::findOrFail($reclamo->id_responsable);
        $origenes_reclamo = OrigenesReclamos::where('status', 1)->get();
        $tiendas = Tienda::where('status', 1)->get();
        $locales_problemas = ReclamoLocalProblema::where('id_reclamo', '=', $id)
                                                    ->leftJoin('users', 'reclamos_locales_problema.id_usuario', '=', 'users.id')
                                                    ->leftJoin('tiendas', 'reclamos_locales_problema.id_tienda', '=', 'tiendas.id')
                                                    ->select('reclamos_locales_problema.*', 'users.name', 'users.last_name' , 'tiendas.nombre' , 'tiendas.codigo')
                                                    ->orderBy('id','desc')
                                                    ->get();
            #ReclamoLocalProblema::find(['id_reclamo' => $id])->get();
        $color_form = 'primary';
        if($reclamo->categoria == 'JUMBO'){
            $color_form = 'success';
        }else if($reclamo->categoria== 'SISA'){
            $color_form = 'danger';
        }else if($reclamo->categoria == 'SPID'){
            $color_form = 'danger';
        }else if($reclamo->categoria == 'PROPIA'){
            $color_form = 'primary';
        }else if($reclamo->categoria == 'LOGISTICA'){
            $color_form = 'info';
        }
        $data=['color_form' => $color_form,'reclamo' => $reclamo, 'seccion' => $seccion, 'tienda' => $tienda, 'responsable' => $responsable , 'origenes_reclamo' => $origenes_reclamo ,'tiendas' => $tiendas , 'locales_problemas' => $locales_problemas , 'frigorifico' => $frigorifico , 'razon_social_frigo' => $razon_social_frigo];
        if($reclamo->status == 'CERRADO'){
            return redirect()->route('cerradoReclamo', ['id' => $id])->with('notification_type', 'warning')->with('notification_message', 'El reclamo se encuentra cerrado');
        }
        return view('reclamos.proceso-reclamo',$data);
    }
    public function guardar_reclamo_proceso(Request $request, $id)
    {

        /*$request->validate([
            'imagen_reclamo.*' => '|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('imagen_reclamo')) {
            foreach ($request->file('imagen_reclamo') as $archivo) {
                // Procesar y guardar archivo
            }
        }*/
        $reclamo = Reclamo::find($id);
        $status_original = $reclamo->getOriginal('status');
        $reclamo->update([
            'status' => strtoupper($request->input('status')),
            'fecha_local' => $request->input('fecha_local'),
            'reclamo_fecha' => $request->input('fecha_local'),
            'formato' => $request->input('formato'),
            'cantidad_problema' => $request->input('cantidad_problema'),
            'unidad_cantidad_problema' => $request->input('unidad_cantidad_problema'),
            'comentario_cantidad_problema' => $request->input('comentario_cantidad_problema'),
            'lote' => $request->input('lote'),
            'elaboracion' => $request->input('elaboracion'),
            'vencimiento' => $request->input('vencimiento'),
            'aplica_temperatura' => $request->input('aplica_temperatura'),
            'recepcion' => $request->input('recepcion'),
            'camaras' => $request->input('camaras'),
            'vitrina' => $request->input('vitrina'),
            'aplica_carnes' => $request->input('aplica_carnes'),
            'frigorifico' => $request->input('frigorifico'),
            'fecha_faena' => $request->input('fecha_faena'),
            'cantidad_recibida' => $request->input('cantidad_recibida'),
            'descripcion_reclamo' => $request->input('descripcion_reclamo'),
            'observaciones_cliente' => $request->input('observaciones_cliente'),
            'motivo_reclamo' => $request->input('motivo_reclamo'),
            'tipo_reclamo' => $request->input('tipo_reclamo'),
            'origen_venta' => $request->input('origen_venta'),
            'origen_venta_tienda' => $request->input('origen_venta_tienda'),
            'origen' => $request->input('origen'),
            'aplica_cliente' => $request->input('aplica_cliente'),
            'nombre_cliente' => $request->input('nombre_cliente'),
            'telefono_cliente' => $request->input('telefono_cliente'),
            'direccion_cliente' => $request->input('direccion_cliente'),
            'rut_cliente' =>str_replace('.','',$request->input('rut_cliente')),
            'obs_cliente' => $request->input('obs_cliente'),
            'obs_cliente_2' => $request->input('obs_cliente_2'),
            'obs_cliente_3' => $request->input('obs_cliente_3'),
            'mensaje_atento' => $request->input('mensaje_atento'),
            'aplica_proveedor_derivar' => $request->input('aplica_proveedor_derivar'),
            'fecha_contacto_prov' => $request->input('fecha_contacto_prov'),
            'obs_prov' => $request->input('observaciones_prov'),
            'fecha_respuesta_prov' => $request->input('fecha_respuesta_prov'),
            'acciones_prov' => $request->input('acciones_prov'),
            'no_obs' => $request->input('no_observacion'),
            'obs_general' => $request->input('obs_general'),
            'msj_log_imp' => $request->input('msj_log_imp'),
            'doble_garantia' => $request->input('doble_garantia'),
        ]);

        #ADJUNTOS CON SPATIE
        $documento_reclamo = $request->file('documento_reclamo');
        if(!empty($documento_reclamo)){
            foreach ($documento_reclamo as $doc) {
                if ($doc->isValid()) {
                    // Guarda la imagen en la librería de medios del producto
                    $reclamo->addMedia($doc)->toMediaCollection('documentos_reclamos');
                }
            }
        }
        $imagen_reclamo = $request->file('imagen_reclamo');
        if(!empty($imagen_reclamo)){
            foreach ($imagen_reclamo as $imagen) {
                if ($imagen->isValid()) {
                    // Guarda la imagen en la librería de medios del producto
                    $reclamo->addMedia($imagen)->toMediaCollection('imagenes_reclamos');
                }
            }
        }
        #RESPUESTAS DE OTROS LOCALES

        $usuario_problema_tienda = (!empty($request->input('usuario_problema_tienda'))) ? $request->input('usuario_problema_tienda') : [];
        $id_tienda_problema_tienda = (!empty($request->input('id_tienda_problema_tienda'))) ? $request->input('id_tienda_problema_tienda') : [];
        $resultado_problema_tienda = (!empty($request->input('resultado_problema_tienda'))) ? $request->input('resultado_problema_tienda') : [];
        $lote_problema_tienda = (!empty($request->input('lote_problema_tienda'))) ? $request->input('lote_problema_tienda') : [];
        $fecha_elab_problema_tienda = (!empty($request->input('fecha_elab_problema_tienda'))) ? $request->input('fecha_elab_problema_tienda') : [];
        $fecha_venc_problema_tienda = (!empty($request->input('fecha_venc_problema_tienda'))) ? $request->input('fecha_venc_problema_tienda') : [];
        $cantidad_problema_tienda = (!empty($request->input('cantidad_problema_tienda'))) ? $request->input('cantidad_problema_tienda') : [];
        $unidad_cantidad_problema_tienda = (!empty($request->input('unidad_cantidad_problema_tienda'))) ? $request->input('unidad_cantidad_problema_tienda') : [];
        $retiro_problema_tienda = (!empty($request->input('retiro_problema_tienda'))) ? $request->input('retiro_problema_tienda') : [];
        $son_resultado_problema_tienda=0;
        foreach ($usuario_problema_tienda as $key => $value) {
            ReclamoLocalProblema::create([
                'id_reclamo' => $id,
                'id_usuario' => $value,
                'id_tienda' => session('u_id_tienda'),#(!empty($id_tienda_problema_tienda[$key])) ? $id_tienda_problema_tienda[$key] : NULL,
                'resultado' => (!empty($resultado_problema_tienda[$key])) ? $resultado_problema_tienda[$key] : NULL,
                'lote' => (!empty($lote_problema_tienda[$key])) ? $lote_problema_tienda[$key] : NULL,
                'fecha_elab' => (!empty($fecha_elab_problema_tienda[$key])) ? $fecha_elab_problema_tienda[$key] : NULL,
                'fecha_venc' => (!empty($fecha_venc_problema_tienda[$key])) ? $fecha_venc_problema_tienda[$key] : NULL,
                'cantidad' => (!empty($cantidad_problema_tienda[$key])) ? $cantidad_problema_tienda[$key] : NULL,
                'unidad_cantidad' => (!empty($unidad_cantidad_problema_tienda[$key])) ? $unidad_cantidad_problema_tienda[$key] : NULL,
                'retiro' => (!empty($retiro_problema_tienda[$key])) ? $retiro_problema_tienda[$key] : NULL,
            ]);
        }
        $respuestas_reclamo = ReclamoLocalProblema::where('id_reclamo', $id)->where('resultado','Con Problema')->count();
        if($respuestas_reclamo > 0){
            $reclamo->update(['posible_recall' => 'SI']);
        }
        #return 'OK';
        if(strtoupper($request->input('status')) == 'PROCESO'){
            $msj = ($status_original == 'CERRADO') ? '¡Reclamo abierto correctamente!' : '¡Reclamo guardado correctamente!';
            return redirect()->route('procesoReclamo', ['id' => $id])->with('status', $msj);
            #return to_route('guardado')->with('status','¡Reclamo guardado correctamente!');
        }
        if(strtoupper($request->input('status')) == 'RECHAZADO'){
            return redirect()->route('listAprobarReclamo')->with('status', '¡Reclamo rechazado correctamente!');
             #return to_route('guardado')->with('status','¡Reclamo guardado correctamente!');
         }
        ####RECLAMO CERRADO####
        $reclamo->update([
            'status' => strtoupper($request->input('status')),
            'fecha_cerrado' => date('Y-m-d'),
            'responsable_cierre' => Auth::user()->id,#ID USUARIO
        ]);
        return redirect()->route('cerradoReclamo', ['id' => $id])->with('status', '¡Reclamo cerrado correctamente!');
    }
    public function reclamo_cerrado($id)
    {
        $reclamo = Reclamo::findOrFail($id);
        $seccion = Seccion::where(['codigo' => $reclamo->id_seccion])->first();
        $tienda = Tienda::findOrFail($reclamo->id_local);
        $responsable = User::findOrFail($reclamo->id_responsable);
        $origenes_reclamo = OrigenesReclamos::where('status', 1)->get();
        $data=['reclamo' => $reclamo, 'seccion' => $seccion, 'tienda' => $tienda, 'responsable' => $responsable , 'origenes_reclamo' => $origenes_reclamo];
        if($reclamo->status == 'PROCESO'){
            return redirect()->route('procesoReclamo', ['id' => $id])->with('notification_type', 'warning')->with('notification_message', 'El reclamo se encuentra en proceso');
        }
        return view('reclamos.cerrado-reclamo',$data);
    }
    function reclamo_PDF($id)
    {
        #User::with('sections','cc','tiendas')->findOrFail($id);
        $reclamo = Reclamo::with('tienda','origen_reclamo','seccion','responsable')->findOrFail($id);
        $fondo = 'fondo-general.png';
        $logo = 'logo-general.png';
        $logo_class = 'logo-general';
        if($reclamo->categoria == 'JUMBO'){
            $fondo = 'fondo-jumbo.png';
            $logo = 'logo-jumbo.png';
            $logo_class = 'logo-jumbo';
        }
        if($reclamo->categoria == 'SISA'){
            $fondo = 'fondo-sisa.png';
            $logo = 'logo-sisa.png';
            $logo_class = 'logo-sisa';
        }
        $data = [
            'date' => date('m/d/Y'),
            'reclamo' => $reclamo,
            'fondo' => $fondo,
            'logo' => $logo,
            'logo_class' => $logo_class,
        ];
        $pdf = Pdf::loadView('reclamos.pdf.pdf-reclamo', $data)->setPaper('a4');
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);
        #return $pdf->stream();
        return $pdf->download('reclamo_'.$reclamo->id.'.pdf');
    }
    function respuestas_reclamo($id){

        $data['data'] = Reclamo::with('reclamos_local_problema.responsable','reclamos_local_problema.tienda')->find($id);
        return Excel::download(new RespuestasReclamoExport($data), 'nombre_archivo1.xlsx');
        #return view('exports.invoices',$data);
    }
    function reclamo_notificar_respuestas(Request $request){
        #id_reclamo
        #local
        $usuarios = User::whereIn('id', [1,5])->get(); // Obtén los usuarios a notificar
        /* $usuarios = User::with('roles')
                                    ->whereIn('area', $request->input('local'))
                                    ->whereHas('roles', function ($query) {
                                        $query->whereIn('name', ['supervisor', 'tecnólogo']);
                                    })->get();  */// Obtén los usuarios a notificar
        $reclamo = Reclamo::with('tienda','seccion')->find($request->input('id_reclamo'));
        foreach ($usuarios as $usuario) {
            $usuario->notify(new ReclamosRespuestasNotification($usuario,$reclamo));
        }
        return response()->json(['success' => TRUE]);
    }
}

