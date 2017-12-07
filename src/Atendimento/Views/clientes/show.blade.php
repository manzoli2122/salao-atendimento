@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )			
		{{$model->name}}
@endsection

@section( Config::get('atendimento.templateMasterContent' , 'contentMaster')  )

	<section class="row text-center dados">
            
            <div class="col-12 col-sm-4 dado">
                <h4 style="text-align:left;">Celular: {{$model->celular}} </h4>
            </div> 

            <div class="col-12 col-sm-4 dado">
                <h4 style="text-align:left;">  {{$model->email}} </h4>
            </div> 
            
            <div class="col-12 col-sm-4 dado">
                <h4 style="text-align:left;"> Telefone: {{$model->telefone}} </h4>
            </div> 	

            <div class="col-12 col-sm-4 dado">
                <h4 style="text-align:left;">Endereço: {{$model->endereco}}</h4>
            </div> 

			

			

    </section>


	<section class="row Listagens">
		
        <div class="col-12 col-sm-12 lista">		
			<br>
			<table class="table table-bordered table-sm">
				<tr>
					<th>Atendimentos</th>
					<th>Valor</th>											
				</tr>
				@forelse($model->atendimentos as $atendimento)

					@include('atendimento::atendimentos.pagamentoModal')				
					<tr>
						<td>							
							<a class="btn" data-toggle="modal" data-target="#{{$atendimento->id}}atendimentoModal" style="width: 100%; color:blue; text-align:left;"> 
							 {{ $atendimento->created_at->format('d/m/Y') }}
							</a>
						</td>						
						<td> R$ {{number_format($atendimento->valor, 2)}} </td>						
														
					</tr>
				@empty
					<tr>						
						<td>Nenhum atendimento encontrado</td>
					</tr>
                @endforelse
			</table>
			
        </div>
        
    </section>

    <br>
    <a class="btn btn-warning btn-sm" href="{{ URL::previous()}}">Voltar</a>


	@forelse($model->atendimentos as $atendimento)
		@include('atendimento::clientes.atendimentoModal')				
	@empty
	@endforelse

@endsection