<?php

namespace App\Http\Controllers;

use App\Models\Recall;
use App\Models\RecallRespuesta;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tienda;
use App\Models\Seccion;
use App\Models\User;
use App\Notifications\RecallNotification;
use App\Services\AppServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RecallsController extends BaseController
{
	use AuthorizesRequests, ValidatesRequests;

	public function __construct()
	{
		$this->middleware('auth');
		#$this->middleware('role:admin|administrador|tecnologo')->except('recall_proceso_respuesta','guardar_recall_respuesta','recall_PDF', 'respuesta_recall_PDF');
		#$this->middleware('role:admin|administrador|tecnologo|tienda')->except('recall_PDF', 'respuesta_recall_PDF');
	}
	/*public function index()
    {
        return view('reclamos.index');
    }*/
	public function recall()
	{
		#BUSCAR PRODUCTOS

		$nombreProd = request()->input('nombreProd');
		$eanProd = request()->input('eanProd');
		$sapProd = request()->input('sapProd');
		$productos = NULL;
		if (!empty($nombreProd) || !empty($eanProd) || !empty($sapProd)) {
			$productos = Producto::where('nombre', 'LIKE', "%$nombreProd%")
				->where('ean', 'LIKE', "%$eanProd%")
				->where('sap', 'LIKE', "%$sapProd%")
				->get();
		}

		$data = ['breadcrumb' => 'Nuevo Recall', 'productos' => $productos, 'request' => request()->input()];
		return view('recalls.pre-recall', $data);
	}
	public function recall_nuevo(Request $request, $id)
	{
		$producto = Producto::findOrFail($id);
		$proveedor = Proveedor::findOrFail($producto->id_proveedor);		
		$seccion = Seccion::where('codigo', $producto->id_seccion)->first();
		$productos = Producto::where('id_proveedor', $producto->id_proveedor)->where('id_seccion', $producto->id_seccion)->get();

		$data = ['breadcrumb' => 'Nuevo Reclamo', 'producto' => $producto, 'proveedor' => $proveedor, 'seccion' => $seccion, 'productos' => $productos, 'request' => request()->input(), 'id' => $id];
		return view('recalls.nuevo-recall', $data);
	}
	public function guardar_recall_nuevo(Request $request)
	{
		$lote = $request->input('lote');
		$fecha = $request->input('fecha');
		$fecha_vencimiento = $request->input('fecha_vencimiento');
		$productos = $request->input('producto');
		$productos_array = [];
		$lote_array = [];
		$fecha_array = [];
		$fecha_vencimiento_array = [];
		foreach ($productos as $key => $value) {
			$productos_array[$value] = $value;
			$lote_array[$value] = $lote[$value];
			$fecha_array[$value] = $fecha[$value];
			$fecha_vencimiento_array[$value] = $fecha_vencimiento[$value];
		}
		$momento_ingreso = date('Y-m-d H:i:s');
		switch ($request->input('recall')) {
			case 'Calidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($momento_ingreso . " +1 day"));
				break;
			case 'Legalidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($momento_ingreso . " +1 day"));
				break;
			case 'Inocuidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($momento_ingreso . " +1 day"));
				break;
			default:
				$momento_final = date("Y-m-d H:i:s", strtotime($fecha . " +12 hours"));
				break;
		}

		$recall = Recall::create([
			'status' => 'PROCESO',
			'id_proveedor' => $request->input('id_proveedor'),
			'nombre_proveedor' => $request->input('nombre_proveedor'),
			'rut_proveedor' => $request->input('rut_proveedor'),
			'id_responsable' => Auth::user()->id, #$request->input('id_responsable'),
			'id_local' => session('u_id_tienda'), #$request->input('id_local'),
			'id_seccion' => $request->input('id_seccion'),
			'seccion' => $request->input('seccion'),
			'momento_ingreso' => $momento_ingreso,
			'momento_final' => $momento_final,
			'recall' => $request->input('recall'),
			'motivo' => $request->input('motivo'),
			'problema' => $request->input('problema'),
			'accion' => $request->input('accion'),
			'locales_lotes' => $request->input('locales_lotes'),
			'cadena' => $request->input('cadena'),
			'productos' => json_encode($productos_array),
			'lote' => json_encode($lote_array),
			'fecha' => json_encode($fecha_array),
			'fecha_vencimiento' => json_encode($fecha_vencimiento_array),
			'pais' => 2,
		]);
		$imagen_recall=(!empty($request->file('imagen_recall'))) ? $request->file('imagen_recall') : [];
        $allowedImageTypes = app('filetypes')['image'];
		$imagen_adjunto_array=[];
        foreach ($imagen_recall as $foto) {
            if (!$foto->extension() || !in_array($foto->extension(), $allowedImageTypes)) {
                #return response()->json(['error' => 'Archivo inválido.'], 400);
            }else{
                $name='recall_'.$recall->id.'/'.$recall->id.'_img_'.date('YmdHis').rand(0,1000).'.'.$foto->extension();
                $foto->storeAs('',$name,'recalls');
                $imagen_adjunto_array[]=[
                    'name' => $name,
                    'extension' => $foto->extension(),
                ];
            }
        }
		if(count($imagen_adjunto_array) > 0){
			$recall->update(['imagen_recall' => json_encode($imagen_adjunto_array)]);
		}
		return redirect()->route('procesoRecall', ['id' => $recall->id])->with('notification_type', 'success')->with('notification_message', '¡Recall guardado correctamente!'); #->with('status', '¡Recall guardado correctamente!');
	}
	public function recall_proceso($id)
	{
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
		return view('recalls.proceso-recall', $data);
	}
	public function recall_detalle_proceso($id)
	{
		$recall = Recall::findOrFail($id);
		$responsable = User::findOrFail($recall->id_responsable);
		$ids = json_decode($recall->productos, TRUE);
		$productos = Producto::whereIn('id', $ids)->get();

		$lote_array = json_decode($recall->lote, TRUE);
		$fecha_array = json_decode($recall->fecha, TRUE);
		$fecha_vencimiento_array = json_decode($recall->fecha_vencimiento, TRUE);

		$data = ['breadcrumb' => 'Recall Proceso', 'recall' => $recall, 'responsable' => $responsable, 'productos' => $productos, 'lote' => $lote_array, 'fecha' => $fecha_array, 'fecha_vencimiento' => $fecha_vencimiento_array];		
		return view('recalls.proceso-detalle-recall', $data);
	}
	public function guardar_recall_proceso(Request $request, $id)
	{
		$recall = Recall::find($id);
		$lote = $request->input('lote');
		$fecha = $request->input('fecha');
		$fecha_vencimiento = $request->input('fecha_vencimiento');
		$productos = $request->input('producto');
		$productos_array = [];
		$lote_array = [];
		$fecha_array = [];
		$fecha_vencimiento_array = [];
		foreach ($productos as $key => $value) {
			$productos_array[$value] = $value;
			$lote_array[$value] = $lote[$value];
			$fecha_array[$value] = $fecha[$value];
			$fecha_vencimiento_array[$value] = $fecha_vencimiento[$value];
		}
		switch ($request->input('recall')) {
			case 'Calidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($recall->momento_ingreso . " +1 day"));
				break;
			case 'Legalidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($recall->momento_ingreso . " +1 day"));
				break;
			case 'Inocuidad':
				$momento_final = date("Y-m-d H:i:s", strtotime($recall->momento_ingreso . " +1 day"));
				break;
			default:
				$momento_final = date("Y-m-d H:i:s", strtotime($fecha . " +12 hours"));
				break;
		}

		$recall->update([
			'momento_final' => $momento_final,
			'recall' => $request->input('recall'),
			'motivo' => $request->input('motivo'),
			'problema' => $request->input('problema'),
			'accion' => $request->input('accion'),
			'locales_lotes' => $request->input('locales_lotes'),
			'cadena' => $request->input('cadena'),
			'productos' => json_encode($productos_array),
			'lote' => json_encode($lote_array),
			'fecha' => json_encode($fecha_array),
			'fecha_vencimiento' => json_encode($fecha_vencimiento_array),
		]);

		return redirect()->route('procesoRecall', ['id' => $recall->id])->with('notification_type', 'success')->with('notification_message', '¡Recall guardado correctamente!');
	}
	public function cerrar_recall(Request $request){
		try {
            DB::transaction(function () use ($request) {
				$recall = Recall::find($request->input('id_recall'));
				$recall->update([
					'responsable_cierre' => Auth::user()->id,
					'fecha_cierre' => date('Y-m-d H:i:s'),
					'status' => 'CERRADO'
				]);
				$documento = $request->file('documento_cierre');				
				if (!empty($documento)) {	
					if ($documento->isValid()) {
						// Guarda la imagen en la librería de medios del producto
						$recall->addMedia($documento)->toMediaCollection('documento-cierre-recall');
					}
				}
			});
			return redirect()->route('procesoRecall',$request->input('id_recall'))
                    ->with('notification_type', 'success')
                    ->with('notification_message', 'Recall cerrado correctamente!');
		} catch (\Exception $e) {
			return redirect()->route('procesoRecall',$request->input('id_recall'))
			->with('notification_type', 'danger')->with('notification_message', 'Error al cerrar el recall: ' . $e->getMessage());
		}
	}
	public function abrir_recall(Request $request){
		try {
            DB::transaction(function () use ($request) {
				$recall = Recall::find($request->input('id_recall'));
				$old_data = $recall->getOriginal();
				$recall->update([
					'responsable_cierre' => NULL,
					'fecha_cierre' => NULL,
					'status' => 'PROCESO'
				]);
				$recall->clearMediaCollection('documento-cierre-recall');
				activity()->causedBy(Auth::user())->withProperties(['old_data' => $old_data])->log('Abrir Recall');
			});
			
			return redirect()->route('procesoRecall',$request->input('id_recall'))
                    ->with('notification_type', 'success')
                    ->with('notification_message', 'Recall abierto correctamente!');
		} catch (\Exception $e) {
			return redirect()->route('procesoRecall',$request->input('id_recall'))
			->with('notification_type', 'danger')->with('notification_message', 'Error al abrir el recall: ' . $e->getMessage());
		}
	}
	public function recall_proceso_respuesta($id)
	{
		$recall = Recall::findOrFail($id);
		$proveedor = Proveedor::findOrFail($recall->id_proveedor);
		$seccion = Seccion::where('codigo', $recall->id_seccion)->first();
		$ids = json_decode($recall->productos, TRUE);
		$productos = Producto::whereIn('id', $ids)->get();
		$lote_array = json_decode($recall->lote, TRUE);
		$fecha_array = json_decode($recall->fecha, TRUE);
		$fecha_vencimiento_array = json_decode($recall->fecha_vencimiento, TRUE);

		$data = ['breadcrumb' => 'Nuevo Reclamo', 'recall' => $recall, 'proveedor' => $proveedor, 'seccion' => $seccion, 'productos' => $productos, 'id' => $id, 'lote' => $lote_array, 'fecha' => $fecha_array, 'fecha_vencimiento' => $fecha_vencimiento_array];
		if($recall->status == 'CERRADO'){
			return redirect('/')->with('notification_type', 'danger')->with('notification_message', '¡Recall cerrado! Comunícate con el supervisor.');
		}
		return view('recalls.respuesta-recall', $data);
	}
	public function guardar_recall_respuesta(Request $request)
	{
		$productos = $request->input('producto');
		$lote = $request->input('lote');
		$fecha_elaboracion = $request->input('fecha_elaboracion');
		$fecha_vencimiento = $request->input('fecha_vencimiento');
		$cantidad_unidad = $request->input('cantidad_unidad');
		$tipo_unidad = $request->input('tipo_unidad');
		$retiro_formato = $request->input('retiro_formato');


		$productos_array = [];
		$lote_array = [];
		$fecha_elaboracion_array = [];
		$fecha_vencimiento_array = [];
		$cantidad_unidad_array = [];
		$tipo_unidad_array = [];
		$retiro_formato_array = [];
		foreach ($productos as $key => $value) {
			$productos_array[$value] = $value;
			$lote_array[$value] = $lote[$value];
			$fecha_elaboracion_array[$value] = $fecha_elaboracion[$value];
			$fecha_vencimiento_array[$value] = $fecha_vencimiento[$value];
			$cantidad_unidad_array[$value] = $cantidad_unidad[$value];
			$tipo_unidad_array[$value] = $tipo_unidad[$value];
			$retiro_formato_array[$value] = $retiro_formato[$value];
		}
		$recallNuevo = RecallRespuesta::create([
			'id_recall' => $request->input('id_recall'),
			'id_responsable' => Auth::user()->id,
			'responsable' => Auth::user()->name.' '.Auth::user()->last_name,
			'responsable_email' => Auth::user()->email,
			'id_local' =>  session('u_id_tienda'),
			'nombre_local' => session('u_nombre_tienda'),
			'codigo_local' => session('u_codigo_tienda'),
			'productos' => json_encode($productos_array),
			'lote' => json_encode($lote_array),
			'fecha_elaboracion' => json_encode($fecha_elaboracion_array),
			'fecha_vencimiento' => json_encode($fecha_vencimiento_array),
			'cantidad_unidad' => json_encode($cantidad_unidad_array),
			'tipo_unidad' => json_encode($tipo_unidad_array),
			'retiro_formato' => json_encode($retiro_formato_array),
		]);
		return redirect('/')->with('notification_type', 'success')
		->with('notification_message', '¡Respuesta de Recall guardada correctamente!')
		->with('notification_url_button', route('pdfRespuestaRecall',$recallNuevo->id))		
		->with('notification_text_button', 'Descargar PDF de respuesta'); #->with('status', '¡Respuesta de Recall guardada correctamente!');
	}
	public function recall_list(Request $request)
	{
		$data = [];
		$data['mes'] = (!empty($request->input('mes'))) ? $request->input('mes') : date('m');
		$data['ano'] = (!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
		$data['n_recall'] = (!empty($request->input('n_recall'))) ? $request->input('n_recall') : '';


		$data['recalls'] = Recall::where('momento_ingreso', 'LIKE', '%' . $data['ano'] . '-' . $data['mes'] . '%')
			->where('id', 'LIKE', '%' . $data['n_recall'] . '%')
			->get();
		return view('recalls.list-recall', $data);
	}
	public function recall_PDF($id)
    {
        #User::with('sections','cc','tiendas')->findOrFail($id);
        $recall = Recall::with('tienda','responsable')->findOrFail($id);
		$productos_array = json_decode($recall->productos,TRUE);
		$productos = Producto::whereIn('id',$productos_array)->get();
		$recall->lote = json_decode($recall->lote,TRUE);
		$recall->fecha = json_decode($recall->fecha,TRUE);
		$recall->fecha_vencimiento = json_decode($recall->fecha_vencimiento,TRUE);
        $data = [
            'date' => date('m/d/Y'),
            'recall' => $recall,
			'productos' => $productos,
        ];
        $pdf = Pdf::loadView('recalls.pdf-recall', $data)->setPaper('a4')->setOption(['defaultFont' => 'helvetica']);
        
        #return $pdf->stream();
        return $pdf->download('recall_'.$recall->id.'.pdf');
    }
	public function respuesta_recall_PDF($id)
    {
        #User::with('sections','cc','tiendas')->findOrFail($id);
        $respuesta_recall = RecallRespuesta::with('recall')->findOrFail($id);
		$productos_array = json_decode($respuesta_recall->productos,TRUE);
		$productos = Producto::whereIn('id',$productos_array)->get();
		$respuesta_recall->lote = json_decode($respuesta_recall->lote,TRUE);
		$respuesta_recall->fecha_elaboracion = json_decode($respuesta_recall->fecha_elaboracion,TRUE);
		$respuesta_recall->fecha_vencimiento = json_decode($respuesta_recall->fecha_vencimiento,TRUE);
        $data = [
            'date' => date('m/d/Y'),
            'respuesta_recall' => $respuesta_recall,
			'productos' => $productos,
        ];
        $pdf = Pdf::loadView('recalls.pdf-respuesta-recall', $data)->setPaper('a4')->setOption(['defaultFont' => 'helvetica']);
        
        #return $pdf->stream();
        return $pdf->download('recall_respuesta_'.$respuesta_recall->recall->id.'.pdf');
    }
	public function recall_notificar_nuevo(Request $request){
		$data = Recall::find($request->input('id'));
		$cadenas = [$data->cadena];
		if($data->cadena == 'JUMBO'){
			$roles = ['tecnólogo'];
		}
		if($data->cadena == 'SISA'){
			$roles = ['supervisor'];
		}
		if($data->cadena == 'AMBAS'){
			$cadenas = ['JUMBO','SISA'];
			$roles = ['supervisor', 'tecnólogo'];
		}
        $usuarios = User::with('roles')
                                    ->whereIn('area', $cadenas)
                                    ->whereHas('roles', function ($query) use ($roles) {
                                        $query->whereIn('name', $roles);
                                    })->get();  // Obtén los usuarios a notificar
        foreach ($usuarios as $usuario) {
            $usuario->notify(new RecallNotification('new',$usuario,$data));
        }
        return response()->json(['success' => TRUE]);
    }
}
