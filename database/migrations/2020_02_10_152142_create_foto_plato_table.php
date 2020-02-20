<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoPlatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_plato', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('URL');
            $table->unsignedBigInteger('plate_id');
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
        Schema::dropIfExists('foto_plato');
    }
}
