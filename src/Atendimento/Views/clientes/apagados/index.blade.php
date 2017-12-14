@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem dos Produtos			
@endsection


@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )				
	@permissao('operadoras-apagados')
		<li><a href="{{  route('produtos.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Produtos Apagados</span></a></li>
	@endpermissao
@endsection


@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
        <div class="box-header align-right">
			@permissao('produtos-cadastrar')
				<a href="{{ route('produtos.create')}}" class="btn btn-success" title="Adicionar uma nova Operadora">
					<i class="fa fa-plus"></i> Cadastrar Produto
				</a>
			@endpermissao            
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th>ID</th>
						<th pesquisavel>Nome</th>
						<th>Valor</th>
						
						<th>Observações</th>
						<th>Desconto Máximo</th>
												
                        <th class="align-center">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection


@push(Config::get('app.templateMasterScript' , 'script') )
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 1, "asc" ]],
				ajax: { 
					url:'{{ route('produtos.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'nome', name: 'nome' },
					{ data: 'valor', name: 'valor' },
					
					{ data: 'observacoes', name: 'observacoes' },
					{ data: 'desconto_maximo', name: 'desconto_maximo' },
					
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'tipo de seção'])", "{{ route('produtos.apagados') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush










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
		<script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{url('/js/dataTables.bootstrap.min.js')}}"></script>	
		<script>
			$(function () {
				$('#example1').DataTable({
					 "dom": '<"top"pf>rt<"bottom"i><"clear">'
				})
			})
		</script>
		 <script>
            function ApagarCliente(val) {
                return  confirm('Deseja mesmo apagar o cliente?'  );                       
            }
		</script>
        <script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
@endsection


@section( Config::get('atendimento.templateMasterCss' , 'css')  ) 		
	<link rel="stylesheet" href="{{url('/css/dataTables.bootstrap.min.css')}}">


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
  
	<?php $title = " - Clientes"; ?>
	<div class="row">
        <div class="col-xs-12">

			<div class="box">            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              	<table id="example1" class="table table-bordered table-striped table-hover">
                	<thead>
                		<tr>
                  			<th>Nome</th>
							<th>Divida</th>
							<th>Atendimento</th>
							<th>Ações</th>
                		</tr>
                	</thead>

                	<tbody>
					
						@forelse($models as $model)				
							<tr>
								<td> {{$model->name}} </td>	
								<td>
									@if( Manzoli2122\Salao\Atendimento\Models\Pagamento::where('cliente_id', $model->id )->where('formaPagamento', 'fiado' )->count() > 0  )
										@permissao('atendimentos-cadastrar')
											<a target="_blank" class="btn btn-danger btn-sm" href="{{route("atendimentos.cadastrar", $model->id)}}" >
												<i class="fa fa-money" aria-hidden="true"></i>
												<b>Receber</b>
											</a>
										@endpermissao 
									@endif
								</td>
								<td> 
									@if(!$apagados)
										@permissao('atendimentos-cadastrar')
											<a class="btn btn-info btn-sm" href="{{route("atendimentos.cadastrar", $model->id)}}" target="_blank">
												<i class="fa fa-plus" aria-hidden="true"></i>
												<b>Atender</b>
											</a>
										@endpermissao  
									@endif
								</td>
								<td>
										
											@if($apagados)
												@permissao('clientes-apagados')								
														<a target="_blank" class="btn btn-success btn-sm" href='{{route("clientes.showapagado", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('clientes-restore')
													<a class="btn btn-warning btn-sm" href='{{route("clientes.restore", $model->id)}}'>
														<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Reativar</a>
												@endpermissao 														
														
												@permissao('clientes-delete-mater-ulta-mega')	
													<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="$(this).find('form').submit();" >
														{!! Form::open(['route' => ['clientes.destroy', $model->id ],  'method' => 'DELETE'  , 'onsubmit' => " return  ApagarCliente(this)"])!!}                                        
														{!! Form::close()!!}    
														<i class="fa fa-trash" aria-hidden="true"></i>Extinguir</a> 		        
													
												@endpermissao
											@else
												@permissao('clientes')								
														<a target="_blank" class="btn btn-success btn-sm" href='{{route("clientes.show", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('clientes-editar')								
														<a target="_blank" class="btn btn-warning btn-sm" href='{{route("clientes.edit", $model->id)}}'>
															<i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>								
												@endpermissao				
											
												@permissao('clientes-soft-delete')			
													<a class="btn btn-danger btn-sm"  href="javascript:void(0);" onclick="$(this).find('form').submit();" >
															{!! Form::open(['route' => ['clientes.destroySoft', $model->id ],  'method' => 'DELETE' , 'onsubmit' => " return  ApagarCliente(this)"  ])!!}                                        
															{!! Form::close()!!}    
															<i class="fa fa-trash" aria-hidden="true"></i>Apagar</a>													
												@endpermissao
											@endif
											
										</td>
									</tr>
								@empty
									
								@endforelse


                
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>


@endsection