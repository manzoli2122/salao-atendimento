<?php

namespace Manzoli2122\Salao\Atendimento\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Caixa;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CaixaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected $model;
    protected $pagamento;
    protected $atendimentoFuncionario;
    protected $produtosVendidos;
    protected $name = "Atendimento";
    protected $view = "atendimento::caixa";
    

    protected $log;

    public function __construct(Pagamento $pagamento , Atendimento $atendimento  , 
                                AtendimentoFuncionario $atendimentoFuncionario , ProdutosVendidos $produtosVendidos ){

        $this->model = $atendimento;
        $this->pagamento = $pagamento;
        $this->atendimentoFuncionario = $atendimentoFuncionario;
        $this->produtosVendidos = $produtosVendidos;
        $this->middleware('auth');


        $this->middleware('permissao:atendimentos')->only([ 'index' ]) ;
        
    }
    

    public function index()
    {   
        $caixa = new Caixa;
        $caixa->data =  today() ; 
        $models = $this->model::whereDate('created_at', today() )->get();
        return view("{$this->view}.index", compact('models' , 'caixa' ));
    }




    public function pesquisar(Request $request)
    {       
        $dataForm = $request->except('_token');
        $dataString = $dataForm['data'];
        $models = $this->model->whereDate('created_at', $dataString )->get();        
        
        $data = Carbon::createFromFormat('Y-m-d', $dataString);
        $caixa = new Caixa;
        $caixa->data = $data ; 
      
        return view("{$this->view}.index", compact('models' , 'data' , 'caixa'));
    }




}
