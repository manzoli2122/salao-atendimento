@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )		
				Caixa do dia {{ $caixa->data->format('d/m/Y') }} 					
@endsection


@section( Config::get('app.templateMasterContent' , 'content')  )

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
												<td></td>
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
										<td> TOTAL EM PIC PAY:  </td>						
										<td>  {{ $caixa->valor_Pagamento_pic_pay() }}  </td>
									</tr>
									<tr>
										<td> TOTAL EM TRANSFERENCIA BANCÁRIA:  </td>						
										<td>  {{ $caixa->valor_Pagamento_transferencia_bancaria() }}  </td>
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
		

@endsection


@push( Config::get('app.templateMasterScript' , 'script')  )
        	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
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