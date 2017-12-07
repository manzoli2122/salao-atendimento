<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosVendidos extends Model
{    
    use SoftDeletes ;

    public function __construct(){
        $this->table = Config::get('atendimento.atendimentos_produtos_table' , 'atendimentos_produtos') ;    
    }


    protected $fillable = [
        'quantidade', 'cliente_id', 'valor' , 'atendimento_id' , 'produto_id' , 'acrescimo' , 'desconto' , 'valor_unitario' , 
    ];
    


    
    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }

    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Atendimento', 'atendimento_id');
    }

    public function produto()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\Produto', 'produto_id');
    }



}
