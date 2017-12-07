
<div class="modal fade" id="servicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Serviço</h4>

            </div>
            <div class="modal-body">        
                
                
                {!! Form::open(['route' => 'atendimentos.adicionarServico', 'class' => 'form form-search form-ds'])!!}               
                    {{ Form::hidden('atendimento_id',  $atendimento->id ) }}

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="funcionario_id">Funcionário:</label>
                                <select class="form-control" name="funcionario_id" required>
                                        <option value="">Selecione o Funcionário</option>
                                        @foreach (Manzoli2122\Salao\Atendimento\Models\Funcionario::funcionarios() as $key )
                                        <option value="{{ $key->id }}">  {{ $key->name }}  </option>
                                        @endforeach
                                </select> 
                            </div>

                            <div class="form-group">
                                <label for="servico_id">Serviço:</label>
                                <select class="form-control" name="servico_id" required onchange="servicoFunction(this.form)">
                                        <option value="">Selecione o Serviço</option>
                                        @foreach (Manzoli2122\Salao\Cadastro\Models\Servico::ativo()->orderBy('nome', 'asc')->get() as $key )
                                        <option label=" {{ $key->nome }} R${{ number_format($key->valor, 2 ,',', '') }}" data-maximo="{{$key->desconto_maximo}}" value="{{ $key->id }}">{{ $key->valor }}  </option>
                                        @endforeach
                                </select> 
                            </div>

                            <div class="form-group">                                
                                <label for="desconto">Desconto/Unid.:</label>
                                {!! Form::number('desconto', 0.0, ['placeholder' => 'desconto', 'step' => '0.01', 'class' => 'form-control' , 'onchange' => 'servicoFunction(this.form)', 'required' , 'min' => 0 ]) !!}
                                
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                {!! Form::number('quantidade', 1, ['placeholder' => 'quantidade' , 'onchange' => 'servicoFunction(this.form)' ,  'class' => 'form-control', 'required', 'min' => 1 , 'max' => 10 ]) !!}
                               
                            </div>

                        </div>


                        <div class="col-md-6">

                             <div class="form-group">
                                <label for="cliente_id">Cliente:</label>
                                <select class="form-control" name="cliente_id" required>
                                        <option value="">Selecione o Cliente</option>
                                        @foreach (Manzoli2122\Salao\Atendimento\Models\Cliente::ativo()->orderBy('name', 'asc')->get() as $key )
                                        <option value="{{ $key->id }}"  {{$key->id == $atendimento->cliente->id ? 'selected' : ''}}>  {{ $key->name }}   </option>
                                        @endforeach
                                </select> 
                            </div>

                            <div class="form-group">                        
                                <label for="acrescimo">Acrescimo/Unid:</label>
                                {!! Form::number('acrescimo', 0.0, ['placeholder' => 'acrescimo' , 'onchange' => 'servicoFunction(this.form)' , 'step' => '0.01', 'class' => 'form-control', 'required' , 'min' => 0  ]) !!}                        
                            </div>

                            <div class="form-group">
                                <label for="valor-produto-unitario">Valor Unitário</label>
                                {{ Form::number('valor-produto-unitario',  '0.0' , ['disabled' , 'class' => 'form-control col-2' , 'step' => '0.01' ] ) }}

                            </div>

                            <div class="form-group">
                                <label for="valor-produto-total">Valor Total</label>
                                {{ Form::number('valor-produto-total',  '0.0' , ['disabled' , 'class' => 'form-control' , 'step' => '0.01' ] ) }}
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