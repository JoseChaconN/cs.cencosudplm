<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;



class ChartController extends BaseController
{
    public function index()
    {
        $pdf = \PDF::loadView('charts.chartjs');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 15000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('chart.pdf');
    }

    public function ver()
    {
        #$pdf = \PDF::loadView('charts.chartjs');
        #$pdf->setOption('enable-javascript', true);
        #$pdf->setOption('javascript-delay', 5000);
        #$pdf->setOption('enable-smart-shrinking', true);
        #$pdf->setOption('no-stop-slow-scripts', true);
        #return $pdf->download('chart.pdf');
        return view('charts.chartjs');
    }
}