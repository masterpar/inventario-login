@extends('categories.base')

@section('action-content')
<section class="content">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo elemento</div>
                <div class="panel-body">
                    {!!Form::open(['route'=>'tool.store', 'method'=>'POST', 'files' => true , 'class' =>'form-horizontal'])!!} 

                    @include('tools.form')          

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!!Form::submit('Guardar',['class'=>'btn btn-primary col-md-12'])!!}
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
