@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('atendimento.templateMasterMenuLateral' , 'menuLateral')  )
			@if($apagados)
				@permissao('clientes')
					<li><a href="{{ route('clientes.index')}}"><i class="fa fa-circle-o text-blue"></i> <span>Clientes Ativos</span></a></li>
				@endpermissao
			@else
				@permissao('clientes-cadastrar')
					<li><a href="{{ route('clientes.create')}}"><i class="fa fa-circle-o text-blue"></i> <span>Cadastrar Cliente</span></a></li>
				@endpermissao
				@permissao('clientes-apagados')
					<li><a href="{{  route('clientes.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Clientes Apagados</span></a></li>
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


@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )				
				Listagem dos Clientes @if($apagados) Apagados  @endif						
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


							@if($apagados)
								{!! Form::open(['route' => 'clientes.pesquisarApagados' , 'method' => 'get' ]) !!}
							@else
								{!! Form::open(['route' => 'clientes.pesquisar' , 'method' => 'get' ]) !!}
							@endif								
									<div class="input-group input-group-sm" style="width: 190px; margin-left:auto;">
										{!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar Serviços' , 'aria-label' => 'Search']) !!}
										<div class="input-group-btn">
											<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>	
										</div>
									</div>			
							{!!  Form::close()  !!}
								
							

						</div>
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover table-striped">
								<tr>
									<th>Nome</th>
									<th>Divida</th>
									<th>Atendimento</th>								
												
									<th>Ações</th>
								</tr>
								@forelse($models as $model)				
									<tr>
										<td> {{$model->name}} </td>	

										<td>
											@if( App\Modules\Atendimento\Models\Pagamento::where('cliente_id', $model->id )->where('formaPagamento', 'fiado' )->count() > 0  )
												@permissao('atendimentos-cadastrar')
												<a class="btn btn-danger btn-sm" href="{{route("atendimentos.cadastrar", $model->id)}}" >
													<i class="fa fa-money" aria-hidden="true"></i>
													<b>Receber</b>
												</a>
												@endpermissao 
											@endif
										</td>
										<td> 
											@if(!$apagados)
												@permissao('atendimentos-cadastrar')
													<a class="btn btn-info btn-sm" href="{{route("atendimentos.cadastrar", $model->id)}}">
														<i class="fa fa-plus" aria-hidden="true"></i>
														<b>Atender</b>
													</a>
												@endpermissao  
											@endif
										</td>
										<td>
										
											@if($apagados)
												@permissao('clientes-apagados')								
														<a class="btn btn-success btn-sm" href='{{route("clientes.showapagado", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('clientes-restore')
													<a class="btn btn-warning btn-sm" href='{{route("clientes.restore", $model->id)}}'>
														<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Reativar</a>
												@endpermissao 														
														
												@permissao('clientes-delete-mater-ulta-mega')	
													<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="$(this).find('form').submit();" >
														{!! Form::open(['route' => ['clientes.destroy', $model->id ],  'method' => 'DELETE' ])!!}                                        
														{!! Form::close()!!}    
														<i class="fa fa-trash" aria-hidden="true"></i>Extinguir</a> 		        
													
												@endpermissao
											@else
												@permissao('clientes')								
														<a class="btn btn-success btn-sm" href='{{route("clientes.show", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('clientes-editar')								
														<a class="btn btn-warning btn-sm" href='{{route("clientes.edit", $model->id)}}'>
															<i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>								
												@endpermissao				
											
												@permissao('clientes-soft-delete')			
													<a class="btn btn-danger btn-sm"  href="javascript:void(0);" onclick="$(this).find('form').submit();" >
															{!! Form::open(['route' => ['clientes.destroySoft', $model->id ],  'method' => 'DELETE' ])!!}                                        
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