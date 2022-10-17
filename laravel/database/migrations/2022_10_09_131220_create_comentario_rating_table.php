<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quartoID');
            $table->foreignId('userID');
            $table->string('Comentario')->nullable();
            $table->integer('Rating')->nullable();
            $table->timestamps();

            $table->foreign('quartoID')->references('id')->on('quarto');
            $table->foreign('userID')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_rating');
    }
}
