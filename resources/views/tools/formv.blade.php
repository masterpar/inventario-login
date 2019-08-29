                <div class="form-group">
        
                  {!!Form::label('nombre','Nombre:',['class'=>"col-sm-6"])!!}
                  <div class="col-md-12">
                    {!!Form::text('nombre',null,['class'=>'form-control', 'required'])!!}
                  </div>
                  
        

                </div>
              
               
                <div class="form-group">
                    <label class="col-md-6" for="inputtitulo">Imagen</label>
                  <div class="col-md-12">
                    <input name="imagen" type="file" class="filestyle" data-iconName="fa fa-file-image-o">
                    </div>
                </div>
                 

                <div class="form-group">
                <div class="col-md-12">
                  {!!Form::label('descripcion','Descripción:')!!}
                  {{ Form::textarea('descripcion', null, ['size' => '30x5', 'class'=>'form-control','required']) }}
                </div>
                </div>
               
               

        <div class="form-group">
        <div class="col-md-12">
          {!!Form::label('category_id','Categoria:')!!}
          {!!Form::select('category_id', $categories , null , ['class'=>'form-control' , 'id' => 'categories' , 'placeholder'=>'Seleccione categoría'])!!}
        </div>
        <div class="form-group">
        <div class="col-md-12">
          {!!Form::label('subcategory_id','Subcategoria:')!!}
           {!!Form::select('subcategory_id',['placeholder'=>'Seleccione subcategoria'] , null , ['class'=>'form-control','id' => 'subcategories'])!!}
        </div>

         


         
    </div>


