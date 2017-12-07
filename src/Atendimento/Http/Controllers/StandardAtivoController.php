<?php
namespace Manzoli2122\Salao\Atendimento\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StandardAtivoController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $totalPage = 10;
    protected $upload = false;


    public function index()
    {
        $apagados = false;
        $models = $this->model->index($this->totalPage);
        return view("{$this->view}.index", compact('models', 'apagados'));
    }


    
    public function indexApagados()
    {
        $apagados = true;
        $models = $this->model->inativo()->paginate($this->totalPage);
        return view("{$this->view}.index", compact('models', 'apagados'));
    }



    public function create()
    {
        $title = "Cadastrar {$this->name}";
        return view("{$this->view}.create-edit", compact('title'));
    }



  
    public function store(Request $request)
    {
        $this->validate($request , $this->model->rules());
        $dataForm = $request->all();              
        $insert = $this->model->create($dataForm);           
        if($insert){
            return redirect()->route("{$this->route}.index")->with(['success' => 'Cadastro realizado com sucesso']);
        }
        else {
            return redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no Cadastro'])->withInput();
        }
    }




    public function show($id)
    {
        $model = $this->model->ativo()->find($id);
        return view("{$this->view}.show", compact('model'));
    }




    public function showApagado($id)
    {
        $model = $this->model->inativo()->find($id);
        return view("{$this->view}.show", compact('model'));
    }




    public function edit($id)
    {
        $model = $this->model->ativo()->find($id);
        return view("{$this->view}.create-edit", compact('model'));
    }




    public function update( Request $request, $id)
    {
        $this->validate($request , $this->model->rules($id));        
        $dataForm = $request->all();                      
        $model = $this->model->ativo()->find($id);        
        $update = $model->update($dataForm);                
        if($update){
            return redirect()->route("{$this->route}.index")->with(['success' => 'Alteração realizada com sucesso']);
        }        
        else {
            return redirect()->route("{$this->route}.edit" , ['id'=> $id])->withErrors(['errors' =>'Erro no Editar'])->withInput();
        }
    }




    
    public function destroy($id)
    {
        $model = $this->model->inativo()->find($id);
        $delete = $model->delete();
        if($delete){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.show",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }




    public function destroySoft($id)
    {
        $model = $this->model->ativo()->find($id);
        $model->ativo = false ; 
        $delete = $model->save();
        if($delete){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }




    public function restore($id)
    {
        $model = $this->model->inativo()->find($id);
        $model->ativo = true ; 
        $restore = $model->save();
        if($restore){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }


    
    public function pesquisar(Request $request)
    {        
        $apagados = false;
        $dataForm = $request->except('_token');
        if(isset($dataForm['key'])){
            $models = $this->model->ativo()->where('nome','LIKE', "%{$dataForm['key']}%")->paginate($this->totalPage);  
        }
        else{
            return redirect()->route("{$this->route}.index");
            
        }
        return view("{$this->view}.index", compact('models', 'dataForm','apagados'));
    }




}

