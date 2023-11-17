<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\User;
use App\Models\UsuarioTienda;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TiendasController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function tiendas_list(Request $request)
    {
        $data=[];
        $data['tiendas'] = Tienda::get();
        return view('tiendas.list-tiendas',$data);
    }
    public function tienda_nuevo()
    {
        $data['tienda']= new Tienda;
        return view('tiendas.tienda-form',$data);
    }
    public function guardar_tienda(Request $request,$id=0)
    {
        $tienda_data=[
            'nombre' => request()->input('nombre'),
            'codigo' => request()->input('codigo'),
            'direccion' => request()->input('direccion'),
            'telefono' => request()->input('telefono'),
            'area' => request()->input('area'),
            'tipo' => request()->input('tipo'),
            'zona' => request()->input('zona'),
        ];
        if($id==0){
            $tienda = Tienda::create($tienda_data);
            $id = $tienda->id;
        }else{
            $tienda=Tienda::find($id);
            $tienda->update($tienda_data);
        }
        return redirect()->route('editTienda', ['id' => $id])->with('notification_type', 'success')->with('notification_message', 'Tienda guardada correctamente!');
    }
    public function tienda_edit($id)
    {
        $data['tienda'] = Tienda::findOrFail($id);
        return view('tiendas.tienda-form',$data);
    }
}