<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();          
            $table->integer('reclamo_api')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('nombre_producto')->nullable();
            $table->string('ean_producto')->nullable();
            $table->string('sap_producto')->nullable();
            $table->string('marca_producto')->nullable();
            $table->string('submarca_producto')->nullable();
            $table->integer('id_proveedor')->nullable();
            $table->string('nombre_proveedor')->nullable();
            $table->string('rut_proveedor')->nullable();
            $table->integer('id_frigorifico')->nullable();
            $table->string('frigorifico')->nullable();
            $table->integer('razon_social')->nullable();
            $table->string('sif')->nullable();
            $table->string('marca_frigorifico')->nullable();
            $table->integer('id_seccion')->nullable();
            $table->string('caso_atento')->nullable();
            $table->string('posible_recall')->nullable();
            $table->string('agregar_reclamos')->nullable();
            $table->string('mensaje_atento')->nullable();
            $table->string('razon_rechazo_recall')->nullable();
            $table->string('es_importado')->nullable();
            $table->string('interno_externo')->nullable();
            $table->string('tipo_propia')->nullable();
            $table->string('locales_lotes')->nullable();
            $table->string('lote')->nullable();
            $table->string('aplica_temperatura')->nullable();
            $table->string('aplica_carnes')->nullable();
            $table->string('despacho')->nullable();
            $table->string('formal_informal')->nullable();
            $table->string('numero_entrega')->nullable();
            $table->string('origen')->nullable();
            $table->string('origen_venta')->nullable();
            $table->string('origen_venta_tienda')->nullable();           
            $table->string('tipo')->nullable();
            $table->string('status')->nullable();
            $table->string('doble_garantia')->nullable();
            $table->string('gestion_sac')->nullable();
            $table->string('otro_doble_garantia')->nullable();
            $table->string('entrega')->nullable();
            $table->string('transportes')->nullable();
            $table->string('guia_despacho')->nullable();
            $table->string('referencia')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('nombre_tienda')->nullable();
            $table->date('reclamo_fecha')->nullable();
            $table->string('lote_fecha')->nullable();
            $table->string('elaboracion')->nullable();
            $table->string('vencimiento')->nullable();
            $table->longText('descripcion_reclamo')->nullable();
            $table->longText('descripcion_breve')->nullable();
            $table->longText('observaciones_cliente')->nullable();
            $table->longText('motivo_reclamo')->nullable();
            $table->string('tipo_reclamo')->nullable();
            $table->integer('id_responsable')->nullable();
            $table->integer('id_aprobador')->nullable();
            $table->integer('id_responsable_rechazo')->unsigned()->nullable();
            $table->string('mensaje_rechazo', 250)->nullable();
            $table->date('fecha_rechazo')->nullable();
            $table->string('nombre_cliente')->nullable();
            $table->string('telefono_cliente')->nullable();
            $table->string('mail_cliente')->nullable();
            $table->string('direccion_cliente')->nullable();
            $table->string('rut_cliente')->nullable();
            $table->string('ejecutivo_cliente')->nullable();            
            $table->string('aplica_proveedor')->nullable();
            $table->string('aplica_proveedor_derivar')->nullable();
            $table->string('aplica_cliente')->nullable();
            $table->string('no_obs')->nullable();
            $table->date('fecha_contacto_prov')->nullable();
            $table->longText('obs_prov')->nullable();
            $table->date('fecha_respuesta_prov')->nullable();
            $table->string('acciones_prov')->nullable();
            $table->longText('obs_cliente')->nullable();
            $table->longText('obs_cliente_2')->nullable();
            $table->longText('obs_cliente_3')->nullable();
            $table->longText('obs_general')->nullable();
            $table->date('fecha_cerrado')->nullable();
            $table->integer('id_local')->nullable();
            $table->string('nombre_local')->nullable();
            $table->string('codigo_local')->nullable();
            $table->longText('archivo')->nullable();
            $table->longText('documento_adjunto')->nullable();
            $table->longText('imagen_adjunto')->nullable();
            $table->string('planta_origen')->nullable();
            $table->date('fecha_local')->nullable();
            $table->string('formato')->nullable();
            $table->decimal('cantidad_problema',5,2)->nullable();
            $table->string('unidad_cantidad_problema')->nullable();
            $table->string('comentario_cantidad_problema')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->string('muestra')->nullable();
            $table->date('recepcion')->nullable();
            $table->string('camaras')->nullable();
            $table->string('vitrina')->nullable();
            $table->date('fecha_faena')->nullable();
            $table->string('cantidad_recibida')->nullable();
            #$table->decimal('cantidad_recibida',5,2)->nullable();
            #$table->string('unidad_cantidad_recibida')->nullable();
            #$table->string('comentario_cantidad_recibida')->nullable();
            $table->longText('mensaje')->nullable();
            $table->longText('documento_adjunto_log_imp')->nullable();
            $table->longText('msj_log_imp')->nullable();
            $table->date('fecha_resp_msj_log_imp')->nullable();
            $table->integer('responsable_cierre')->nullable();
            $table->integer('reiteracion_alert')->nullable();
            $table->string('consumidor_involucrado')->nullable();
            $table->string('nombre_consumidor')->nullable();
            $table->string('telefono_consumidor')->nullable();
            $table->string('direccion_consumidor')->nullable();
            $table->string('rut_consumidor')->nullable();
            $table->string('ejecutivo_responsable_sac')->nullable();
            $table->string('ejecutivo_responsable_hold')->nullable();
            $table->string('n_boleta')->nullable();
            $table->string('vale_cambio')->nullable();
            $table->string('valor_vale')->nullable();
            $table->integer('sac')->comment('SABER SI ES UN RECLAMO INGRESADO POR USUARIO SAC')->nullable();
            $table->string('reclamo_callcenter')->nullable();
            $table->string('n_reclamo_call_center')->nullable();
            $table->string('tipo_reclamo_sac')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->string('estado_previo')->nullable();
            $table->string('frigorifico_Sac')->nullable();
            $table->string('firgorifico_marca_sac')->nullable();
            $table->decimal('cantidad_problema_cliente',5,2)->nullable();
            $table->string('unidad_cantidad_problema_cliente')->nullable();
            $table->string('comentario_cantidad_problema_cliente')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};
