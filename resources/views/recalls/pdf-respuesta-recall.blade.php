<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .new-page{
            page-break-after: always;
        }
        .header{
            margin-left: -7%;
            margin-top:-7%;
            width: 120%; 
            height: auto;
        }
        tr.spaceUnder>td {
            padding-bottom: 1em;
        }        
    </style>   
</head>

    <body style="font-family: helvetica"> 
        <img src="{{public_path('/img/header-pdf.png')}}" class="header" alt="">
        <h3 style="margin-top:-5%;color:white;">Recall en Proceso N° {{$respuesta_recall->id}}</h3>
        <div class="section">
            <h2 style="margin-left: 30%">Certificado de Gestión</h2>
            <h4>Datos del Recall</h4>
            <table>
                <tr class="spaceUnder">
                    <td><b>N° de Recall: </b>{{$respuesta_recall->recall->id}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Proveedor: </b>{{$respuesta_recall->recall->nombre_proveedor}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Rut del proveedor: </b>{{$respuesta_recall->recall->rut_proveedor}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Tipo de recall: </b>{{$respuesta_recall->recall->recall}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Descripción del problema: </b>{{$respuesta_recall->recall->problema}}</td>
                </tr>
                @php
                    $fechaInicio = strtotime($respuesta_recall->recall->momento_ingreso);
                    $fechaFin = strtotime($respuesta_recall->recall->momento_final);
                    $diferenciaSegundos = $fechaFin - $fechaInicio;
                    $diferenciaMinutos = $diferenciaSegundos / 60;
                    $diferenciaHoras = $diferenciaMinutos / 60;
                @endphp
                <tr class="spaceUnder">
                    <td><b>Tiempo de Respuesta: </b>{{$diferenciaHoras}} horas</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Fecha de Ingreso: </b>{{$respuesta_recall->recall->momento_ingreso}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Fecha de Cierre: </b>{{$respuesta_recall->recall->momento_final}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Local: </b>{{$respuesta_recall->nombre_local.' - '.$respuesta_recall->codigo_local}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Responsable: </b>{{$respuesta_recall->responsable.' - '.$respuesta_recall->responsable_email}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Fecha de Respuesta: </b>{{date('d-m-Y H:i:s' , strtotime($respuesta_recall->created_at))}}</td>
                </tr>
            </table>
            <h4>Productos Asociados al Recall</h4>
            <table border="0.1" cellpadding="5" style="font-size: 12px">
                <tr class="spaceUnder" style="background-color: rgb(53, 73, 90);color: white;font-weight: bold;">
                    <td><b>Producto</b></td>
                    <td><b>EAN</b></td>
                    <td><b>Marca</b></td>
                    <td><b>Lote</b></td>
                    <td><b>Fecha elaboración</b></td>
                    <td><b>Fecha vencimiento</b></td>
                </tr>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->ean}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$respuesta_recall->lote[$producto->id]}}</td>
                        <td>{{$respuesta_recall->fecha_elaboracion[$producto->id]}}</td>
                        <td>{{$respuesta_recall->fecha_vencimiento[$producto->id]}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>