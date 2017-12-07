

<div class="modal fade bd-example-modal-lg" id="{{$atendimento->id}}atendimentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:90%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="margin-left:50px;" class="modal-title" id="exampleModalLabel">Cliente : <b> {{ $atendimento->cliente->name}} </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">   
                
                <section class="row text-center show-atendimento">


                    <div class="col-12 col-sm-8 placeholder"  >  
                        <p style="text-align:center;"><b> Itens Inclusos </b>    </p>
                        <hr>                   
                        @forelse($atendimento->servicos as $servico)
                            <p style="text-align:left;"><b>{{$servico->servico->nome}} </b>    </p>
                            <div class="row" style="text-align:left;">	
                               
                                <div class="col-6">			
                                    <p>por: {{$servico->funcionario->apelido}}</p>		                        
                                </div>
                                <div class="col-3 ">			
                                    <p> Quant.:{{ $servico->quantidade }} </p>						
                                </div>
                                <div class="col-3 text-right">			
                                    <p> Valor R${{ number_format( $servico->valor , 2 , ',' , '' ) }} </p>						
                                </div>
                            </div>
                            <hr>
                        @empty			
                        @endforelse  
                        
                         @forelse($atendimento->produtos as $produto)
                            <div class="row" style="text-align:left;">	
                                <div class="col-6">			
                                    <p><b>{{$produto->produto->nome}} </b>    </p>		                        
                                </div>
                                <div class="col-3">			
                                    <p>Quant.: {{ $produto->quantidade }} </p>		                        
                                </div>

                                <div class="col-3 text-right">			
                                    <p> Valor R${{  number_format($produto->valor , 2 , ',' , '')  }} </p>						
                                </div>
                            </div>
                            <hr>
                        @empty
                        @endforelse  
                        <h6 style="text-align:right;">Valor Total R$ {{number_format($atendimento->valor, 2 , ',' , '') }} </h6> 
                    </div>
        

                    <div class="col-12 col-sm-4 placeholder" >            
                        <p style="text-align:center;"><b>Pagamentos </b>    </p>
                        <hr>
                        @forelse($atendimento->pagamentos as $pagamento)                                        
                            <div class="row" style="text-align:left;">	                                
                                <div class="col-3">			
                                    <p> <b>{{$pagamento->formaPagamento}}</b> </p>					                        
                                </div>
                                <div class="col-5 ml-auto text-right">			
                                    <p> Valor R${{ number_format($pagamento->valor , 2 , ',' , '') }} </p>						
                                </div>                                
                            </div>	                    
                            <hr>	
                        @empty
                        @endforelse  
                        <h6 style="text-align:right;">Total de Pagamento R$ {{number_format($atendimento->valorPagamentos() , 2 , ',' , '')  }} </h6> 

                        @forelse($atendimento->pagamentosFiadosQuitados as $pagamento)                                        
                            <div class="row" style="text-align:left; color:red;">	                                
                                <div class="col-3">			
                                    <p> <b>{{$pagamento->formaPagamento}}</b> </p>					                        
                                </div>
                                <div class="col-4">			
                                    <p> <b>Quitado em: {{$pagamento->deleted_at->format('d/m/Y')}}</b> </p>					                        
                                </div>
                                <div class="col-5 ml-auto text-right">			
                                    <p> Valor R${{ number_format($pagamento->valor , 2 , ',' , '') }} </p>						
                                </div>                                
                            </div>	                    
                            <hr>	
                        @empty
                        @endforelse 
                    
                    
                    
                    </div>   







                </section>

             </div> 

        </div>
    </div>
</div>


