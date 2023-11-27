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
        <h3 style="margin-top:-5%;color:white;">Recall en Proceso N° {{$recall->id}}</h3>
        <div class="section">
            <h4>Datos del Recall</h4>
            <table>
                <tr class="spaceUnder">
                    <td><b>N° de Recall: </b>{{$recall->id}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Proveedor: </b>{{$recall->nombre_proveedor}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Rut del proveedor: </b>{{$recall->rut_proveedor}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Tipo de recall: </b>{{$recall->recall}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Descripción del problema: </b>{{$recall->problema}}</td>
                </tr>
                @php
                    $fechaInicio = strtotime($recall->momento_ingreso);
                    $fechaFin = strtotime($recall->momento_final);
                    $diferenciaSegundos = $fechaFin - $fechaInicio;
                    $diferenciaMinutos = $diferenciaSegundos / 60;
                    $diferenciaHoras = $diferenciaMinutos / 60;
                @endphp
                <tr class="spaceUnder">
                    <td><b>Tiempo de Respuesta: </b>{{$diferenciaHoras}} horas</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Fecha de Ingreso: </b>{{$recall->momento_ingreso}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Fecha de Cierre: </b>{{$recall->momento_final}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td><b>Responsable: </b>{{$recall->responsable->name.' '.$recall->responsable->last_name.' - '.$recall->responsable->email}}</td>
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
                        <td>{{$recall->lote[$producto->id]}}</td>
                        <td>{{$recall->fecha[$producto->id]}}</td>
                        <td>{{$recall->fecha_vencimiento[$producto->id]}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @if(!empty($recall->getMedia('imagenes-recall')))
            <div class="new-page"></div>
            <img src="{{public_path('/img/header-pdf.png')}}" class="header" alt="">
            <h3 style="margin-top:-5%;color:white;">Recall en Proceso N° {{$recall->id}}</h3>
            <div class="section">
                <h4>Imágenes del Recall</h4>
                @foreach ($recall->getMedia('imagenes-recall') as $item)
                    <img src="{{$item->getUrl()}}" style="max-height: 300px;max-width: auto;">
                    <br>
                    <br>
                @endforeach
            </div>
        @endif
    </body>
</html>