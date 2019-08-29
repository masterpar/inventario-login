<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Categoria: </label>

    <div class="col-md-6">
        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre de la categoria','required' ,'autofocus'])!!}

        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>
</div>