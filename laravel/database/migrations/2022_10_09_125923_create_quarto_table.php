<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuartoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userID');
            $table->string('descricao');
            $table->integer('MetrosQuadrados')->default('1');
            $table->decimal('Preco')->default('1');
            $table->string('Localizacao');
            $table->boolean('CasaBanhoPrivada')->nullable();; //Boolean, ver se tem casa de banho privada ou não
            $table->boolean('Recibos')->nullable();; //Boolean, ver se passa recibos ou não
            $table->string('Sexo')->nullable();
            $table->integer('NViews')->nullable();
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quarto');
    }
}
