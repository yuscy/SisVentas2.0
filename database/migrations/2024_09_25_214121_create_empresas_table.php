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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'pais');
            $table->string(column: 'nombre_empresa');
            $table->string(column: 'tipo_empresa');
            $table->string(column: 'nit')->unique();
            $table->string(column: 'telefono');
            $table->string(column: 'correo')->unique();
            $table->integer(column: 'cantidad_impuesto');
            $table->string(column: 'nombre_impuesto');
            $table->string(column: 'moneda');
            $table->string(column: 'direccion');
            $table->string(column: 'ciudad');
            $table->string(column: 'departamento');
            $table->string(column: 'codigo_postal');
            $table->text(column: 'logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
