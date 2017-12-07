<?php

namespace Manzoli2122\Salao\Atendimento\Models\Temp;

use Illuminate\Database\Eloquent\Model;

class ProdutosVendidos_temp extends Model
{
   

    public function __construct(){
        $this->table = Config::get('atendimento.atendimentos_produtos_temp_table' , 'atendimentos_produtos_temp') ;    
    }

    
   
    protected $fillable = [
        'desconto', 'cliente_id' , 'atendimento_id' , 'produto_id' , 'quantidade' , 'acrescimo' ,
    ];
    


    
    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }

    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Temp\Atendimento_temp', 'atendimento_id');
    }

    public function produto()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\Produto', 'produto_id');
    }


    public function valor()
    {
        return (($this->valorUnitario() * $this->quantidade)  );
    }

    public function valorUnitario()
    {
        return ($this->produto->valor  - $this->desconto + $this->acrescimo);
    }


}
