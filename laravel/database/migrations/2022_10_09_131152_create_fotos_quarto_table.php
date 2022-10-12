<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosQuartoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_quarto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quartoID');
            $table->string('PATH');
            $table->string('Name');
            $table->timestamps();

            $table->foreign('quartoID')->references('id')->on('quarto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_quarto');
    }
}
