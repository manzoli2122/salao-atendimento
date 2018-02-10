<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Illuminate\Database\Eloquent\Builder;


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

    public function data(){
        return $this->data->format('Y-m-d');
    }

    public function atendimentos()
    {
        return $this->atendimento::whereDate('created_at', $this->data() )->get();        
    }

    public function atendimentosFuncionario($funcionarioId)
    {
        return $this->atendimento_funcionario::whereDate('created_at', $this->data() )->where('funcionario_id',$funcionarioId )->get();        
    }


    public function valor_atendimentos()
    {
        return 'R$' . number_format( $this->atendimento::whereDate('created_at',$this->data() )->sum('valor') , 2 , ',' , '' ) ;        
    }

    public function valor_Pagamento_dinheiro()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'dinheiro' )->sum('valor') , 2 , ',' , '' ) ;        
    }
    
    public function valor_Pagamento_pic_pay()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'Pic Pay' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_transferencia_bancaria()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'Transferência Bancária' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_credito()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'credito' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_debito()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'debito' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    public function valor_Pagamento_cheque()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'cheque' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    
    public function valor_Pagamento_fiado()
    {
        return 'R$' . number_format( $this->pagamento::whereDate('created_at',$this->data() )->where('formaPagamento', 'fiado' )->sum('valor') , 2 , ',' , '' ) ;        
    }


    
}
