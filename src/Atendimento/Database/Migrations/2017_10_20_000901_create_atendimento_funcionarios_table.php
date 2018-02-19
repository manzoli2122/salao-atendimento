<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtendimentoFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimento_funcionarios', function (Blueprint $table) {
            $table->increments('id');           
            $table->double('valor', 15, 8);

            $table->integer('quantidade')->default(1);
            
            $table->double('valor_unitario', 15, 8);
            $table->double('desconto', 15, 8)->default(0.0);
            $table->double('acrescimo', 15, 8)->default(0.0);


            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('funcionario_id');
            $table->unsignedInteger('atendimento_id');
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('salario_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('funcionario_id')->references('id')->on('users');
            $table->foreign('atendimento_id')->references('id')->on('atendimentos')->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('salario_id')->references('id')->on('despesas');


        });



        Schema::create('atendimento_funcionarios_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->double('desconto', 15, 8);             
            $table->integer('quantidade')->default(1);
            $table->double('acrescimo', 15, 8)->default(0.0);

            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('funcionario_id');
            $table->unsignedInteger('atendimento_id');
            $table->unsignedInteger('servico_id');
            //$table->unsignedInteger('salario_id')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('funcionario_id')->references('id')->on('users');
            $table->foreign('atendimento_id')->references('id')->on('atendimentos_temp')->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos');
            //$table->foreign('salario_id')->references('id')->on('despesas');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimento_funcionarios_temp');
        Schema::dropIfExists('atendimento_funcionarios');
    }
}
