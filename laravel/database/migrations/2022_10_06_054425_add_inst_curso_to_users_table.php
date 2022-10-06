<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstCursoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('instituicao_ID')->nullable();
            $table->foreign('instituicao_ID')->references('ID')->on('instituicoes');

            $table->integer('curso_ID')->nullable();
            $table->foreign('curso_ID')->references('ID')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['instituicao_ID']);
            $table->dropColumn('instituicao_ID');
            $table->dropForeign(['curso_ID']);
            $table->dropColumn(['curso_ID']);
        });
    }
}
