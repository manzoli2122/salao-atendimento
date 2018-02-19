<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor', 15, 8);
            $table->unsignedInteger('cliente_id');
            $table->boolean('arquivado')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('users');
        });

        Schema::create('atendimentos_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor', 15, 8);
            $table->unsignedInteger('cliente_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimentos_temp');
        Schema::dropIfExists('atendimentos');
    }
}
