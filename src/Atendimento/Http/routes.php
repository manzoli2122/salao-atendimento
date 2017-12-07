<?php

use Illuminate\Support\Facades\Route;




    Route::group(['prefix' => 'atendimento', 'middleware' => 'auth' ], function(){



        Route::get('clientes/apagados/{id}', 'ClienteController@showApagado')->name('clientes.showapagado');        
        Route::get('clientes/apagados', 'ClienteController@indexApagados')->name('clientes.apagados');
        Route::get('clientes/pesquisarApagados', 'ClienteController@pesquisarApagados')->name('clientes.pesquisarApagados');
        Route::get('clientes/pesquisar', 'ClienteController@pesquisar')->name('clientes.pesquisar');
        Route::delete('clientes/destroySoft/{id}', 'ClienteController@destroySoft')->name('clientes.destroySoft');
        Route::get('clientes/restore/{id}', 'ClienteController@restore')->name('clientes.restore');
        Route::resource('clientes', 'ClienteController');






        Route::get('atendimentos/cancelar/{id}', 'AtendimentoController@cancelar')->name('atendimentos.cancelar');
        Route::post('atendimentos/finalizar/{id}', 'AtendimentoController@finalizar')->name('atendimentos.finalizar');
        
        Route::get('atendimentos/cadastrar/usuarios/{id}', 'AtendimentoController@create_temp')->name('atendimentos.cadastrar');
        Route::get('atendimentos/cadastrar/{id}', 'AtendimentoController@adicionarItens_temp')->name('atendimentos.adicionarItens');
        
        Route::post('atendimentos/cadastrar/servico', 'AtendimentoController@adicionarServico')->name('atendimentos.adicionarServico');
        Route::get('atendimentos/remover/servico/{id}', 'AtendimentoController@removerServico')->name('atendimentos.removerServico');
        
        Route::post('atendimentos/cadastrar/pagamento', 'AtendimentoController@adicionarPagamento')->name('atendimentos.adicionarPagamento');
        Route::get('atendimentos/remover/pagamento/{id}', 'AtendimentoController@removerPagamento')->name('atendimentos.removerPagamento');
        
        Route::post('atendimentos/cadastrar/produto', 'AtendimentoController@adicionarProduto')->name('atendimentos.adicionarProduto');
        Route::get('atendimentos/remover/produto/{id}', 'AtendimentoController@removerProduto')->name('atendimentos.removerProduto');



        Route::get('atendimentos/apagados/{id}', 'AtendimentoController@showApagado')->name('atendimentos.showapagado');        
        Route::get('atendimentos/apagados', 'AtendimentoController@indexApagados')->name('atendimentos.apagados');
        Route::post('atendimentos/pesquisarApagados', 'AtendimentoController@pesquisarApagados')->name('atendimentos.pesquisarApagados');
        Route::post('atendimentos/pesquisar', 'AtendimentoController@pesquisar')->name('atendimentos.pesquisar');
        Route::delete('atendimentos/destroySoft/{id}', 'AtendimentoController@destroySoft')->name('atendimentos.destroySoft');
        Route::get('atendimentos/restore/{id}', 'AtendimentoController@restore')->name('atendimentos.restore');
        Route::resource('atendimentos', 'AtendimentoController' , ['except' => [
            'create', 'store' , 'edit' , 'update' , 
        ]] ); 
    




        Route::get('relatorio/caixa', 'CaixaController@index')->name('caixa.index'); 
        Route::post('relatorio/caixa', 'CaixaController@pesquisar')->name('caixa.pesquisar');        
        


    });