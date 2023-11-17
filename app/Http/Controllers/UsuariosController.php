<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Seccion;
use App\Models\User;
use App\Models\CentroCompetencia;
use App\Models\UsuarioCentroCompetencia;
use App\Models\UsuarioTienda;
use App\Models\UsuarioSeccion;
use Spatie\Permission\Models\Role;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /*public function index()
    {
        return view('reclamos.index');
    }*/
    public function __construct()
    {
        $this->middleware('auth');
        #$this->middleware('role:admin|administrador|tecnologo')->except('guardar_usuario','usuario_edit');
        #$this->middleware('role:admin|administrador|tecnologo|tienda')->only('reclamo','reclamo_nuevo','guardar_reclamo_nuevo','reclamo_PDF');
    }

    public function usuarios_list(Request $request)
    {
        $data=[];
        #$data['mes']=(!empty($request->input('mes'))) ? $request->input('mes') : date('m');
        #$data['ano']=(!empty($request->input('ano'))) ? $request->input('ano') : date('Y');
        #$data['n_recall'] = (!empty($request->input('n_recall'))) ? $request->input('n_recall') : '';

        /*ActivityLog::create([
            'accion' => 1, #$action,
            'tabla' => 1, #$model->getTable(),
            'data' => json_encode(['1asda' => 1]), #$model->toArray(),
            'id_usuario' => 1,#Auth::user()->id,
        ]);*/
        
        $data['usuarios'] = User::get();
        return view('usuarios.list-usuarios',$data);
    }

    public function usuario_nuevo()
    {
        $data=[];
        $data['roles'] = Role::all();
        $data['roles_usuario']=[];
        $data['secciones_usuario']=[];
        $data['ccs_usuario']=[];
        $data['tiendas_usuario']=[];
        $data['tiendas_sup_usuario']=[];
        $data['secciones'] = Seccion::where('status', 1)->get();
        $data['ccs'] = CentroCompetencia::where('status', 1)->get();
        $data['tiendas'] = Tienda::where('status', 1)->get();
        $data['usuario']= new User;

        return view('usuarios.usuario-form',$data);
    }
    public function guardar_usuario(Request $request,$id=0)
    {

        $cc = (!empty(request()->input('cc'))) ? request()->input('cc') : [];#request()->input('cc');
        $secciones_aca = (!empty(request()->input('secciones_aca'))) ? request()->input('secciones_aca') : [];
        $tiendas = (!empty(request()->input('tiendas'))) ? request()->input('tiendas') : [];
        $tiendas_supervisor = (!empty(request()->input('tiendas_supervisor'))) ? request()->input('tiendas_supervisor') : [];
        $cc_array=[];
        $secciones_aca_array=[];
        $tiendas_array=[];
        $tiendas_supervisor_array=[];
        $usuario_data=[
            'name' => request()->input('name'),
            'last_name' => request()->input('last_name'),
            'email' => request()->input('email'),
            'area' => request()->input('area'),            
            'cargo' => request()->input('cargo'),
            #'perfil_cs' => request()->input('perfil_cs'),
            #'perfil_aca' => request()->input('perfil_aca'),
            #'rol_aca' => request()->input('rol_aca'),
            'tecnologo_cd' => 1,#request()->input('tecnologo_cd'),
        ];
        if($id==0){
            $usuario_data['password']=bcrypt('cencosud');
            $user = User::create($usuario_data);
            $id = $user->id;
        }else{
            $user=User::find($id);
            $user->update($usuario_data);
        }
        
        $user->roles()->sync($request->rol_cs);
        UsuarioCentroCompetencia::where('id_usuario',$id)->delete();
        UsuarioTienda::where('id_usuario',$id)->delete();
        UsuarioSeccion::where('id_usuario',$id)->delete();
        foreach ($cc as $key => $value) {
            $cc_array=['id_cc' => $value , 'id_usuario' => $id];
            UsuarioCentroCompetencia::create($cc_array);
        }
        foreach ($secciones_aca as $key => $value) {
            $secciones_aca_array=['codigo_seccion' => $value , 'id_usuario' => $id];
            UsuarioSeccion::create($secciones_aca_array);
        }
        foreach ($tiendas as $key => $value) {
            $tiendas_array=['id_tienda' => $value , 'id_usuario' => $id , 'tipo' => 'USUARIO'];
            UsuarioTienda::create($tiendas_array);
        }
        foreach ($tiendas_supervisor as $key => $value) {
            $tiendas_supervisor_array=['id_tienda' => $value , 'id_usuario' => $id , 'tipo' => 'SUPERVISOR'];
            UsuarioTienda::create($tiendas_supervisor_array);
        }

        /*if(!empty($cc_array)){
            UsuarioCentroCompetencia::create($cc_array);
        }
        if(!empty($secciones_aca_array)){
            UsuarioSeccion::create($secciones_aca_array);
        }
        if(!empty($tiendas_array)){
            UsuarioTienda::create($tiendas_array);
        }
        if(!empty($tiendas_supervisor_array)){
            UsuarioTienda::create($tiendas_supervisor_array);
        }*/
        return redirect()->route('editUsuario', ['id' => $id])->with('notification_type', 'success')->with('notification_message', '¡Usuario guardado correctamente!');
    }
    public function usuario_edit($id)
    {
        $data=[];
        $data['secciones'] = Seccion::where('status', 1)->get();
        $data['ccs'] = CentroCompetencia::where('status', 1)->get();
        $data['tiendas'] = Tienda::where('status', 1)->get();
        $data['usuario'] = User::with('roles')->findOrFail($id);#User::with('sections','cc','tiendas')->findOrFail($id);
        $data['roles'] = Role::all();
        $data['secciones_usuario']=[];#$data['usuario']->sections->toArray();
        $data['ccs_usuario']=[];
        $data['tiendas_usuario']=[];
        $data['tiendas_sup_usuario']=[];
        $data['roles_usuario']=[];
        foreach ($data['usuario']->roles as $rol) {
            $data['roles_usuario'][] = $rol->id;
            
        }
        $secciones_usuario = UsuarioSeccion::where('id_usuario', $id)->get();
        if(!empty($secciones_usuario)){
            foreach ($secciones_usuario as $key => $value) {
                $data['secciones_usuario'][]=$value['codigo_seccion'];
            }
        }
        $ccs_usuario = UsuarioCentroCompetencia::where('id_usuario', $id)->get();
        if(!empty($ccs_usuario)){
            foreach ($ccs_usuario as $key => $value) {
                $data['ccs_usuario'][]=$value['id_cc'];
            }
        }
        $tiendas_usuario = UsuarioTienda::where('id_usuario', $id)->where('tipo', 'USUARIO')->get();
        if(!empty($tiendas_usuario)){
            foreach ($tiendas_usuario as $key => $value) {
                $data['tiendas_usuario'][]=$value['id_tienda'];
            }
        }
        $tiendas_sup_usuario = UsuarioTienda::where('id_usuario', $id)->where('tipo', 'SUPERVISOR')->get();
        if(!empty($tiendas_sup_usuario)){
            foreach ($tiendas_sup_usuario as $key => $value) {
                $data['tiendas_sup_usuario'][]=$value['id_tienda'];
            }
        }
        
        return view('usuarios.usuario-form',$data);
    }
    public function usuario_perfil()
    {   
        $id = Auth::user()->id;
        $data=[];
        $data['secciones'] = Seccion::where('status', 1)->get();
        $data['ccs'] = CentroCompetencia::where('status', 1)->get();
        $data['tiendas'] = Tienda::where('status', 1)->get();
        $data['usuario'] = User::with('roles')->findOrFail($id);#User::with('sections','cc','tiendas')->findOrFail($id);
        $data['roles'] = Role::all();
        $data['secciones_usuario']=[];#$data['usuario']->sections->toArray();
        $data['ccs_usuario']=[];
        $data['tiendas_usuario']=[];
        $data['tiendas_sup_usuario']=[];
        $data['roles_usuario']=[];
        foreach ($data['usuario']->roles as $rol) {
            $data['roles_usuario'][] = $rol->id;
            
        }
        $secciones_usuario = UsuarioSeccion::where('id_usuario', $id)->get();
        if(!empty($secciones_usuario)){
            foreach ($secciones_usuario as $key => $value) {
                $data['secciones_usuario'][]=$value['codigo_seccion'];
            }
        }
        $ccs_usuario = UsuarioCentroCompetencia::where('id_usuario', $id)->get();
        if(!empty($ccs_usuario)){
            foreach ($ccs_usuario as $key => $value) {
                $data['ccs_usuario'][]=$value['id_cc'];
            }
        }
        $tiendas_usuario = UsuarioTienda::where('id_usuario', $id)->where('tipo', 'USUARIO')->get();
        if(!empty($tiendas_usuario)){
            foreach ($tiendas_usuario as $key => $value) {
                $data['tiendas_usuario'][]=$value['id_tienda'];
            }
        }
        $tiendas_sup_usuario = UsuarioTienda::where('id_usuario', $id)->where('tipo', 'SUPERVISOR')->get();
        if(!empty($tiendas_sup_usuario)){
            foreach ($tiendas_sup_usuario as $key => $value) {
                $data['tiendas_sup_usuario'][]=$value['id_tienda'];
            }
        }
        
        return view('usuarios.usuario-form',$data);
    }
    public function usuario_notificaciones(){
        $user = User::find(Auth::user()->id);
        $user->notifications;
        return response()->json(['data' =>  $user->notifications]);
    }
}

