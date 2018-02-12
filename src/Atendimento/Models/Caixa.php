<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Manzoli2122\Salao\Atendimento\Models\Funcionario;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Caixa 
{
    
    public $data;

    private $atendimento;
    private $pagamento;
    private $atendimento_funcionario;

    public function __construct( ){
        $this->atendimento = new Atendimento ;  
        $this->pagamento  = new Pagamento ; 
        $this->atendimento_funcionario = new AtendimentoFuncionario ; 
    }


    public static function funcionariosDoDia(){  
        $data = $this->data();
        if($data == '') return null;
        return  Funcionario::whereIn('id', function($query2) use($data) { //} use ($user){
                        $query2->distinct()->select("atendimento_funcionarios.funcionario_id");
                        $query2->from("atendimento_funcionarios");
                        $query2->whereDate('created_at', $data );         
                })->get();         
    }


    public function data(){
        return $this->data->format('Y-m-d');
    }

    public function atendimentos(){
        return $this->atendimento::whereDate('created_at', $this->data() )->get();        
    }

    public function atendimentosFuncionario($funcionarioId){
        return $this->atendimento_funcionario::whereDate('created_at', $this->data() )->where('funcionario_id',$funcionarioId )->get();        
    }


    public function atendimentosFuncionarioTotal($funcionarioId){
        return 'R$' . number_format( $this->atendimento_funcionario::whereDate('created_at', $this->data() )->where('funcionario_id',$funcionarioId )->sum('valor'), 2 , ',' , '' ) ;          
    }

    public function atendimentosFuncionarioLiquido($funcionarioId){
        return 'R$' . number_format( $this->atendimento_funcionario::whereDate('created_at', $this->data() )->where('funcionario_id',$funcionarioId )->sum( DB::raw('valor * porcentagem_funcionario / 100 ') ), 2 , ',' , '' ) ;          
    }





    public function valor_atendimentos(){
        return 'R$' . number_format( $this->atendimento::whereDate('created_at',$this->data() )->sum('valor') , 2 , ',' , '' ) ;        
    }

    public function valor_Pagamento_dinheiro(){
        $valor =  $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'dinheiro' )->sum('valor');
        if(!$valor > 0 ) return 0;
        return 'R$' . number_format($valor , 2 , ',' , '' ) ;        
    }
    
    public function valor_Pagamento_pic_pay(){
        $valor =  $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'Pic Pay' )->sum('valor') ;
        if(!$valor > 0 ) return 0;
        return 'R$' . number_format($valor , 2 , ',' , '' ) ; 
    }


    public function valor_Pagamento_transferencia_bancaria(){
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'Transferência Bancária' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_credito(){
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'credito' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_debito(){
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'debito' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_cheque(){
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'cheque' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    
    public function valor_Pagamento_fiado(){
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'fiado' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    
}
