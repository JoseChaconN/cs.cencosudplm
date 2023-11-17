<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; 


use App\Models\User;
use App\Models\UsuarioCentroCompetencia;
use App\Models\UsuarioTienda;
use App\Models\Tienda;
use App\Models\UsuarioSeccion;

class LoginController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth',['except' => ['loggear']]);
    }
    public function loggear(Request $request)
    {
        $data = $request->validate([
            'email'=> ['required','string','email'],
            'password'=> ['required','string'],
        ]);

        if(!Auth::attempt($data,false)){
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }        
        $usuario = User::findOrFail(Auth::user()->id);
        dd(1);
        User::findOrFail(Auth::user()->id);
        User::where('id', Auth::user()->id)->update(['ultima_conexion' => date('Y-m-d H:i:s')]);
        #$usuario->update(['ultima_conexion' => date('Y-m-d H:i:s')]);
        #print_r($usuario->status);
        if($usuario->status == 0){            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('notification_type', 'danger')->with('notification_message', 'Su usuario se encuentra desactivado. Por favor, contacte al supervisor/tecnólogo.');
        }
        $request->session()->regenerate();
        activity()->log('Loggin');
        session(['u_id' => Auth::user()->id]);
        session(['u_root' => $usuario->root]);
        session(['u_nombre' => $usuario->name]);
        session(['u_apellido' => $usuario->last_name]);        
        session(['u_email' => $usuario->email]);
        session(['u_cargo' => $usuario->cargo]);
        session(['u_area' => $usuario->area]);
        session(['u_perfil_cs' => $usuario->perfil_cs]);
        session(['u_perfil_aca' => $usuario->perfil_aca]);
        session(['u_perfil_cd' => $usuario->perfil_cd]);
        session(['u_rol_aca' => $usuario->rol_aca]);
        session(['u_sac' => $usuario->usuario_sac]);

        $secciones_usuario = UsuarioSeccion::where('id_usuario', Auth::user()->id)->get();
        if(!empty($secciones_usuario)){
            foreach ($secciones_usuario as $key => $value) {
                $secciones_usuario[]=$value['codigo_seccion'];
            }
            session(['u_secciones' => $secciones_usuario]);
        }
        $ccs_usuario_array=[];
        $ccs_usuario = UsuarioCentroCompetencia::where('id_usuario', Auth::user()->id)->get();
        if(!empty($ccs_usuario)){
            foreach ($ccs_usuario as $key => $value) {
                $ccs_usuario_array[]=$value['id_cc'];
            }
            session(['u_ccs' => $ccs_usuario_array]);
        }else{
            session(['u_ccs' => NULL]);
        }
        
        $tiendas_sup_usuario_q = UsuarioTienda::where('id_usuario', Auth::user()->id)->where('tipo', 'SUPERVISOR')->get();
        $tiendas_sup_usuario=[];
        if(!empty($tiendas_sup_usuario_q)){
            foreach ($tiendas_sup_usuario_q as $key => $value) {
                $tiendas_sup_usuario[]=$value['id_tienda'];
            }
        }
        session(['u_tiendas_sup' => $tiendas_sup_usuario]);
        $tiendas_usuario = UsuarioTienda::with('tienda')->where('id_usuario', Auth::user()->id)->where('tipo', 'USUARIO')->get();
        dd($tiendas_usuario);
        if(!empty($tiendas_usuario)){
            session(['tiendas_usuario' => $tiendas_usuario->tienda]);
        }
        /* foreach ($tiendas_usuario as $tienda) {
            $ids[]=$tienda->id_tienda;
        }
        if(!empty($ids)){
            $tiendas_usuario_nombre = (!empty(Tienda::whereIn('id',$ids)->get())) ? Tienda::whereIn('id',$ids)->get() : [];
            session(['tiendas_usuario' => $tiendas_usuario_nombre]);
        } */
        
        
        /* if(!empty($tiendas_usuario)){
            if(UsuarioTienda::where('id_usuario', Auth::user()->id)->where('tipo', 'USUARIO')->count() > 1){
                #return redirect()->route('home');
                return redirect()->intended();
            }else{
                foreach ($tiendas_usuario as $key => $value) {
                    $tienda = Tienda::find($value['id_tienda']);
                    session(['u_id_tienda'=> $value['id_tienda']]); 
                    session(['u_codigo_tienda' => $tienda->codigo]);
                    session(['u_nombre_tienda' => $tienda->nombre]);
                    session(['u_area_tienda' => $tienda->area]);
                    session(['u_categoria_tienda' => $tienda->categoria]);
                    session(['u_zona_tienda' => $tienda->zona]);
                }
            }
        }   */      
               
        #$data['tiendas_usuario']=Tienda::whereIn('id',$ids)->get();        
        return redirect()->intended();
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
