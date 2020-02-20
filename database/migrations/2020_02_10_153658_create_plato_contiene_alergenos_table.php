<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatoContieneAlergenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plato_contiene_alergenos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alergenos_id');
            $table->unsignedBigInteger('plate_id');
            $table->foreign('alergenos_id')->references('id')->on('alergenos');
            $table->foreign('plate_id')->references('id')->on('plate');
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
        Schema::dropIfExists('plato_contiene_alergenos');
    }
}
