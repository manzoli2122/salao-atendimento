<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtendimentosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('atendimentos_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor', 15, 8);
            $table->integer('quantidade')->default(1);

            $table->double('valor_unitario', 15, 8);
            $table->double('desconto', 15, 8)->default(0.0);
            $table->double('acrescimo', 15, 8)->default(0.0);

            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('produto_id');
            $table->unsignedInteger('atendimento_id');            
            
            //$table->boolean('arquivado')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('atendimento_id')->references('id')->on('atendimentos')->onDelete('cascade');            
            $table->foreign('produto_id')->references('id')->on('produtos');
        });






        Schema::create('atendimentos_produtos_temp', function (Blueprint $table) {
            $table->increments('id');            
            $table->double('desconto', 15, 8)->default(0.0);
            $table->integer('quantidade')->default(1);
            $table->double('acrescimo', 15, 8)->default(0.0);
            
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('produto_id');
            $table->unsignedInteger('atendimento_id');            
            
            $table->timestamps();
            
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('atendimento_id')->references('id')->on('atendimentos_temp')->onDelete('cascade');            
            $table->foreign('produto_id')->references('id')->on('produtos');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimentos_produtos');
        Schema::dropIfExists('atendimentos_produtos_temp');
    }
}
