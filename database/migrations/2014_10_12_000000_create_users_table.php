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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('ultima_conexion')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->longtext('password')->nullable();
            $table->longtext('admin_pw')->nullable();
            $table->integer('cambio_clave')->nullable()->default(0);
            $table->string('cargo')->nullable();
            $table->string('area')->nullable();
            $table->rememberToken()->nullable();
            $table->integer('root')->nullable();
            $table->integer('admin')->nullable();
            $table->integer('tecnologo_cd')->unsigned()->nullable();
            $table->integer('status')->default(1);            
        });
        DB::table('users')->insert([
                ['name' => 'Jose','last_name' => 'Chacon', 'email' => 'sischaconn@gmail.com', 'password' =>bcrypt('cencosud'), 'cargo' => 'Administrador', 'created_at' => now(),'updated_at' => now() , 'root' => 1]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};