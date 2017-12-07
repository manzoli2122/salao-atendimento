<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Funcionario extends Model 
{

    public function __construct(){
        $this->table = Config::get('atendimento.funcionario_table' , 'users') ;    
    }

   
   
    protected $fillable = [
        'name', 'email',   'apelido' , 'nascimento' , 'celular' , 'ativo'
    ];

   


    protected $dates = [
        'created_at',
        'updated_at',
        'nascimento'
    ];



    public function scopeAtivo($query)
    {
        return $query->where('ativo', 1)->whereIn('id', function($query2) { 
                                                        $query2->select("perfils_users.user_id");
                                                        $query2->from("perfils_users");
                                                        $query2->whereIn("perfils_users.perfil_id" , function($query3) {
                                                            $query3->select("perfils.id");
                                                            $query3->from("perfils");
                                                            $query3->where('nome' , 'Funcionario');
                                                        } );                                                            
                                                    });
    }

    

    public function index($totalPage)
    {
        return $this->ativo()->orderBy('name', 'asc')->paginate($totalPage);        
    }


    
    public static function funcionarios(){       
        return  Funcionario::whereIn('id', function($query2) { //} use ($user){
                        $query2->select("perfils_users.user_id");
                        $query2->from("perfils_users");
                        $query2->whereIn("perfils_users.perfil_id" , function($query3) {
                            $query3->select("perfils.id");
                            $query3->from("perfils");
                            $query3->where('nome' , 'Funcionario');
                        } );                                                            
            })->get();         
    }


    public function Atendimentos()
    {
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario', 'funcionario_id');
       
    }



    public function AtendimentosSemSalario()
    {
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario', 'funcionario_id')->whereNull('salario_id')->get();
        //return $this->whereNull('salario_id')->where('funcionario_id' , $funcionarioId)->get();
    }















    
}
