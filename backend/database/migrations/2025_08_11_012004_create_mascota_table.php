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
        Schema::create('mascota', function (Blueprint $table) {
            $table->id('id_mascota');
            $table->string('nom_mascota', 100);
            $table->string('raza');
            $table->integer('edad');
            $table->string('color', 30);
            $table->unsignedBigInteger('id_propietario');
            $table->timestamps();

            $table->foreign('id_propietario')->references('id_propietario')->on('propietario')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascota');
    }
};
