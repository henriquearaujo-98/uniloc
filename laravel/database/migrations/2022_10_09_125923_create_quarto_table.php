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
            $table->string('descricao');
            $table->integer('MetrosQuadrados', ['default' => 0, 'total' => 3]);
            $table->decimal('Preco', ['default' => 0, 'total' => 8, 'places' => 2]);
            $table->string('Localizacao');
            $table->boolean('CasaBanhoPrivada')->nullable();; //Boolean, ver se tem casa de banho privada ou não
            $table->boolean('Recibos')->nullable();; //Boolean, ver se passa recibos ou não
            $table->string('Sexo')->nullable();
            $table->foreign('userID')->references('id')->on('users');
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
        Schema::dropIfExists('quarto');
    }
}
