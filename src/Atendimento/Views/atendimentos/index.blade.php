@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )

	
@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )
			Caixa do dia {{ today()->format('d/m/Y')}}  @if($apagados) Apagados @endif
@endsection

@section( Config::get('atendimento.templateMasterMenuLateral' , 'menuLateral')  )
			@if($apagados)
				@permissao('atendimentos')
					<li><a href="{{ route('atendimentos.index')}}"><i class="fa fa-circle-o text-blue"></i> <span>Atendimentos Ativos</span></a></li>
				@endpermissao
			@else
				
				@permissao('atendimentos-apagados')
					<li><a href="{{  route('atendimentos.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Atendimentos Apagados</span></a></li>
				@endpermissao
			@endif			
@endsection


		
@section( Config::get('atendimento.templateMasterScript' , 'script')  )
        	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
@endsection

		
@section( Config::get('atendimento.templateMasterCss' , 'css')  )			
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
@endsection

@section( Config::get('atendimento.templateMasterContent' , 'contentMaster')  )
 
			<section class="row Listagens">
				<div class="col-12 col-sm-12 lista">		
					@if(Session::has('success'))
						<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
						{{Session::get('success')}}
						</div>
					@endif
				</div>
			</section>


			
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">

							@if(isset($dataForm))
								{!! $models->appends($dataForm)->links() !!}
							@else
								{!! $models->links() !!}
							@endif


							
								
							

						</div>
						<!-- /.box-header -->
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
										
											@if($apagados)
												@permissao('atendimentos-show-apagados')								
														<a class="btn btn-success btn-sm" href='{{route("atendimentos.showapagado", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('atendimentos-restore')
													<a class="btn btn-warning btn-sm" href='{{route("atendimentos.restore", $model->id)}}'>
														<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Reativar</a>
												@endpermissao 														
														
												@permissao('atendimentos-delete-mater-ulta-mega')	
													<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="$(this).find('form').submit();" >
														{!! Form::open(['route' => ['atendimentos.destroy', $model->id ],  'method' => 'DELETE' ])!!}                                        
														{!! Form::close()!!}    
														<i class="fa fa-trash" aria-hidden="true"></i>Extinguir</a> 		        
													
												@endpermissao
											@else
												@permissao('atendimentos')								
														<a class="btn btn-success btn-sm" href='{{route("atendimentos.show", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao																
											
												@permissao('atendimentos-soft-delete')			
													<a class="btn btn-danger btn-sm"  href="javascript:void(0);" onclick="$(this).find('form').submit();" >
															{!! Form::open(['route' => ['atendimentos.destroySoft', $model->id ],  'method' => 'DELETE' ])!!}                                        
															{!! Form::close()!!}    
															<i class="fa fa-trash" aria-hidden="true"></i>Apagar</a>													
												@endpermissao
											@endif
											
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
			</div>


@endsection