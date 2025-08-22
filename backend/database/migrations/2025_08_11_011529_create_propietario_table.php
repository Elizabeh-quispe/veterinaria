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
        Schema::create('propietario', function (Blueprint $table) {
            $table->id('id_propietario');
            $table->string('nombre',100);
            $table->string('apellido_p',100);
            $table->string('apellido_m',100);
            $table->string('direccion');
            $table->string('ci',20);
            $table->string('telefono',20);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietario');
    }
};
