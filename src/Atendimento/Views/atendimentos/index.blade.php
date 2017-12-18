@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )
	
@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Atendimentos do dia {{ today()->format('d/m/Y')}} 
@endsection


@section( Config::get('app.templateMasterContent' , 'content')  )
 	
			
				<div class="col-xs-12">
					<div class="box">						
						
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover table-striped">
								<tr>
									<th>Cliente</th>
									<th>Valor</th>				
									<th>Ações</th>
								</tr>
								@forelse($models as $model)				
									<tr>
										<td> {{ $model->cliente->name }}  </td>						
										<td> R$ {{number_format($model->valor, 2 , ',' , '' )}} </td>
										<td>
												@permissao('atendimentos')								
														<a class="btn btn-success btn-sm" href='{{route("atendimentos.show", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>	
														 <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#alterarDataModal{{$model->id}}" > 
															Alterar Data
														</a>							
												@endpermissao																
											
												@permissao('atendimentos-soft-delete')			
													<a class="btn btn-danger btn-sm"  href="javascript:void(0);" onclick="$(this).find('form').submit();" >
															{!! Form::open(['route' => ['atendimentos.destroySoft', $model->id ],  'method' => 'DELETE' , 'onsubmit' => " return  ApagarAtendimento(this)" ])!!}                                        
															{!! Form::close()!!}    
															<i class="fa fa-trash" aria-hidden="true"></i>Apagar</a>													
												@endpermissao
											
										</td>
									</tr>
								@empty
									
								@endforelse
								
						

							</table>
					</div>


					
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				</div>


	@forelse($models as $model)	
			@include('atendimento::atendimentos.modalAterarData')
	@empty									
	@endforelse

@endsection


		
@push( Config::get('app.templateMasterScript' , 'script')  )
        	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
			<script>
            function ApagarAtendimento(val) {
                return  confirm('Deseja mesmo apagar o Atendimento?'  );                       
            }
		</script>
@endpush



		
@push( Config::get('app.templateMasterCss' , 'css')  )			
			<style type="text/css">
					.btn-sm{
						padding: 1px 10px;
					}
					.pagination{
						margin:0px;
						display: unset;
						font-size:12px;
					}
			</style>
@endpush
