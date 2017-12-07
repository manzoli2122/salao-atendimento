<?php

namespace Manzoli2122\Salao\Atendimento\Models\Temp;

use Illuminate\Database\Eloquent\Model;

class Pagamento_temp extends Model
{



    public function __construct(){
        $this->table = Config::get('atendimento.pagamentos_temp_table' , 'pagamentos_temp') ;    
    }

    
    
    protected $fillable = [
        'valor',  'atendimento_id' , 'compensado' , 'parcelas' , 'observacoes', 
         'porcentagem_cartao' , 'operadora_id', 'formaPagamento' , 'cliente_id'  , 'bandeira'
    ];




    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Temp\Atendimento_temp', 'atendimento_id');
    }


    public function operadora()
    {
        return $this->belongsTo('AManzoli2122\Salao\Cadastro\Models\Operadora', 'operadora_id');
    }


    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }


}
