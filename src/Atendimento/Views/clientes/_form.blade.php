<div class="box-body">	
     <div class="row">
        <div class="col-md-6">
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" placeholder="Nome do Cliente"
                    value="{{$model->name or old('name')}}">
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('nemailame') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email do Cliente"
                    value="{{$model->email or old('email')}}">
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
            
            <div class="form-group {{ $errors->has('celular') ? 'has-error' : ''}}">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" name="celular" placeholder="Celular do Cliente"
                    value="{{$model->celular or old('celular')}}">
                {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
            </div>



            <div class="form-group {{ $errors->has('nascimento') ? 'has-error' : ''}}">
                <label for="nascimento">Nascimento</label>
                <input type="text" class="form-control" name="nascimento" placeholder="Nascimento do Cliente"
                    value="{{$model->nascimento or old('nascimento')}}">
                {!! $errors->first('nascimento', '<p class="help-block">:message</p>') !!}
            </div>



                         




            
            <!--div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                <label for="valor">Valor</label>
                <input type="number" step="0.01" class="form-control" name="valor" placeholder="Valor"
                    value="{{$model->valor or old('valor')}}">
                {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
            </div-->    


        </div>

        <div class="col-md-6">











            <!--div class="form-group {{ $errors->has('desconto_maximo') ? 'has-error' : ''}}">
                <label for="desconto_maximo">Desconto máximo (%)</label>
                <input type="number" step="0.01" class="form-control" name="desconto_maximo" placeholder="Desconto máximo (%)"
                    value="{{$model->desconto_maximo or old('desconto_maximo')}}">
                {!! $errors->first('desconto_maximo', '<p class="help-block">:message</p>') !!}
            </div-->
        </div> 
       
                     
    </div> 
 </div>  
    