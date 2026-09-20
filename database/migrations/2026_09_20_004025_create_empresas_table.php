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
            $table->string('nit');
            $table->string('nombre');
            $table->string('email');
            $table->string('sitio_web');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('logo');
            $table->foreignId('ciudad_id')->constrained('ciudades');
            $table->foreignId('empresa_tipo_id')->constrained('empresa_tipos');
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
