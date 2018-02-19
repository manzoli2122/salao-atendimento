<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('compensado')->default(false);
            $table->boolean('operadora_confirm')->default(false);
            $table->boolean('caiu_conta')->default(false);
            $table->date('na_conta_at')->nullable();
            $table->string('bandeira' , 100 )->nullable();
            $table->string('observacoes')->nullable();
            $table->integer('parcelas')->default(1);
            $table->double('porcentagem_cartao', 15,2)->default(0.0);
            $table->double('valor', 15, 8);
            $table->enum('formaPagamento', [ 'dinheiro' , 'credito' , 'debito' , 'cheque' , 'fiado']);
             $table->double('valor_liquido', 15, 8)->nullable();

            $table->unsignedInteger('atendimento_id');
            $table->unsignedInteger('operadora_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('atendimento_id')->references('id')->on('atendimentos')->onDelete('cascade');
            $table->foreign('operadora_id')->references('id')->on('operadoras');

        });




        Schema::create('pagamentos_temp', function (Blueprint $table) {
            $table->increments('id');
            //$table->boolean('compensado')->default(false);
            $table->integer('parcelas')->default(1);
            //$table->double('porcentagem_cartao', 15,2)->default(0.0);
            $table->double('valor', 15, 8);
            $table->enum('formaPagamento', [ 'dinheiro' , 'credito' , 'debito' , 'cheque' , 'fiado' ]);
            $table->string('bandeira' , 100 )->nullable();
            $table->string('observacoes')->nullable();
            $table->unsignedInteger('atendimento_id');
            $table->unsignedInteger('operadora_id')->nullable();

            $table->timestamps();

            $table->foreign('atendimento_id')->references('id')->on('atendimentos_temp')->onDelete('cascade');
            $table->foreign('operadora_id')->references('id')->on('operadoras');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos_temp');
        Schema::dropIfExists('pagamentos');
    }
}
