@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )			
		{{$model->name}}
@endsection

@section( Config::get('atendimento.templateMasterContentTituloSmall' , 'small-titulo-page')  )			
		{{$model->email}} | Celular: {{$model->celular}} | Telefone: {{$model->telefone}} | Endereço: {{$model->endereco}}
@endsection

@section( Config::get('atendimento.templateMasterContent' , 'contentMaster')  )
	<h1>Atendimentos</h1>
	<section class="row text-center Listagens">
		
		 <div class="col-12 col-sm-4 servicos" style="margin-bottom:10px; ">           
           	@forelse($model->atendimentos as $atendimento)
                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title" style="width: 100%;"> 
									{{ $atendimento->created_at->format('d/m/Y') }}
									<a class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#{{$atendimento->id}}atendimentoModal" > 
										Visualizar
									</a>									
								</h3>  								                                                       
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg">                                        
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left">Valor: </span>
                                            <span class="pull-right badge bg-green"> R$ {{number_format($atendimento->valor, 2)}} </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>
			@empty			
			@endforelse             
        </div>
    </section>   

	@forelse($model->atendimentos as $atendimento)
		@include('atendimento::clientes.atendimentoModal')				
	@empty
	@endforelse

@endsection