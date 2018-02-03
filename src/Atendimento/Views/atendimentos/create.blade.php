@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )			
	Cliente : {{ $atendimento->cliente->name}} 
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )
  
    <section class=" text-center buttons" style="margin-bottom:1px;">        
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
        <div class="col-12 col-sm-4 button" style="margin-bottom:10px;">
             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pagamentoModal" style="width: 100%;">
                <b>Adicionar Pagamento</b>
            </button>           
        </div>       
    </section>

    <section class=" text-center atendimentos"> 
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
            <div class="row">        
                <div class="col-md-12">
                    <hr style="margin-top:15px;"> 
                    <h3 style="text-align:right;">Total de Pagamento R$ {{number_format($atendimento->valorPagamentos(), 2 ,',', '') }} </h3>
                </div>    
                <div class="col-md-12">
                    <h3 style="text-align:right; margin:0px; margin-top:25px; color:red;"> Dividas atrasadas R$ {{number_format($atendimento->servicoAnterioresFiados(), 2 ,',', '') }} </h3>
                </div>  
                <div class="col-md-12">
                    <h3 style="text-align:right; margin:0px; margin-top:25px;"> Valor Total R$ {{number_format($atendimento->valor, 2 ,',', '') }} </h3>
                </div>
                <div class="col-md-12">
                    <p style="margin-bottom:20px; margin-top:10px">
                        <form class="form form-search form-ds" method="post" action="{{route('atendimentos.finalizar', $atendimento->id)}}" onsubmit="return  finalizarSend(this)">
                            {{csrf_field()}}                        
                            <input name="total_atendimento" value="{{$atendimento->valor}}" type="hidden">
                            <input name="total_pagamento" value="{{$atendimento->valorPagamentos()}}" type="hidden">
                            <button type="submit" class="btn btn-success" style="width: 100%;" >
                                <i class="fa fa-check"></i> Finalizar
                            </button>
                        </form>
                    </p>
                </div>
                <div class="col-md-12">
                    <a style="width: 100%;" class="btn btn-warning" href='{{route("atendimentos.cancelar", $atendimento->id)}}'>
                        <i class="fa fa-delete" aria-hidden="true"></i>
                        Cancelar
                    </a>      
                </div>
            </div>     
            <div class="row">        
                <div class="col-md-12">                   
                </div>                    
            </div>   
        </div>            
    </section>

                    
    @include('atendimento::atendimentos.produtoModal') 
    @include('atendimento::atendimentos.servicoModal')                
    @include('atendimento::atendimentos.pagamentoModal')

@endsection
  
@push( Config::get('app.templateMasterScript' , 'script')  )
        <script src="{{url('/js/app.js')}}"></script>	
        <script>
            $('#editable-select').editableSelect();
            
            function finalizarSend(val) {                
                var atendimento = val.elements['total_atendimento'].value
                var pagamento = val.elements['total_pagamento'].value
                var dif = atendimento - pagamento ;                
                if(dif > 0.09) {
                    alert('O valor total do atendimento que é R$' + atendimento + 
                    ' não confere com o do pagamento que é R$' + pagamento  );
                    return false;
                }
                return true;
            }

            function produtoFunction(form) {                                    
                var max = parseFloat( form.elements['produto_id'].options[form.elements['produto_id'].selectedIndex].text );            
                var quantidade = parseInt(form.elements['quantidade'].value);
                var desconto_maximo =  parseInt(form.elements['produto_id'].options[form.elements['produto_id'].selectedIndex].dataset['maximo']);
                form.elements['desconto'].max = ( desconto_maximo * max / 100); 
                if( max != 0.0 ){
                    form.elements['acrescimo'].max = max ;   
                }         

                if(form.elements['desconto'].value == '')
                    form.elements['desconto'].value = 0.0;
                var desconto =  parseFloat( form.elements['desconto'].value) ;            
                
                if(form.elements['acrescimo'].value == '')
                    form.elements['acrescimo'].value = 0.0;
                var acrescimo = parseFloat( form.elements['acrescimo'].value );

                var valor_unitario = max - desconto + acrescimo ;  

                var valor_total = valor_unitario * quantidade;           

                form.elements['valor-produto-unitario'].value = valor_unitario;

                form.elements['valor-produto-total'].value = valor_total;

            }

            function servicoFunction(form) {
                var max = parseFloat( form.elements['servico_id'].options[form.elements['servico_id'].selectedIndex].text );            
                var quantidade = parseInt(form.elements['quantidade'].value);
                //alert(quantidade);
                var desconto_maximo =  parseInt(form.elements['servico_id'].options[form.elements['servico_id'].selectedIndex].dataset['maximo']);
                form.elements['desconto'].max = ( desconto_maximo * max / 100); 
                form.elements['acrescimo'].max = max ;   
                if(form.elements['desconto'].value == '')
                    form.elements['desconto'].value = 0.0;
                var desconto =  parseFloat( form.elements['desconto'].value) ;            
                if(form.elements['acrescimo'].value == '')
                    form.elements['acrescimo'].value = 0.0;
                var acrescimo = parseFloat( form.elements['acrescimo'].value );
                var valor_unitario = max - desconto + acrescimo ;  
                var valor_total = valor_unitario * quantidade;           
                form.elements['valor-produto-unitario'].value = valor_unitario;
                form.elements['valor-produto-total'].value = valor_total;
                //var max = val.options[val.selectedIndex].text;
                //val.form.elements['desconto'].max = (4 * max / 5 ); 
            }

            function myFunction(val) {                            
                if(val == 'credito'){
                                document.getElementById("form-operadora").hidden = false ;
                                document.getElementById("form-parcelas").hidden = false ;
                                document.getElementById("parcelas").selectedIndex = 1 ;
                                document.getElementById("form-bandeira").hidden = false ;
                                document.getElementById("operadora_id").required = true ;
                                document.getElementById("parcelas").required = true ;
                                document.getElementById("bandeira").required = true ;

                }
                if(val == 'debito'){
                                document.getElementById("form-operadora").hidden = false ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = false ;
                                document.getElementById("operadora_id").required = true ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = true ;
                }                           
                if(val == 'dinheiro' ){
                                document.getElementById("form-operadora").hidden = true ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = true ;
                                document.getElementById("operadora_id").required = false ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = false ;
                }
                if(val == 'Transferência Bancária' ){
                                document.getElementById("form-operadora").hidden = true ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = true ;

                                document.getElementById("operadora_id").required = false ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = false ;
                }
                if( val == 'Pic Pay'){
                                document.getElementById("form-operadora").hidden = true ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = true ;

                                document.getElementById("operadora_id").required = false ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = false ;
                }
                if(val == 'cheque'){
                                document.getElementById("form-operadora").hidden = true ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = true ;

                                document.getElementById("operadora_id").required = false ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = false ;
                }
                if(val == 'fiado'){
                                document.getElementById("form-operadora").hidden = true ;
                                document.getElementById("form-parcelas").hidden = true ;
                                document.getElementById("form-bandeira").hidden = true ;

                                document.getElementById("operadora_id").required = false ;
                                document.getElementById("parcelas").required = false ;
                                document.getElementById("bandeira").required = false ;
                }            
            }	
        </script>	


@endpush
