<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatoRealidadAumentadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plato_realidad_aumentadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plate_id');
            $table->unsignedBigInteger('realidadaumentada_id');
            $table->foreign('plate_id')->reference('id')->on('plate');
            $table->foreign('realidadaumentada_id')->reference('id')->on('realidad_aumentadas');
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
        Schema::dropIfExists('plato_realidad_aumentadas');
    }
}
