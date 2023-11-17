<?php

namespace App\Http\Controllers;

use App\Models\Frigorifico;
use App\Models\FrigorificoRazonSocial;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class FrigorificosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function frigorificos_list_json(Request $request)
    {
        $pais = $request->input('code_pais');        
        $data['frigorificos']= Frigorifico::with(['razones_sociales' => function ($query) use ($pais) {
            $query->where('pais', $pais); // Filtrar las razones sociales por país ('Argentina')
        }])->get();
        
        /*$data['frigorificos'] = Frigorifico::select('frigorificos.*')
                                            ->distinct('tabla1.id') // Distinct para seleccionar registros únicos de tabla1
                                            ->leftJoin('frigorificos_razones_sociales', 'frigorificos.id', '=', 'frigorificos_razones_sociales.id_frigorifico')
                                            ->whereNotNull('frigorificos_razones_sociales.id_frigorifico') // Filtrar solo registros que coinciden con tabla2
                                            ->get();
        $data['razones_sociales'] = Frigorifico::where('frigorificos.status', 1)
                                    ->where('frigorificos_razones_sociales.status', 1)
                                    ->join('frigorificos_razones_sociales', 'frigorificos.id', '=', 'frigorificos_razones_sociales.id_frigorifico')
                                    ->select('frigorificos.*','frigorificos_razones_sociales.id AS id_razon_social','frigorificos_razones_sociales.razon_social','frigorificos_razones_sociales.rut','frigorificos_razones_sociales.marca','frigorificos_razones_sociales.sif')
                                    ->get();*/
        return response()->json($data);
    }
}