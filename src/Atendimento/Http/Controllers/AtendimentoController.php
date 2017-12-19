<?php

namespace Manzoli2122\Salao\Atendimento\Http\Controllers;


use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;
use Manzoli2122\Salao\Atendimento\Models\Cliente;

use Manzoli2122\Salao\Atendimento\Models\Temp\Atendimento_temp;
use Manzoli2122\Salao\Atendimento\Models\Temp\Pagamento_temp;
use Manzoli2122\Salao\Atendimento\Models\Temp\AtendimentoFuncionario_temp;
use Manzoli2122\Salao\Atendimento\Models\Temp\ProdutosVendidos_temp;

use Manzoli2122\Salao\Cadastro\Http\Controllers\Padroes\Controller ;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AtendimentoController extends Controller
{

    protected $totalPage = 35;

    protected $model;
    protected $model_temp;
    protected $pagamento;
    protected $atendimentoFuncionario;
    protected $pagamento_temp;
    protected $atendimentoFuncionario_temp;
    protected $produtosVendidos_temp;
    protected $produtosVendidos;
    protected $name = "Atendimento";
    protected $view = "atendimento::atendimentos";
    protected $route = "atendimentos";

    

    public function __construct(Pagamento $pagamento , Atendimento $atendimento  , Pagamento_temp $pagamento_temp ,
                                AtendimentoFuncionario $atendimentoFuncionario , Atendimento_temp $atend_temp ,
                                AtendimentoFuncionario_temp $atendimentoFuncionario_temp , 
                                ProdutosVendidos_temp $produtosVendidos_temp, ProdutosVendidos $produtosVendidos ){

        $this->model = $atendimento;
        $this->model_temp = $atend_temp;
        $this->pagamento = $pagamento;
        $this->atendimentoFuncionario = $atendimentoFuncionario;
        $this->pagamento_temp = $pagamento_temp;
        $this->atendimentoFuncionario_temp = $atendimentoFuncionario_temp;
        $this->produtosVendidos_temp = $produtosVendidos_temp;
        $this->produtosVendidos = $produtosVendidos;
        $this->middleware('auth');


        $this->middleware('permissao:atendimentos')->only([ 'index' , 'show' ]) ;       
        $this->middleware('permissao:atendimentos-soft-delete')->only([ 'destroySoft' ]);
        $this->middleware('permissao:atendimentos-restore')->only([ 'restore' ]);        
        $this->middleware('permissao:atendimentos-admin-permanete-delete')->only([ 'destroy' ]);
        $this->middleware('permissao:atendimentos-apagados')->only([ 'indexApagados' , 'showApagado' ]) ;
                               

        

    }
    

    public function index()
    {       
        $models = $this->model::whereDate('created_at', today() )->get();
        return view("{$this->view}.index", compact('models'));
    }



    
    public function show($id)
    {
        $model = $this->model->find($id);
        if( $model->created_at->isToday() )
            return view("{$this->view}.show", compact('model'));
        return redirect()->route('atendimentos.index');
    }
   

    public function alterarData(Request $request , $id)
    {

        $model = $this->model->find($id);
        //$data = Carbon::createFromFormat('Y-m-d', $request->input('data') ) ;

        $data = $request->input('data');           
        foreach($model->servicos as $servico){
            $servico->created_at = $data;
            
            //$servico->created_at->year = $data->year ;
            //$servico->created_at->month = $data->month ;      
            //$servico->created_at->day = $data->day ;
            $servico->save();
        }
        foreach($model->pagamentos as $pagamento){
            $pagamento->created_at = $data;
            
            //$pagamento->created_at->year = $data->year ;
            //$pagamento->created_at->month = $data->month ;      
            //$pagamento->created_at->day = $data->day ;
            $pagamento->save();
            
        }
        foreach($model->produtos as $produto){
            $produto->created_at = $data;
            
           //$produto->created_at->year = $data->year ;
            //$produto->created_at->month = $data->month ;      
            //$produto->created_at->day = $data->day ;
            $produto->save();            
        } 
        $model->created_at = $data;
        
       //$model->created_at->year = $data->year ;
        
        //$model->created_at->month = $data->month ;      
        //$model->created_at->day = $data->day ;
        
        $model->save();        
        return redirect()->route('atendimentos.index');
    }


    

    /*
    public function restore($id)
    {
        $model = $this->model->withTrashed()->find($id);
        $model->atualizarValor();

        if(!$model->arquivado){
            return redirect()->route("{$this->route}.apagados");    
        }


        foreach( $this->atendimentoFuncionario->withTrashed()->where('atendimento_id' , $id)->get() as $servico){
            $servico->restore();
        }
        foreach($this->pagamento->withTrashed()->where('atendimento_id' , $id)->get() as $pagamento){
            $pagamento->restore();
        }
        foreach($this->produtosVendidos->withTrashed()->where('atendimento_id' , $id)->get() as $produto){
            $produto->restore();
        }

        $restore = $model->restore();
        if($restore){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }
*/

    



    public function destroySoft($id)
    {
        $model = $this->model->find($id);
        
        if($model->pagamentosFiadosQuitados()->count() != 0  ){
            return redirect()->route("{$this->route}.index");    
        }        

        foreach($model->pagamentosQuitadosAqui as $pagamentoQuitados){
            $pagamentoQuitados->restore();
            $pagamentoQuitados->atendimento_da_quitacao()->dissociate();
            $pagamentoQuitados->save();
            $model->atualizarValor();
        }       
        
        foreach($model->servicos as $servico){
            $servico->delete();
        }
        foreach($model->pagamentos as $pagamento){
            $pagamento->delete();
        }
        foreach($model->produtos as $produto){
            $produto->delete();
        }

        $delete = $model->delete();
        if($delete){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }





    
    public function create_temp($id)
    {
        $atendimento = new Atendimento_temp;
        $cliente = Cliente::find($id);
        $atendimento->valor = 0.0;        
        $atendimento->cliente()->associate($cliente);
        $atendimento->save();      
        return  redirect()->route("{$this->route}.adicionarItens",['id' => $atendimento->id]);
    }



    public function adicionarItens_temp($id)
    {
        $atendimento = $this->model_temp->find($id);
        $atendimento->atualizarValor();       
        return view("{$this->view}.create", compact('atendimento'));
    }


    public function finalizar($id)
    {
        $atendimento_old = $this->model_temp->find($id);        
        $atendimento = $this->model->create( $atendimento_old->toArray() );

        foreach($atendimento_old->servicos as $servico){
            $array = $servico->toArray();
            unset($array['id']);
            $array['atendimento_id'] = $atendimento->id;
            $array['valor'] = $servico->valor() ; 
            $array['valor_unitario'] = $servico->servico->valor; 
            $array['porcentagem_funcionario'] = $servico->servico->porcentagem_funcionario;     
                   
            $this->atendimentoFuncionario->create( $array );
        }



        foreach(Pagamento::where('cliente_id', $atendimento->cliente->id )->where('formaPagamento', 'fiado' )->get() as $pagamentoFiado){
            $pagamentoFiado->atendimento_da_quitacao()->associate($atendimento);
            $pagamentoFiado->save();
            $pagamentoFiado->delete();
        }

        foreach($atendimento_old->pagamentos as $pagamento){
            $array = $pagamento->toArray();
            unset($array['id']);
            $array['atendimento_id'] = $atendimento->id;
            $array['valor_liquido'] = $pagamento->valor ;
            if($pagamento->formaPagamento == 'credito'){
                $array['porcentagem_cartao'] = $pagamento->operadora->porcentagem_credito ;
                $array['valor_liquido'] = $pagamento->valor *(100 - $pagamento->operadora->porcentagem_credito) / 100  ;
            }
            if($pagamento->formaPagamento == 'debito'){
                $array['porcentagem_cartao'] = $pagamento->operadora->porcentagem_debito ;
                $array['valor_liquido'] = $pagamento->valor *(100 - $pagamento->operadora->porcentagem_debito) / 100  ;
            }
            $this->pagamento->create( $array );
        }



        foreach($atendimento_old->produtos as $produto){
            $array = $produto->toArray();
            unset($array['id']);
            $array['atendimento_id'] = $atendimento->id;
            $array['valor'] = $produto->valor();
            $array['valor_unitario'] = $produto->produto->valor;
            
            $this->produtosVendidos->create( $array );
        }



        $atendimento_old->delete();
        
        $atendimento->atualizarValor();

        
       
        return  redirect()->route("{$this->route}.index");
        
       

    }



    public function cancelar($id)
    {
        $atendimento_old = $this->model_temp->find($id); 
        $clienteId = $atendimento_old->cliente_id ;    
        $atendimento_old->delete();

        return redirect()->route("{$this->route}.index");

    }





 

    public function adicionarServico(Request $request)
    {
        //$this->validate($request , $this->model->rules());
        $dataForm = $request->all();              
        $insert = $this->atendimentoFuncionario_temp->create($dataForm); 
        
        if($insert){
            $insert->atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')])   ;
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')])  ;
        }

    }


    public function removerServico($id)
    {
        $servico = $this->atendimentoFuncionario_temp->find($id); 
        $atendimento = $this->model_temp->find($servico->atendimento_id);
        $delete = $servico->delete();
        if($delete){
            $atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }

    }

    


    public function adicionarPagamento(Request $request)
    {        
        $dataForm = $request->all();          
        if($dataForm['operadora_id'] ==null){
            unset($dataForm['operadora_id']);
        }
        if($dataForm['parcelas'] ==null){
            unset($dataForm['parcelas']);
        }        
        //dd($dataForm);
        $insert = $this->pagamento_temp->create($dataForm);         
        if($insert){
            //$insert->atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')]);
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')]);
        }
    }


    public function removerPagamento($id)
    {
        $pagamento = $this->pagamento_temp->find($id); 
        $atendimento = $this->model_temp->find($pagamento->atendimento_id);
        $delete = $pagamento->delete();
        if($delete){
            $atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }

    }

    




    

    public function adicionarProduto(Request $request)
    {
        //$this->validate($request , $this->model->rules());
        $dataForm = $request->all();  
               
        $insert = $this->produtosVendidos_temp->create($dataForm); 
        
        if($insert){
            $insert->atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')]);
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $request->input('atendimento_id')]);
        }

    }


    public function removerProduto($id)
    {
        $produto = $this->produtosVendidos_temp->find($id); 
        $atendimento = $this->model_temp->find($produto->atendimento_id);
        $delete = $produto->delete();
        if($delete){
            $atendimento->atualizarValor();
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }
        else {
            return redirect()->route("{$this->route}.adicionarItens" , ['id' => $atendimento->id ]);
        }

    }

    



}
