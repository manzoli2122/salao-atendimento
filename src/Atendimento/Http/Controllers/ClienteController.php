<?php

namespace Manzoli2122\Salao\Atendimento\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\Salao\Atendimento\Models\Cliente;
use Manzoli2122\Salao\Cadastro\Http\Controllers\Padroes\StandardAtivoController ;
use DataTables;


class ClienteController extends StandardAtivoController
{
    
    protected $model;    
    protected $name = "Cliente";    
    protected $view = "atendimento::clientes";  
    protected $view_apagados = "atendimento::clientes.apagados";  
    protected $route = "clientes";
    protected $totalPage = 10;

    public function __construct(Cliente $user){
        $this->model = $user; 

        $this->middleware('permissao:clientes')->only([ 'index' , 'show' , 'pesquisar' ]) ;        
        $this->middleware('permissao:clientes-cadastrar')->only([ 'create' , 'store']);
        $this->middleware('permissao:clientes-editar')->only([ 'edit' , 'update']);
        $this->middleware('permissao:clientes-soft-delete')->only([ 'destroySoft' ]);
        $this->middleware('permissao:clientes-restore')->only([ 'restore' ]);        
        $this->middleware('permissao:clientes-admin-permanete-delete')->only([ 'destroy' ]);
        $this->middleware('permissao:clientes-apagados')->only([ 'indexApagados' , 'showApagado' , 'pesquisarApagados']) ;
                            
    }


   
   
    public function store(Request $request)
    {
        $this->validate($request , $this->model->rules());
        $dataForm = $request->all();              
        $dataForm['password'] = bcrypt("senha123"); 
        if($request->hasFile('image')){
            $image = $request->file('image');           
            $nameImage = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension();
            $upload = $image->storeAs('users', $nameImage );
            if($upload){
                $dataForm['image'] = $nameImage;
            }
            else 
                redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no upload'])->withInput();
        }        
        $insert = $this->model->create($dataForm);           
        if($insert){
            return redirect()->route("{$this->route}.show", ['id' => $insert->id])->with(['success' => 'Cadastro realizado com sucesso']);
        }
        else {
            return redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no Cadastro'])->withInput();
        }

    }




    public function update( Request $request, $id)
    {
        $this->validate($request , $this->model->rules($id));        
        $dataForm = $request->all();                      
        $model = $this->model->ativo()->find($id); 
        if( $request->hasFile('image')){
            $image =  $request->file('image'); 
            if(!isset($model->image))  
            $model->image = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension(); 
            $upload = $image->storeAs('users', $model->image );
            $dataForm['image'] = $model->image;
            if(!$upload){
                return redirect()->route("{$this->route}.edit" , ['id'=> $id])->withErrors(['errors' =>'Erro no upload'])->withInput();
            }
        }       
        $update = $model->update($dataForm);                
        if($update){
            return redirect()->route("{$this->route}.show", ['id'=> $id] )->with(['success' => 'Alteração realizada com sucesso']);
        }        
        else {
            return redirect()->route("{$this->route}.edit" , ['id'=> $id])->withErrors(['errors' =>'Erro no Editar'])->withInput();
        }
    }
    


    
     
    /**
    * Processa a requisição AJAX do DataTable na página de listagem.
    * Mais informações em: http://datatables.yajrabox.com
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function getDatatable()
    {
        $models = $this->model->getDatatable();
        return Datatables::of($models)                
        ->addColumn('action', function($linha) {        
            return  
               
                           '<a href="'.route("atendimentos.cadastrar", $linha->id).'" class="btn btn-success btn-xs" title="Atender"> <i class="fa fa-money"></i> Atender </a> '
                            
                            . '<a href="'.route("{$this->route}.edit", $linha->id).'" class="btn btn-primary btn-xs" title="Editar"> <i class="fa fa-pencil"></i> </a> '
                            
                            .'<button data-id="'.$linha->id.'" btn-excluir type="button" class="btn btn-danger btn-xs" title="Excluir"> <i class="fa fa-times"></i> </button> '
                            
                            . '<a href="'.route("{$this->route}.show", $linha->id).'" class="btn btn-primary btn-xs" title="Visualizar"> <i class="fa fa-search"></i> </a>'
                            ;
                    })
                    ->make(true);
    }
    



}
