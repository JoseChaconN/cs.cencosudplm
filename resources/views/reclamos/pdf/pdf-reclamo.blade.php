<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .new-page{
            page-break-after: always;
        }
        .fondo-header{
            margin-left: -7%;
            margin-top:-7%;
            width: 120%;
            height: auto;
            position: fixed;
        }
        .logo-header{
            position: fixed;
        }
        .logo-general{
            margin-left: 80%;
            margin-top:-5%;
            width: 100px;
            height: auto;
        }
        .logo-sisa{
            margin-left: 80%;
            margin-top:-5%;
            width: 100px;
            height: auto;
        }
        .logo-jumbo{
            margin-left: 80%;
            margin-top:-5%;
            width: 100px;
            height: auto;
        }
        .tittle-header{
            margin-top:0%;
            color:white;
            position: fixed;
        }
        .fondo-footer{
            margin-left: -7%;
            margin-top:145%;
            width: 120%;
            height: auto;
            position: fixed;
        }
        tr.spaceUnder>td {
            padding-bottom: 1em;
        }
        body{
            /*font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;*/
            /*font-family: Arial, Helvetica, sans-serif*/
            font-family: Verdana, Geneva, Tahoma
        }
    </style>
</head>

<body>
    <img src="{{public_path('/img/pdf/'.$fondo)}}" class="fondo-header" alt="">
    <img src="{{public_path('/img/pdf/'.$logo)}}" class="logo-header {{ $logo_class }}" alt="">
    <img src="{{public_path('/img/pdf/'.$fondo)}}" class="fondo-footer" alt="">
    <h3 class="tittle-header">Reclamo {{($reclamo->status == 'PROCESO') ? 'en Proceso' : 'Cerrado'}} N° {{$reclamo->id}}</h3>
    <div class="section">
        <br>
        <h4>Información del producto</h4>
        <table cell>
            <tr class="spaceUnder">
                <td><b>Local: </b>{{$reclamo->tienda->nombre.' - '.$reclamo->tienda->codigo}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Nombre producto: </b>{{$reclamo->nombre_producto}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>EAN 13: </b>{{$reclamo->ean_producto}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Código SAP: </b>{{$reclamo->sap_producto}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>¿Producto es importado:? </b>{{ Str::ucfirst($reclamo->es_importado) }}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>¿Cliente es:? </b>{{$reclamo->interno_externo}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Tipo de despacho: </b>{{$reclamo->despacho}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>El cliente solicita respuesta a su reclamo: </b>{{$reclamo->formal_informal}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Proveedor: </b>{{$reclamo->nombre_proveedor}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Rut del proveedor: </b>{{$reclamo->rut_proveedor}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Origen del reclamo: </b>{{$reclamo->origen_reclamo->nombre}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Área del reclamo: </b>{{$reclamo->categoria}}</td>
            </tr>
        </table>
    </div>
    <div class="new-page"></div>
    <div class="section">
        <br>
        <h4>Detalle del problema</h4>
        <table>
            <tr class="spaceUnder">
                <td><b>N° del reclamo: </b>{{$reclamo->id}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Local: </b>{{$reclamo->tienda->nombre.' - '.$reclamo->tienda->codigo}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Sección: </b>{{$reclamo->seccion->nombre}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Fecha del reclamo: </b>{{date('d-m-Y', strtotime($reclamo->reclamo_fecha))}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Lote: </b>{{$reclamo->lote}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Elaboración: </b>{{$reclamo->elaboracion}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Vencimiento o Duración: </b>{{$reclamo->vencimiento}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Descripción del reclamo: </b>{{$reclamo->descripcion_reclamo}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Observaciones del cliente: </b>{{$reclamo->observaciones_cliente}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Motivo del reclamo: </b>{{$reclamo->motivo_reclamo}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Cantidad total con problemas en el local: </b>{{$reclamo->cantidad_problema.' '.$reclamo->unidad_cantidad_problema}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Responsable: </b>{{$reclamo->responsable->name.' '.$reclamo->responsable->last_name.' - '.$reclamo->responsable->email}}</td>
            </tr>
        </table>
    </div>
    <div class="new-page"></div>
    <div class="section">
        <br>
        <br>
        <table>
            <tr>
                <td><b>¿Existe información sobre el cliente?: </b>{{ Str::ucfirst($reclamo->aplica_cliente) }}</td>
            </tr>
            @if ($reclamo->aplica_cliente === 'sí')
                <tr>
                    <td><h4>Información del cliente</h4></td>
                </tr>
                <tr class="spaceUnder">
                    <td style="padding-left: 25px"><b>Nombre del cliente: </b>{{$reclamo->nombre_cliente}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td style="padding-left: 25px"><b>Rut cliente: </b>{{$reclamo->rut_cliente}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td style="padding-left: 25px"><b>Télefono cliente: </b>{{$reclamo->telefono_cliente}}</td>
                </tr>
                <tr class="spaceUnder">
                    <td style="padding-left: 25px"><b>Dirección cliente: </b>{{$reclamo->direccion_cliente}}</td>
                </tr>
            @endif            
            <tr>
                <td><b>¿Aplica a proveedor?: </b>{{ Str::ucfirst($reclamo->aplica_proveedor_derivar)}}</td>
            </tr>
        </table>
        <hr>
        @if (!empty($reclamo->obs_cliente) || !empty($reclamo->obs_cliente_2) || !empty($reclamo->obs_cliente_3))
            <h4>Contacto con cliente</h4>
            <table>
                @if (!empty($reclamo->obs_cliente))
                    <tr class="spaceUnder">
                        <td style="padding-left: 25px"><b>Primer contacto: </b>{{$reclamo->obs_cliente}}</td>
                    </tr>
                @endif
                 @if (!empty($reclamo->obs_cliente_2))
                    <tr class="spaceUnder">
                        <td style="padding-left: 25px"><b>Segundo contacto: </b>{{$reclamo->obs_cliente_2}}</td>
                    </tr>
                @endif
                 @if (!empty($reclamo->obs_cliente_3))
                    <tr class="spaceUnder">
                        <td style="padding-left: 25px"><b>Tercer contacto: </b>{{$reclamo->obs_cliente_3}}</td>
                    </tr>
                @endif
            </table>
        @endif
        <h4>Observaciones generales</h4>
        <table>
            <tr class="spaceUnder">
                <td>{{$reclamo->obs_general}}</td>
            </tr>
            <tr class="spaceUnder">
                <td><b>Gestión presencial: </b>{{$reclamo->doble_garantia}}</td>
            </tr>
        </table>
    </div>
    @if(!empty($reclamo->getMedia('imagenes_reclamos')))
        <div class="new-page"></div>
        <div class="section">
            <br>
            <h4>Imágenes del reclamo</h4>
        </div>
        @foreach ($reclamo->getMedia('imagenes_reclamos') as $item)
            <img src="{{$item->getUrl()}}" style="max-height: 300px;max-width: auto;">
            <br>
            <br>
        @endforeach
    @endif
</body>
</html>