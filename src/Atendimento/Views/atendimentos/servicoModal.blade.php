<div class="modal fade" id="servicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Serviço</h4>
            </div>
            <div class="modal-body">                     
                <form method="POST" action="{{route('atendimentos.adicionarServico')}}" accept-charset="UTF-8" class="form form-search form-ds">
                    {{csrf_field()}}              
                    <input name="atendimento_id" value="{{ $atendimento->id }}" type="hidden">
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
                                <input placeholder="desconto" step="0.01" class="form-control" onchange="servicoFunction(this.form)" required="" min="0" name="desconto" value="0" type="number">
                            </div>
                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input placeholder="quantidade" onchange="servicoFunction(this.form)" class="form-control" required="" min="1" max="10" name="quantidade" value="1" type="number">
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
                                <input placeholder="acrescimo" onchange="servicoFunction(this.form)" step="0.01" class="form-control" required="" min="0" name="acrescimo" value="0" type="number">
                            </div>
                            <div class="form-group">
                                <label for="valor-produto-unitario">Valor Unitário</label>
                                <input disabled="" class="form-control col-2" step="0.01" name="valor-produto-unitario" value="0.0" type="number">
                            </div
                            <div class="form-group">
                                <label for="valor-produto-total">Valor Total</label>
                                <input disabled="" class="form-control" step="0.01" name="valor-produto-total" value="0.0" type="number">
                            </div>
                        </div>
                    </div>
                        
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="Enviar" style="float: right;" class="btn btn-success">
                            
                </form>    
            </div>           
        </div>
    </div>
</div>