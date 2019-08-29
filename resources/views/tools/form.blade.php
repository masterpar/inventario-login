<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Elemento: </label>

    <div class="col-md-6">
        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre de la categoria','required' ,'autofocus'])!!}

        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>
</div>         
              

<div class="form-group">
   <label for="descripcion" class="col-md-4 control-label">Imagén: </label>
  <div class="col-md-6">
    <input name="imagen" type="file" value="{{old('imagen')}}" required class="filestyle" data-iconName="fa fa-file-image-o">
    </div>
</div>


<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
    <label for="descripcion" class="col-md-4 control-label">Descripción: </label>

    <div class="col-md-6">
        {!!Form::textarea('descripcion',null,['class'=>'form-control','required'])!!}

        @if ($errors->has('descripcion'))
            <span class="help-block">
                <strong>{{ $errors->first('descripcion') }}</strong>
            </span>
        @endif
    </div>
</div> 

<div class="form-group">
    <label for="category_id" class="col-md-4 control-label">Categoría: </label>

    <div class="col-md-6">
        {!!Form::select('category_id', $categories , null , ['class'=>'form-control' , 'id' => 'categories' , 'placeholder'=>'Seleccione categoría','required'])!!}

        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
    </div>
</div> 

<div class="form-group subcategory_div">
    <label for="subcategory_id" class="col-md-4 control-label">SubCategoría: </label>

    <div class="col-md-6">
        {!!Form::select('subcategory_id',['placeholder'=>'Seleccione'] , null , ['class'=>'form-control','id' => 'subcategories'])!!}

        @if ($errors->has('subcategory_id'))
            <span class="help-block">
                <strong>{{ $errors->first('subcategory_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label" >Elemento: </label>

    <div class="col-md-6">
        {!! Form::number('cantidad_disponible', old('1'), ['min' => '1', 'max' => 100, 'class' => 'text-center form-control', 'required'  ]) !!}

        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>
</div>
                 


