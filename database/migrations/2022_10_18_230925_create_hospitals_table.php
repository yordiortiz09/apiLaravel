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
         Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_de_seguro');
           $table->foreign('no_de_seguro')->references('id')->on('seguros');
            $table->integer('numero_de_seo');
            $table->string('nombre_del_hospital',100);
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
        Schema::dropIfExists('hospitals');
    }
};
