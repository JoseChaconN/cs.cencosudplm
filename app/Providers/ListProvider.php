<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ListProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //

        $this->app->bind('filetypes', function () {
            return [
                'image' => ['jpg','jpeg', 'png', 'gif'],
                'document' => ['pdf', 'doc', 'docx', 'txt'],
                // Agrega aquí más tipos de archivos según tus necesidades.
            ];
        });

        $unidades_medida[] = ['val' => 'KG' , 'text' => 'Kg'];
        $unidades_medida[] = ['val' => 'UNIDAD' , 'text' => 'Unidad'];
        $unidades_medida[] = ['val' => 'L' , 'text' => 'L'];
        $unidades_medida[] = ['val' => 'CS' , 'text' => 'Cs'];

        $meses_array = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];

        $zonas_tienda[] = ['val' => 'CENTSUR' , 'text' => 'Centro Sur' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 'EXTSUR' , 'text' => 'Extremo Sur' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 'NORTE' , 'text' => 'Norte' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 'ORIENTE' , 'text' => 'Santiago Oriente' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 'PONIENTE' , 'text' => 'Santiago Poniente' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 'BODEGAS' , 'text' => 'Bodegas' , 'area' => ' JUMBO'];
        $zonas_tienda[] = ['val' => 1 , 'text' => 'Division 1' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 2 , 'text' => 'Division 2' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 3 , 'text' => 'Division 3' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 4 , 'text' => 'Division 4' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 5 , 'text' => 'Division 5' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 6 , 'text' => 'Division 6' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 7 , 'text' => 'Division 7' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 8 , 'text' => 'Division 8' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 9 , 'text' => 'Division 9' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 10 , 'text' => 'Division 10' , 'area' => 'SISA'];
        $zonas_tienda[] = ['val' => 11 , 'text' => 'Division 11' , 'area' => 'SISA'];

        $tipo_producto[] = ['val' => 'CONSUMO MASIVO' , 'text' => 'Consumo Masivo'];
        $tipo_producto[] = ['val' => 'PECERIBLES' , 'text' => 'Perecibles'];
        $tipo_producto[] = ['val' => 'NO PECERIBLES' , 'text' => 'No Perecibles'];
        $tipo_producto[] = ['val' => 'NON FOOD' , 'text' => 'Non Food'];

        // Compartir la variable de países con todas las vistas
        $view = view();
        $view->share('unidades_medida', $unidades_medida);
        $view->share('meses_array', $meses_array);
        $view->share('zonas_tienda', $zonas_tienda);
        $view->share('tipo_producto', $tipo_producto);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
