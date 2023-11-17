<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $rol_admin = Role::create(['name' => 'admin']);
        $rol_administrador = Role::create(['name' => 'administrador']);
        
        #ROL REPORTES SUPERVISOR
        $rol_reportes_todos_reclamos = Role::create(['name' => 'supervisor reportes reclamos']);
        $rol_reportes_todos_recalls = Role::create(['name' => 'supervisor reportes recalls']);
        $rol_reportes_todos_rechazos = Role::create(['name' => 'supervisor reportes rechazos']);

        #ROL CS
        $rol_tecnologo = Role::create(['name' => 'tecnólogo']);
        $rol_tienda = Role::create(['name' => 'tienda']);
        $rol_supervisor = Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'rechazos']);
        
        #ROL ACA
        $rol_calidad = Role::create(['name' => 'calidad']);
        $rol_comercial = Role::create(['name' => 'comercial']);
        $rol_auditor = Role::create(['name' => 'auditor']);
        $rol_aca = Role::create(['name' => 'aca']);
        $rol_aca_importado = Role::create(['name' => 'aca importado']);

        #ROL CD
        $rol_inspecciones = Role::create(['name' => 'inspecciones']);
        $rol_recepciones = Role::create(['name' => 'recepciones']);

        $rol_tecnologo_inspeccion = Role::create(['name' => 'tecnólogo inspección']);
        $rol_tecnologo_recepciones = Role::create(['name' => 'tecnólogo recepción']);

        #PERMISOS PARA CS
            #PERMISOS PARA MODULO RECLAMOS
                Permission::create(['name' => 'preReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);
                Permission::create(['name' => 'crearReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);
                Permission::create(['name' => 'listAprobarReclamo'])->syncRoles([$rol_admin,$rol_supervisor]);
                Permission::create(['name' => 'listProcesoReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'procesoReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'listCerradoReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'cerradoReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'pdfReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);

            #PERMISOS PARA MODULO RECALLS
                Permission::create(['name' => 'preRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'nuevoRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'listRecalls'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'procesoRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'respuestaRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);
                Permission::create(['name' => 'pdfRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'pdfRespuestaRecall'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);

            #PERMISOS PARA MODULO RECHAZOS
                Permission::create(['name' => 'preRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'nuevoRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'listCerradoRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'procesoRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'listProcesoRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'cerradoRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
                Permission::create(['name' => 'mesSinRechazo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
            #PERMISOS PARA MODULO USUARIOS
                Permission::create(['name' => 'listUsuarios'])->syncRoles([$rol_admin]);
                Permission::create(['name' => 'editUsuario']);
                Permission::create(['name' => 'nuevoUsuario'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor]);
            #PERMISOS PARA MODULO PRODUCTOS
                Permission::create(['name' => 'listProductos'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'editProducto'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'nuevoProducto'])->syncRoles([$rol_admin,$rol_administrador]);
            #PERMISOS PARA MODULO TIENDAS
                Permission::create(['name' => 'listTiendas'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'nuevaTienda'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'editTienda'])->syncRoles([$rol_admin,$rol_administrador]);
            #PERMISOS PARA MODULO PROVEEDORES
                Permission::create(['name' => 'listProveedores'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'editProveedor'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'nuevoProveedor'])->syncRoles([$rol_admin,$rol_administrador]);
            #PERMISOS PARA MODULO CENTROS COMPETENCIA
                Permission::create(['name' => 'listCentrosCompetencia'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'nuevoCentroCompetencia'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'editCentroCompetencia'])->syncRoles([$rol_admin,$rol_administrador]);
            #PERMISOS PARA MODULO CENTROS COMPETENCIA
                Permission::create(['name' => 'listSecciones'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'nuevaSeccion'])->syncRoles([$rol_admin,$rol_administrador]);
                Permission::create(['name' => 'editSeccion'])->syncRoles([$rol_admin,$rol_administrador]);            
         
        
               
        #PERMISOS PARA ACA
            #PERMISOS PARA MODULO PROSPECTO
                #Permission::create(['name' => 'preReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);
                #Permission::create(['name' => 'crearReclamo'])->syncRoles([$rol_admin,$rol_administrador,$rol_tecnologo,$rol_supervisor,$rol_tienda]);
                #Permission::create(['name' => 'listAprobarReclamo'])->syncRoles([$rol_admin,$rol_supervisor]);

   }
}
