<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Produto</h4>                
            </div>
            <div class="modal-body">   
                <form class="form form-search form-ds" method="post" action="{{route('atendimentos.adicionarProduto')}}" >
                    {{csrf_field()}}
                    <input name="atendimento_id" value="{{$atendimento->id}}" type="hidden">
                    <input name="cliente_id" value="{{$atendimento->cliente->id}}" type="hidden"> 
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
                                <input placeholder="desconto" step="0.01" class="form-control" required="" min="0" onchange="produtoFunction(this.form)" name="desconto" value="0" type="number">
                            </div>
                            <div class="form-group">                        
                                <label for="quantidade">Quantidade:</label>
                                <input placeholder="quantidade" class="form-control" required="" min="1" max="10" onchange="produtoFunction(this.form)" name="quantidade" value="1" type="number">
                            </div>
                        </div>
                        <div class="col-md-6">                           
                            <div class="form-group">                        
                                <label for="acrescimo">Acrescimo/Unid:</label>
                                <input placeholder="acrescimo" step="0.01" class="form-control" required="" min="0" onchange="produtoFunction(this.form)" name="acrescimo" value="0" type="number">
                            </div>
                            <div class="form-group">
                                <label for="valor-produto-unitario">Valor Unitário</label>
                                <input disabled="" class="form-control" step="0.01" name="valor-produto-unitario" value="0.0" type="number">
                            </div>
                             <div class="form-group">                        
                                <label for="valor-produto-total">Valor Total</label>
                                <input disabled="" class="form-control" step="0.01" name="valor-produto-total" value="0.0" type="number">
                            </div>
                         </div>                    
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>                        
                        <div class="col-6 col-md-6 ml-auto">
                            <div class="form-group">
                                <input class="btn btn-success" value="Enviar" type="submit">
                            </div>
                        </div>
                    </div>                                       
                </form>           
            </div>            
        </div>
    </div>
</div>




