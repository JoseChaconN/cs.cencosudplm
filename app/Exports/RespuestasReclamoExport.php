<?php

namespace App\Exports;

use App\Models\ReclamoLocalProblema;
#use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RespuestasReclamoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {   
        return view('reclamos.excel.respuestas-reclamo', $this->data);
    }
}
