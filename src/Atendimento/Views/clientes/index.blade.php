@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem dos Clientes			
@endsection


@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )				
	@permissao('clientes-apagados')
		<li><a href="{{  route('clientes.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Clientes Apagados</span></a></li>
	@endpermissao
@endsection


@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
		@permissao('clientes-cadastrar')
        	<div class="box-header align-right">			
				<a href="{{ route('clientes.create')}}" class="btn btn-success btn-sm" title="Adicionar um novo clientes">
					<i class="fa fa-plus"></i> Cadastrar cliente
				</a>			            
        	</div>
		@endpermissao

        <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th>ID</th>
						<th pesquisavel>Nome</th>
						<th>Divida</th>
                        <th class="align-center" style="width:180px;">Ações</th>
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
					url:'{{ route('clientes.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'name', name: 'name' },
				
					{ data: 'valor', name: 'valor', searchable: false,   class: "price"},
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'tipo de seção'])", "{{ route('clientes.apagados') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush

