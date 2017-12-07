
<div class="modal fade bd-example-modal-lg" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="margin-left:50px;" class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">        
                {!! Form::open(['route' => 'atendimentos.adicionarProduto', 'class' => 'form form-search form-ds'])!!}
               
                    {{ Form::hidden('atendimento_id',  $atendimento->id ) }}
                    {{ Form::hidden('cliente_id',  $atendimento->cliente->id ) }}

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="servico_id">Produto:</label>
                                <select class="form-control" name="produto_id" required onchange="produtoFunction(this.form)">
                                        <option value="">Selecione o Produto</option>
                                        @foreach (Manzoli2122\Salao\Cadastro\Models\Produto::orderBy('nome', 'asc')->get() as $key )
                                        <option label="{{ $key->nome }}" data-maximo="{{$key->desconto_maximo}}"  value="{{ $key->id }}"> {{ $key->valor }} </option>
                                        @endforeach
                                </select> 
                            </div>


                            <div class="form-group">
                                <label for="desconto">Desconto/Unid.:</label>
                                {!! Form::number('desconto', 0.0, ['placeholder' => 'desconto', 'step' => '0.01', 'class' => 'form-control', 'required' , 'min' => 0 , 'onchange' => 'produtoFunction(this.form)']) !!}
                                
                            </div>

                            <div class="form-group">                        
                                <label for="quantidade">Quantidade:</label>
                                {!! Form::number('quantidade', 1, ['placeholder' => 'quantidade',  'class' => 'form-control', 'required', 'min' => 1 , 'max' => 10 , 'onchange' => 'produtoFunction(this.form)' ]) !!}
                            </div>

                        </div>


                        <div class="col-md-6">
                           
                            <div class="form-group">                        
                                <label for="acrescimo">Acrescimo/Unid:</label>
                                {!! Form::number('acrescimo', 0.0, ['placeholder' => 'acrescimo', 'step' => '0.01', 'class' => 'form-control', 'required' , 'min' => 0 , 'onchange' => 'produtoFunction(this.form)' ]) !!}
                            </div>

                            <div class="form-group">
                                <label for="valor-produto-unitario">Valor Unitário</label>
                                {{ Form::number('valor-produto-unitario',  '0.0' , ['disabled' , 'class' => 'form-control' , 'step' => '0.01' ] ) }}
                            </div>

                             <div class="form-group">                        
                                <label for="valor-produto-total">Valor Total</label>
                                {{ Form::number('valor-produto-total',  '0.0' , ['disabled' , 'class' => 'form-control' , 'step' => '0.01' ] ) }}
                            </div>

                         </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-4 col-md-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        
                        <div class="col-4 col-md-4 ml-auto">
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




