@extends( Config::get('atendimento.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('atendimento.templateMasterContentTitulo' , 'titulo-page')  )				
		Cadastrar / Editar Serviços
@endsection

    
@section( Config::get('atendimento.templateMasterCss' , 'css')  )  			
		<link rel="stylesheet" href="{{url('/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section( Config::get('atendimento.templateMasterScript' , 'script')  )
        <script src="{{url('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>			
@endsection


@section( Config::get('atendimento.templateMasterContent' , 'contentMaster')  )
   
    <section class="row text-center placeholders">
        <div class="col-12 col-sm-12 placeholder">
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif
        </div>        
    </section>




    
    
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">FORMULÁRIO</h3>
        </div>

            @if( isset($model))
                {!! Form::model($model , ['route' => ['clientes.update' , $model->id], 'method' => 'PUT' ,  'class' => 'form form-search form-ds', 'files' => true])!!}
            @else
                {!! Form::open(['route' => 'clientes.store', 'class' => 'form form-search form-ds', 'files' => true])!!}
			@endif

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name">Nome:</label>
                                {!! Form::text('name' , null , ['placeholder' => 'Nome', 'class' => 'form-control'])!!}
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                {!! Form::email('email' , null , ['placeholder' => 'Email', 'class' => 'form-control'])!!}
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                {!! Form::text('celular' , null , ['placeholder' => 'Celular', 'class' => 'form-control'])!!}
                            </div>

                            <div class="form-group">
                                <label for="nascimento">Nascimento:</label>
                                {!! Form::date('nascimento' , null , ['class' => 'form-control'])!!}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="apelido">Apelido:</label>
                                {!! Form::text('apelido', null , ['placeholder' => 'Apelido', 'class' => 'form-control' ])!!}
                            </div>

                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                {!! Form::text('endereco', null , ['placeholder' => 'Endereço', 'class' => 'form-control' ])!!}
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                {!! Form::text('telefone', null , ['placeholder' => 'Telefone', 'class' => 'form-control' ])!!}
                            </div>

                        </div>
                       
                    </div>
                </div>

                <div class="box-footer">                    
                        {!! Form::submit('Enviar' , ['class' => 'btn btn-success btn-sm']) !!}                          
                        <a class="btn btn-warning btn-sm" style="margin-left:50px;" href="{{ URL::previous()}}">Voltar</a>     
                              
                </div>


                {!! Form::close()!!}
        </div>
     


@endsection