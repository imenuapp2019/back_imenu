<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPlateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_plate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('plate_id');
            $table->foreign('menu_id')->references('id')->on('menu');
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
        Schema::dropIfExists('menu_plate');
    }
}
