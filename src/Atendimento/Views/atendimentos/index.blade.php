@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )
	
@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Atendimentos do dia {{ today()->format('d/m/Y')}} 
@endsection

@section( Config::get('app.templateMasterContentTituloSmallRigth' , 'small-content-header-right')  )
	<form method="POST" action="{{route('atendimentos.pesquisar')}}" accept-charset="UTF-8">
		{{csrf_field()}}
		<div class="input-group input-group-sm" style="width: 250px; margin-left:auto;">
			<input class="form-control" placeholder="Pesquisar" required="" name="data" type="date">
			<div class="input-group-btn">
				<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>	
			</div>
		</div>									
	</form>
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )
 		
	@forelse($caixa->atendimentos() as $model)	
		@include('atendimento::atendimentos.modalAterarData')
	@empty									
	@endforelse

	
</div>
<div class="row">

<div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">ATENDIMENTOS</a></li>
			<li><a href="#caixa" data-toggle="tab">CAIXA</a></li>
			@foreach (Manzoli2122\Salao\Atendimento\Models\Funcionario::funcionarios() as $key )
				<li><a href="#funcionario_{{$key->id}}" data-toggle="tab"> {{ $key->apelido }}</a></li>
			@endforeach	
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
				<table class="table table-hover table-striped table-hover table-responsive">
					<tr>
						<th>Cliente</th>
						<th>Valor dos Serviços</th>
						<th>Valor dos Produtos</th>	
						<th>Valor Total</th>					
						<th>Ações</th>
					</tr>
					@forelse($caixa->atendimentos() as $model)				
					<tr>
						<td> {{ $model->cliente->name }}  </td>			
						<td> R$ {{number_format($model->valorServicos(), 2 , ',' , '' )}} </td>
						<td> R$ {{number_format($model->valorProdutos(), 2 , ',' , '' )}} </td>			
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
									<form  method="post" action="{{route('atendimentos.destroySoft', $model->id)}}" onsubmit="return  ApagarAtendimento(this)">
										{{csrf_field()}}    
										<input name="_method" value="DELETE" type="hidden">                    
									</form>  
									<i class="fa fa-trash" aria-hidden="true"></i>Apagar</a>													
							@endpermissao											
						</td>
					</tr>
					@empty					
					@endforelse					
				</table>                	
			</div>


			<div class="tab-pane" id="caixa">

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>				  
						<div class="info-box-content">
							<span class="info-box-text">CPU Traffic</span>
							<span class="info-box-number">90<small>%</small></span>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
				  		<div class="info-box-content">
							<span class="info-box-text">Likes</span>
							<span class="info-box-number">41,410</span>
						</div>
					</div>
				</div>				 
				<div class="clearfix visible-sm-block"></div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
							<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Sales</span>
							<span class="info-box-number">760</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
				  		<div class="info-box-content">
							<span class="info-box-text">New Members</span>
							<span class="info-box-number">2,000</span>
						</div>
					</div>
				</div>





				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Inventory</span>
							<span class="info-box-number">5,200</span>
							<div class="progress">
								<div class="progress-bar" style="width: 50%"></div>
							</div>
							<span class="progress-description">
								50% Increase in 30 Days
							</span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box bg-yellow">
							<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Inventory</span>
								<span class="info-box-number">5,200</span>
								<div class="progress">
									<div class="progress-bar" style="width: 50%"></div>
								</div>
								<span class="progress-description">
									50% Increase in 30 Days
								</span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box bg-yellow">
								<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Inventory</span>
									<span class="info-box-number">5,200</span>
									<div class="progress">
										<div class="progress-bar" style="width: 50%"></div>
									</div>
									<span class="progress-description">
										50% Increase in 30 Days
									</span>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box bg-yellow">
									<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Inventory</span>
										<span class="info-box-number">5,200</span>
										<div class="progress">
											<div class="progress-bar" style="width: 50%"></div>
										</div>
										<span class="progress-description">
											50% Increase in 30 Days
										</span>
									</div>
								</div>
							</div>




				


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
			
			
			@foreach (Manzoli2122\Salao\Atendimento\Models\Funcionario::funcionarios() as $key )
			<div class="tab-pane" id="funcionario_{{$key->id}}">
				<table class="table table-hover table-striped table-hover table-responsive">
					<tr>
						<th>SERVIÇO</th>
						<th>CLIENTE</th>
						<th>VALOR TOTAL</th>							
						<th>VALOR LIQUIDO</th>
					</tr>
					@forelse($caixa->atendimentosFuncionario($key->id) as $model)
						<tr>
							<td> {{ $model->servico->nome }} </td>
							<td> {{ $model->cliente->name }}  </td>		
							<td> R$ {{number_format($model->valor, 2 , ',' , '' )}} </td>		
							<td> R$ {{number_format($model->valorFuncioanrio() , 2 , ',' , '' )}} </td>			
						</tr>
					@empty					
					@endforelse	
					<tr style="font-size: 18px;font-weight: bold;">
						<td>   </td>			
						<td>TOTAL  </td>
						<td>{{ $caixa->atendimentosFuncionarioTotal($key->id) }}  </td>			
						<td style="color:red"> {{ $caixa->atendimentosFuncionarioLiquido($key->id) }} </td>								
					</tr>														
				</table>
			</div>
			@endforeach
        </div>
    </div>
</div>




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