<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use SoftDeletes;

    public function __construct(){
        $this->table = Config::get('atendimento.pagamentos_table' , 'pagamentos') ;    
    }
    
    
    protected $fillable = [
        'valor',  'atendimento_id' , 'compensado' , 'parcelas' , 'operadora_confirm', 'na_conta_at' , 'operadora_id' ,
         'porcentagem_cartao' , 'operadora_id', 'formaPagamento' , 'caiu_conta' , 'valor_liquido' , 'bandeira' ,
         'observacoes' , 'cliente_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Atendimento', 'atendimento_id');
    }


    public function atendimento_da_quitacao()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Atendimento', 'atendimento_quitacao_id');
    }


    public function operadora()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\OPeradora', 'operadora_id');
    }


    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }


}
