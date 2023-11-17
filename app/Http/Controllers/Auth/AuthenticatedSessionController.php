<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Events\UserLoggedIn;
use App\Models\User;
use App\Models\UsuarioCentroCompetencia;
use App\Models\UsuarioTienda;
use App\Models\Tienda;
use App\Models\UsuarioSeccion;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        #dd(Auth::user());
        #event(new UserLoggedIn(Auth::user()));
        #$usuario = User::findOrFail(Auth::user()->id);
       # $usuario->update(['ultima_conexion' => date('Y-m-d H:i:s')]);
        #dd($usuario);
        #$usuario = User::findOrFail(Auth::user()->id);
        #User::findOrFail(Auth::user()->id);
        #User::where('id', Auth::user()->id)->update(['ultima_conexion' => date('Y-m-d H:i:s')]);
        #Auth::user()->update(['ultima_conexion' => date('Y-m-d H:i:s')]);
        session(['u_id' => Auth::user()->id]);
        session(['u_root' => Auth::user()->root]);
        session(['u_nombre' => Auth::user()->name]);
        session(['u_apellido' => Auth::user()->last_name]);        
        session(['u_email' => Auth::user()->email]);
        session(['u_cargo' => Auth::user()->cargo]);
        session(['u_area' => Auth::user()->area]);
        session(['u_perfil_cs' => Auth::user()->perfil_cs]);
        session(['u_perfil_aca' => Auth::user()->perfil_aca]);
        session(['u_perfil_cd' => Auth::user()->perfil_cd]);
        session(['u_rol_aca' => Auth::user()->rol_aca]);
        session(['u_sac' => Auth::user()->usuario_sac]);

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
        $tiendas_usuario_array=[];
        
        if(!empty($tiendas_usuario)){
            $key=0;
            foreach ($tiendas_usuario as $value) {
                if ($key === 0) {
                    // Acciones a realizar solo en la primera posición
                    session(['u_id_tienda' => $value->tienda->id]);
                    session(['u_codigo_tienda' => $value->tienda->codigo]);
                    session(['u_nombre_tienda' => $value->tienda->nombre]);
                    session(['u_area_tienda' => $value->tienda->area]);
                    session(['u_categoria_tienda' => $value->tienda->categoria]);
                    session(['u_zona_tienda' => $value->tienda->zona]);
                    session(['u_tipo_tienda' => $value->tienda->tipo]);
                }
                $key++;
                $tiendas_usuario_array[]=$value->tienda;
            }            
        }
        session(['tiendas_usuario' => $tiendas_usuario_array]);
        /* $tiendas_usuario = UsuarioTienda::where('id_usuario', Auth::user()->id)->where('tipo', 'USUARIO')->get();
        foreach ($tiendas_usuario as $tienda) {
            $ids[]=$tienda->id_tienda;
        }
        if(!empty($ids)){
            $tiendas_usuario_nombre = (!empty(Tienda::whereIn('id',$ids)->get())) ? Tienda::whereIn('id',$ids)->get() : [];
            session(['tiendas_usuario' => $tiendas_usuario_nombre]);
        }
        
        
        if(!empty($tiendas_usuario)){
            if(UsuarioTienda::where('id_usuario', Auth::user()->id)->where('tipo', 'USUARIO')->count() > 1){
                #return redirect()->route('home');
                return redirect()->intended();
            }else{
                foreach ($tiendas_usuario as $key => $value) {
                    $tienda = Tienda::find($value['id_tienda']);
                    session(['u_id_tienda'=>$value['id_tienda']]); 
                    session(['u_codigo_tienda' => $tienda->codigo]);
                    session(['u_nombre_tienda' => $tienda->nombre]);
                    session(['u_area_tienda' => $tienda->area]);
                    session(['u_categoria_tienda' => $tienda->categoria]);
                    session(['u_zona_tienda' => $tienda->zona]);
                }
            }
        } */

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
