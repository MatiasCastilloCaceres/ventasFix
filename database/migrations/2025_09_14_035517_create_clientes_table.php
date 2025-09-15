<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('rut_empresa')->unique();
            $table->string('rubro');
            $table->string('razon_social');
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->string('nombre_contacto');
            $table->string('email_contacto');
            $table->timestamps();

            $table->index(['rut_empresa']);
            $table->index(['email_contacto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
