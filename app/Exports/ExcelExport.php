<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExcelExport implements FromView
{
    private $template;
    private $data;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function view(): View
    {
        // Seleccionar la vista Blade y pasar los datos correspondientes según la plantilla deseada
        switch ($this->template) {
            case 'seccion':
                return view('reportes.reclamos.excel.seccion', $this->data);
            case 'comercial':
                return view('reportes.reclamos.excel.comercial', $this->data);
            case 'ciclo3':
                return view('reportes.reclamos.excel.ciclo-3', $this->data);
            case 'analisis-quejas-sac':
                return view('reportes.reclamos.excel.analisis-quejas-sac', $this->data);
            case 'proveedores':
                return view('reportes.reclamos.excel.proveedores', $this->data);
            case 'logistica':
                return view('reportes.reclamos.excel.logistica', $this->data);
            case 'logistica-seccion':
                return view('reportes.reclamos.excel.logistica-seccion', $this->data);
            case 'sac':
                return view('reportes.reclamos.excel.sac', $this->data);
            case 'mp-general':
                return view('reportes.reclamos.excel.mp-general', $this->data);
            case 'respuesta-recall':
                return view('reportes.recalls.excel.respuesta-recall', $this->data);
            // Agregar más casos según las plantillas que tengas
            default:
                return view('default_template', $this->data);
        }
    }
}