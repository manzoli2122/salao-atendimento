@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )
	
@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Atendimentos do dia {{ today()->format('d/m/Y')}} 
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )
 	
	<!--div class="col-xs-12">
		<div class="box">									
			<div class="box-body table-responsive no-padding"-->

	<div class="col-xs-12">
		<div class="box box-success">	
			<div class="box-body">

				<table class="table table-hover table-striped table-hover table-responsive">
					<tr>
						<th>Cliente</th>
						<th>Valor dos Serviços</th>
						<th>Valor dos Produtos</th>	
						<th>Valor Total</th>					
						<th>Ações</th>
					</tr>
					@forelse($models as $model)				
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
		</div>				
	</div>
	@forelse($models as $model)	
			@include('atendimento::atendimentos.modalAterarData')
	@empty									
	@endforelse


</div>
<div class="row">

<div class="col-md-6">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
            <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
            <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  	Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  	<li role="presentation" class="divider"></li>
                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
            </li>
            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <b>How to use:</b>

                <p>Exactly like the original bootstrap tabs except you should use
                  the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                	
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2"> teste
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
            	m passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        <!-- /.tab-pane -->
        </div>
    <!-- /.tab-content -->
    </div>
<!-- nav-tabs-custom -->
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