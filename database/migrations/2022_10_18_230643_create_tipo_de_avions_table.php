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
          //
          Schema::create('tipo_de_avions', function (Blueprint $table) {
            $table->id();
                $table->unsignedBigInteger('id_piloto');
               $table->foreign('id_piloto')->references('id')->on('conductors');
                $table->string('Airolinea',50);
                $table->boolean('status')->default(1);
               
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
        Schema::dropIfExists('tipo_de_avions');
    }
};
