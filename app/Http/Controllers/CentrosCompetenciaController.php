<?php

namespace App\Http\Controllers;

use App\Models\CentroCompetencia;
use App\Models\SeccionCentroCompetencia;
use App\Models\Seccion;
use App\Models\Proveedor;
use App\Models\Producto;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CentrosCompetenciaController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function centro_competencia_list(Request $request)
    {
        $data=[];
        $data['centros_competencia'] = CentroCompetencia::get();
        return view('centros_competencia.list-centros-competencia',$data);
    }
    public function centro_competencia_nuevo()
    {
        $data['centro_competencia']= new CentroCompetencia;
        $data['secciones']= Seccion::where('status',1)->orderBy('nombre', 'asc')->get();
        $data['secciones_cc'] = [];
        return view('centros_competencia.centros-competencia-form',$data);
    }
    public function guardar_centro_competencia(Request $request,$id=0)
    {
        $cc = CentroCompetencia::find(request()->input('id_cc'));
        $cc_data=[            
            'nombre' => $request->input('nombre'),
            'status' => 1,
        ];
        if($id==0){
            $cc = CentroCompetencia::create($cc_data);
            $id = $cc->id;
        }else{
            $cc=Producto::find($id);
            $cc->update($cc_data);
        }
        SeccionCentroCompetencia::where('id_cc',$id)->delete();
        if(!empty($request->input('secciones'))){
            foreach ($request->input('secciones') as $key => $value) {
                $cc = SeccionCentroCompetencia::create(['id_cc' => $id , 'codigo_seccion' => $value]);
            }
        }


        return redirect()->route('editCentroCompetencia', ['id' => $id])->with('notification_type', 'success')->with('notification_message', 'Centro Competencia guardado correctamente!');
    }
    public function centro_competencia_edit($id)
    {
        $data['centro_competencia'] = CentroCompetencia::findOrFail($id);
        $secciones_cc = SeccionCentroCompetencia::where('id_cc',$id)->get();
        $data['secciones_cc'] = [];
        foreach ($secciones_cc as $seccion) {
            $data['secciones_cc'][]=$seccion->codigo_seccion;
        }
        $data['secciones'] = Seccion::where('status', 1)->orderBy('nombre', 'asc')->get();
        return view('centros_competencia.centros-competencia-form',$data);
    }
}