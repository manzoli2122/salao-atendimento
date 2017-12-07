@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )		
				Caixa do dia {{ $caixa->data->format('d/m/Y') }} 					
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
							{!! Form::open(['route' => 'caixa.pesquisar' ]) !!}
								<div class="input-group input-group-sm" style="width: 250px; margin-left:auto;">
									{!! Form::date('data' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar', 'required']) !!}
									<div class="input-group-btn">
										<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit" >
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>	
									</div>
								</div>									
							{!!  Form::close()  !!}
						</div>
						<!-- /.box-header -->
						
						
						<div class="box-body table-responsive no-padding row">
							
								<div class="col-xs-6">
									<table class="table table-hover table-striped">
										<tr>
											<th>Cliente</th>
											<th>Valor</th>				
											<th>Ações</th>
										</tr>
										@forelse($caixa->atendimentos() as $model)				
											<tr>
												<td> {{ $model->cliente->name }}  </td>						
												<td> R$ {{number_format($model->valor, 2 , ',' , '' )}} </td>
												<td>		
													@permissao('atendimentos-show')								
														<a class="btn btn-success btn-sm" href='#'><i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
													@endpermissao	
												</td>
											</tr>
										@empty									
										@endforelse
										<tr>
											<td> TOTAL  </td>						
											<td>  {{ $caixa->valor_atendimentos() }} </td>
											<td> </td> 
										</tr>

									</table>
								</div>
						
								<div class="col-xs-6">
								<table class="table table-hover table-striped">
									<tr>
										<th>Caixa</th>
										<th>Valor</th>										
									</tr>
									<tr>
										<td> TOTAL EM DINHEIRO:  </td>						
										<td>  {{ $caixa->valor_Pagamento_dinheiro() }}  </td>
									</tr>

									<tr>
										<td> TOTAL EM CREDITO:  </td>						
										<td>  {{ $caixa->valor_Pagamento_credito() }}  </td>
									</tr>

									<tr>
										<td> TOTAL EM DEBITO:  </td>						
										<td>  {{ $caixa->valor_Pagamento_debito() }}  </td>
									</tr>

									<tr>
										<td> TOTAL EM CHEQUE:  </td>						
										<td>  {{ $caixa->valor_Pagamento_cheque() }}  </td>
									</tr>

									<tr>
										<td> TOTAL FIADO:  </td>						
										<td>  {{ $caixa->valor_Pagamento_fiado() }}  </td>
									</tr>

								</table>
							</div>
						
					</div>
				</div>
			</div>
		</div>


@endsection