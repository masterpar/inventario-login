@extends('categories.base')

@section('action-content')
<section class="content">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar subcategoría</div>
                <div class="panel-body">
                    {!!Form::model( $subcategory, ['route'=>['subcategory.update', $category->id, $subcategory->id],'method'=>'PUT', 'class' =>'form-horizontal'])!!}

                    @include('subcategories.form')          

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                            </div>
                        </div>
                    {!!Form::close()!!}    
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
