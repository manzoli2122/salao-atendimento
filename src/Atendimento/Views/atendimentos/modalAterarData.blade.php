
<div class="modal fade" id="alterarDataModal{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alterar data</h4>

            </div>
            <div class="modal-body">        
                
                <form method="post" action="{{route('atendimentos.alterarData', $model->id)}}" class="form form-search form-ds">
                          
                    
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="funcionario_id">Data:</label>
                                
                                <input name="data" value="{{$model->created_at}}" type="date" >
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
                </form>
            </div>
        </div>
    </div>
</div>