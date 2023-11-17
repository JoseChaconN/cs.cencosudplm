<?php

namespace App\Http\Controllers;

use App\Models\Seccion;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SeccionesController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function secciones_list(Request $request)
    {
        $data=[];
        $data['secciones'] = Seccion::get();
        return view('secciones.list-secciones',$data);
    }
    public function seccion_nueva()
    {
        $data['seccion']= new Seccion;
        return view('secciones.seccion-form',$data);
    }
    public function guardar_seccion(Request $request,$id=0)
    {
        $seccion_data=[            
            'nombre' => request()->input('nombre'),
            'codigo' => request()->input('codigo'),
        ];
        if($id==0){
            $seccion = Seccion::create($seccion_data);
            $id = $seccion->id;
        }else{
            $seccion=Seccion::find($id);
            $seccion->update($seccion_data);
        }
        return redirect()->route('editSeccion', ['id' => $id])->with('notification_type', 'success')->with('notification_message', 'Seccion guardado correctamente!');
    }
    public function seccion_edit($id)
    {
        $data['seccion'] = Seccion::findOrFail($id);
        return view('secciones.seccion-form',$data);
    }
}