<?php

namespace Manzoli2122\Salao\Atendimento\Models\Temp;

use Illuminate\Database\Eloquent\Model;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;


class Atendimento_temp extends Model
{
    

    public function __construct(){
        $this->table = Config::get('atendimento.atendimento_temp_table' , 'atendimentos_temp') ;    
    }

    
    
    
    
    protected $fillable = [
        'cliente_id', 'valor', 
    ];


    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }

    public function servicos()
    {        
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\Temp\AtendimentoFuncionario_temp', 'atendimento_id');
    }

    public function pagamentos()
    {        
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\Temp\Pagamento_temp', 'atendimento_id');
    }

    public function produtos()
    {        
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\Temp\ProdutosVendidos_temp', 'atendimento_id' );
    }





    public function valorServicos(){
        $valor = 0.0;
        foreach($this->servicos as $servico){
            $valor = $valor + $servico->valor() ;
        }
        return  $valor;       
    }





    public function valorProdutos(){
        $valor = 0.0;        
        foreach($this->produtos as $produto){
            $valor =  $valor + $produto->valor() ;
        }
        return  $valor;
    }


    public function valorPagamentos(){
        $valor = 0.0;
        foreach($this->pagamentos as $pagamento){
            $valor = $valor + $pagamento->valor;
        }
        return  $valor;       
    }




    public function atualizarValor(){
        $this->valor = $this->valorProdutos() + $this->valorServicos() +  $this->servicoAnterioresFiados();        
        $this->save();
    }





    public function servicoAnterioresFiados(){                      
        $valor = Pagamento::where('cliente_id', $this->cliente->id )->where('formaPagamento', 'fiado' )->sum('valor');        
        return  $valor;        
    }


    
}
