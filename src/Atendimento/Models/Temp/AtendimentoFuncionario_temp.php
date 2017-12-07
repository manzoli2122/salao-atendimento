<?php

namespace Manzoli2122\Salao\Atendimento\Models\Temp;

use Illuminate\Database\Eloquent\Model;

class AtendimentoFuncionario_temp extends Model
{
    

    public function __construct(){
        $this->table = Config::get('atendimento.atendimento_funcionarios_temp_table' , 'atendimento_funcionarios_temp') ;    
    }

    
    protected $fillable = [
        'desconto', 'cliente_id', 'funcionario_id' , 'atendimento_id' , 'servico_id' , 'quantidade' , 'acrescimo' , 
        
    ];


    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }


    public function funcionario()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Funcionario', 'funcionario_id');
    }


    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Temp\Atendimento_temp', 'atendimento_id');
    }


    public function servico()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\Servico', 'servico_id');
    }


    

    public function valor()
    {
        return (($this->valorUnitario() * $this->quantidade)  );
    }


    
    public function valorUnitario()
    {
        return ($this->servico->valor  - $this->desconto + $this->acrescimo);
    }
   

    

}
