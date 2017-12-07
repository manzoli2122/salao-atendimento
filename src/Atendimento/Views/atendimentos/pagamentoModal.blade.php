
<div class="modal fade" id="pagamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Pagamento</h4>                
            </div>
            <div class="modal-body">        
                {!! Form::open(['route' => 'atendimentos.adicionarPagamento', 'class' => 'form form-search form-ds'])!!}
               
                    {{ Form::hidden('atendimento_id',  $atendimento->id ) }}
                    {{ Form::hidden('cliente_id',  $atendimento->cliente->id ) }}

                    <div class="row">
                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="formaPagamento">Pagamento:</label>
                                <select class="form-control" name="formaPagamento" required onchange="myFunction(this.value)">
                                        <option value="">Selecione a forma de pagamento</option>                               
                                        <option value="dinheiro"> Dinheiro  </option>
                                        <option value="credito"> Credito  </option>
                                        <option value="debito"> Debito  </option>
                                        <option value="cheque"> Cheque  </option>    
                                        <option value="fiado"> Fiado  </option>                           
                                </select> 
                            </div>



                            <div class="form-group" id="form-operadora" hidden>
                                <label for="operadora_id">Operadora:</label>
                                <select class="form-control" id="operadora_id" name="operadora_id" >
                                        <option value="">Selecione o Operadora</option>
                                        @foreach (Manzoli2122\Salao\Cadastro\Models\Operadora::get() as $key )
                                        <option value="{{ $key->id }}">  {{ $key->nome }}  </option>
                                        @endforeach
                                </select> 
                            </div>


                            <div class="form-group" id="form-parcelas" hidden>
                                <label for="parcelas">Parcelas:</label>
                                <select class="form-control" id="parcelas" name="parcelas" >
                                        <option value="">Selecione as parcelas</option>                               
                                        <option value="1"> 1  </option>
                                        <option value="2"> 2  </option>
                                        <option value="3"> 3  </option>                               
                                </select> 
                            </div>

                        </div>


                        <div class="col-md-6">
                   

                            <div class="form-group"  >
                                <label for="valor" class="col-form-label">Valor:</label>
                                {!! Form::number('valor', ($atendimento->valor - $atendimento->valorPagamentos()) , ['placeholder' => 'valor', 'step' => '0.01', 'class' => 'form-control', 'required', 'min'=> 0 , 'max' => ($atendimento->valor - $atendimento->valorPagamentos()) ]) !!} 
                            </div>

                            <div class="form-group" id="form-bandeira" hidden>
                                <label for="bandeira">bandeira:</label>
                                <select class="form-control"  id="bandeira" name="bandeira" >
                                        <option value="">Selecione o bandeira</option>
                                        <option value="banescard">  Banescard </option>
                                        <option value="visa">  Visa </option>
                                        <option value="mastercard">  MasterCard </option>
                                        <option value="Maestro">  Maestro </option>
                                        <option value="Elo">  Elo </option>
                                        <option value="outras">  Outras </option>
                                    
                                </select> 
                            </div>

                            <div class="form-group">
                                <label for="observacoes">observacoes:</label>
                                {!! Form::text('observacoes' , null , ['placeholder' => 'observacoes', 'class' => 'form-control'])!!}
                            </div>



                        </div>

                    </div>

                    

                    



                    <div class="row">
                        <div class="col-5 col-md-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        
                        <div class="col-5 col-md-5 ml-auto">
                            <div class="form-group">
                                {!! Form::submit('Enviar' , ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                    
                    
                {!! Form::close()!!}

      
      
            </div>

            
        </div>
    </div>
</div>

