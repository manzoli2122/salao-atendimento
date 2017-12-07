@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )			
		Cliente : {{ $atendimento->cliente->name}} 
@endsection

  
@section( Config::get('atendimento.templateMasterScript' , 'script')  )
        <script src="{{url('/js/app.js')}}"></script>			
@endsection



@section( Config::get('atendimento.templateMasterContent' , 'contentMaster')  )

    <section class="row text-center errors">
        <div class="col-12 col-sm-12 error">
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif
        </div>        
    </section>

    <section class="row text-center buttons" style="margin-bottom:1px;">
        
        <div class="col-12 col-sm-4 button" style="margin-bottom:10px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#servicoModal" style="width: 100%;">
                <b>Adicionar Serviço</b>
            </button>
        </div>
        <div class="col-12 col-sm-4 button" style="margin-bottom:10px;">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#produtoModal" style="width: 100%;">
                <b>Adicionar Produto</b>
            </button>
        </div>
        <div class="col-12 col-sm-4 button" >
             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pagamentoModal" style="width: 100%;">
                <b>Adicionar Pagamento</b>
            </button>
           
        </div>
       
    </section>


     





    
    <section class="row text-center atendimentos"> 

        <div class="col-12 col-sm-4 servicos" style="margin-bottom:10px;">
           
            @forelse($atendimento->servicos as $servico) 


                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$servico->servico->nome}}</h3>
                                <div class="box-tools pull-right">
                                    <a class="btn btn-box-tool" href="{{ route('atendimentos.removerServico',$servico->id) }}"><i class="fa fa-times"></i> </a>                            
                                </div>                            
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-right">Funcionário: {{$servico->funcionario->apelido}}</span>
                                            <span class="pull-left">R${{   number_format(  $servico->valorUnitario() , 2 ,',', '')  }} / Unid.</span>
                                        </div>
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left"> quant.: {{$servico->quantidade}} </span>
                                            <span class="pull-right badge bg-green"> Total R${{ number_format($servico->valor() , 2 ,',', '')}} </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>

			@empty
			
			@endforelse  
           
        </div>
        

        
        <div class="col-12 col-sm-4 produtos" style="margin-bottom:0px;">
                     
            @forelse($atendimento->produtos as $produto)

                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$produto->produto->nome}}</h3>
                                <div class="box-tools pull-right">
                                    <a class="btn btn-box-tool" href="{{ route('atendimentos.removerProduto',$produto->id) }}"><i class="fa fa-times"></i> </a>                            
                                </div>                            
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left"> R${{   number_format(  $produto->valorUnitario() , 2 ,',', '')  }} / Unid. </span>
                                            <span class="pull-right"></span>
                                        </div>
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left"> quant.: {{$produto->quantidade}} </span>
                                            <span class="pull-right badge bg-blue"> Total R${{ number_format($produto->valor() , 2 ,',', '')}} </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>
               
			@empty
			
			@endforelse  
            <hr style="margin-top:15px;">
        </div>






        <div class="col-12 col-sm-4 pagamentos">            
            
            @forelse($atendimento->pagamentos as $pagamento)
                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$pagamento->formaPagamento}}</h3>
                                <div class="box-tools pull-right">
                                    <a class="btn btn-box-tool" href="{{ route('atendimentos.removerPagamento',$pagamento->id) }}"><i class="fa fa-times"></i> </a>                            
                                </div>                            
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg"> 
                                        @if($pagamento->formaPagamento == 'credito' or $pagamento->formaPagamento == 'debito')                                       
                                            <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left"> {{ $pagamento->operadora->nome }}  </span>
                                                <span class="pull-right"> {{ $pagamento->bandeira }}  </span>
                                            </div>
                                            <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left">  {{ $pagamento->parcelas }}X </span>
                                                <span class="pull-right badge bg-orange"> Valor R${{ number_format($pagamento->valor , 2 ,',', '') }} </span>
                                            </div>
                                        @else
                                             <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left">  </span>
                                                <span class="pull-right badge bg-orange"> Valor R${{ number_format($pagamento->valor , 2 ,',', '') }} </span>
                                            </div>
                                        @endif
                                       
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            
            
            
            
                              
                	
            @empty
			
			@endforelse 
            <hr style="margin-top:15px;"> 
             <h3 style="text-align:right;">Total de Pagamento R$ {{number_format($atendimento->valorPagamentos(), 2 ,',', '') }} </h3>
        </div>            
    </section>


    <section class="row text-center placeholders">        
        <div class="col-12 col-sm-4  ml-auto  ">
            <h3 style="text-align:right; margin:0px; margin-top:25px; color:red;"> Dividas atrasadas R$ {{number_format($atendimento->servicoAnterioresFiados(), 2 ,',', '') }} </h3>
        </div>  
        <div class="col-12 col-sm-4  ml-auto ">			
            <h3 style="text-align:right; margin:0px; margin-top:25px;"> Valor Total R$ {{number_format($atendimento->valor, 2 ,',', '') }} </h3>
        </div>  
        
        <div class="col-12 col-sm-4 ml-auto placeholder">
            <p style="margin-bottom:20px; margin-top:10px">
             {!! Form::open(['route' => ["atendimentos.finalizar" , $atendimento->id ], 'class' => 'form form-search form-ds' , 'onsubmit' => " return  finalizarSend(this) "])!!}
             {!! Form::submit('Finalizar' , ['class' => 'btn btn-danger', 'style' => 'width: 100%;' ]) !!}
                {{ Form::hidden('total_atendimento', $atendimento->valor ) }}
                {{ Form::hidden('total_pagamento', $atendimento->valorPagamentos() ) }}          

             {!! Form::close()!!}
             </p>	
        </div>  




    </section>



    <section class="row text-center placeholders">        
        
        <div class="col-12 col-sm-4 pull-right placeholder">
           
                <a style="width: 100%;" class="btn btn-warning" href='{{route("atendimentos.cancelar", $atendimento->id)}}'>
                    <i class="fa fa-delete" aria-hidden="true"></i>
                    Cancelar
                </a>
           	
        </div>  




    </section>





@include('atendimento::atendimentos.servicoModal')
                  
@include('atendimento::atendimentos.produtoModal')
                
@include('atendimento::atendimentos.pagamentoModal')




@endsection