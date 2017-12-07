<?php

namespace Manzoli2122\Salao\Atendimento\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Cliente extends Model
{
    public function __construct(){
        $this->table = Config::get('atendimento.cliente_table' , 'users') ;    
    }
    

    protected $fillable = [
        'name', 'email',  'image' , 'endereco', 'ativo' , 'apelido' , 'nascimento' , 'celular', 'telefone' , 'password'
    ];

    
   
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'nascimento' ,
        
    ];

    public function nascimento()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->nascimento );
    }



    public function scopeAtivo($query)
    {
        return $query->where('ativo', 1);
    }

    
    public function scopeInativo($query)
    {
        return $query->where('ativo', 0);
    }


    public function index($totalPage)
    {
        return $this->ativo()->orderBy('name', 'asc')->paginate($totalPage);        
    }



    public function atendimentos()
    {        
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\Atendimento', 'cliente_id');
    }

    public function rules($id = '')
    {
        return [
            'name' => 'required|min:3|max:100',
            'email' => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image' => 'image' , 
        ];
    }

    
}
