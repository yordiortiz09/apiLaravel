<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->string('duracion',40);
            $table->text('preparacion');
            $table->unsignedBigInteger('chef');
            $table->unsignedBigInteger('ingrediente');
            $table->unsignedBigInteger('tipo_plato');
            $table->foreign('ingrediente')->references('id')->on('ingredientes');
            $table->foreign('tipo_plato')->references('id')->on('tipo_platos');
            $table->foreign('chef')->references('id')->on('chefs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_recetas');
    }
};
